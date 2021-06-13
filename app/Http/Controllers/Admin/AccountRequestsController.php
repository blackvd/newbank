<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Compte;

class AccountRequestsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $account_requests = Client::all();
        return view('admin.account_requests.index', [
            'account_requests' => $account_requests
            ]);
    }

    public function show(string $trackId){
        $account = Client::where('track_id',$trackId)->first();

        return view("admin.account_requests.show", ["account" => $account]);
    }

    public function changeStatus(string $trackId){
        $client = Client::where('track_id',$trackId)->first();

        $reqStatus = intval(request('status'));

        $client->statut_ouverture_compte = $reqStatus == Client::STATUT['VALIDATION'] ? Client::STATUT['VALIDATION'] : Client::STATUT['REJÉTÉ'];

        $client->save();

        if($client->statut_ouverture_compte != Client::STATUT['VALIDATION']){
            return redirect()->action(
                [AccountRequestsController::class, 'show'], ['trackId' => $client->track_id]
            )->with('reject_message', 'L\'ouverture du compte a été rejété avec success !');
        }

        $choiceOfAccount = explode(",", $client->choix_type_compte);

        foreach($choiceOfAccount as &$choice){
            $account = new Compte();

            $zerosForAccount = "000000000000";

            
            $accountsCount = strval(Compte::all()->count());

            $lastDigits =  substr($zerosForAccount, 0, -strlen($accountsCount)) . $accountsCount;

            $account->numero_compte = "CI99101305" . $lastDigits . "85";
            $account->rib = substr($account->numero_compte, 2);
            $account->solde = 0;
            $account->type_compte = $choice;

            $zerosForCusNum = "000000";

            $randNum = strval(rand(0, 999999));

            $lastCusNmmDigits =  substr($zerosForCusNum, 0, -strlen($randNum)) . $randNum;

            $account->customer_num = "305" . $lastCusNmmDigits . "01";

            $account->client_id = $client->id;

            $account->save();
        }

        return redirect()->action(
            [AccountRequestsController::class, 'show'], ['trackId' => $client->track_id]
        )->with('validate_message', 'Le compte été confirmé avec succès, vous pouvez maintenant l\'activer !');
    }

    public function activate(string $trackId){
        $client = Client::where('track_id',$trackId)->first();
        $client->statut_ouverture_compte = 3;
        $client->save();
        
        return redirect()->action(
            [AccountRequestsController::class, 'show'], ['trackId' => $client->track_id]
        )->with('validate_message', 'Le compte été activé avec succès !');;
    }
}
