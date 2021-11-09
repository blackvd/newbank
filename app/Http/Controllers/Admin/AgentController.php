<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Admin;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;



class AgentController extends Controller
{


    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = "/admin/dashboard";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $admins = Admin::all();
        return view('admin.agent.index', compact('admins'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            "paswd" => ["confirmed", "min:6"],
            "role" => ["between:1,2"],
        ]);
    }


    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        if ($user) {
            return response()->json(["message" => "Ajout de l'agent confirmer"]);
        }

        return response()->json(['error' => "Agent non pris en compte"]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return Admin::create([
            'username' => $data['username'],
            'name' => $data['nameAgent'],
            'role' => $data['role'],
            'code' => substr(Carbon::now()->timestamp, 0, 3),
            'password' => Hash::make($data['paswd']),
        ]);
    }


    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function showAgent($id)
    {
        $agent = Admin::findOrFail($id);
        $trans = Transaction::where('agent', $id)->get();
        return view('admin.agent.show', compact('trans', 'agent'));
    }

    public function editAgent(Request $request)
    {
        DB::beginTransaction();
        try {
            $agent = Admin::findOrFail($request->id);
            $agent->username = $request->username;
            $agent->name = $request->name;
            $agent->save();

            DB::commit();
            return redirect()->back()->with('success', "Informations modifiées");
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('echec', "Modification echoué");
        }
    }


    public function deleteAgent(Request $request)
    {
        DB::beginTransaction();
        try {
            $agent = Admin::findOrFail($request->id);
            $agent->delete();
            // $agent->save();
            // DB::commit();
            return redirect()->back()->with('success', "Agent depot supprimé");
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('echec', "Suppression echouée");
        }
    }
}
