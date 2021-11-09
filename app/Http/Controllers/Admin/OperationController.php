<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Models\Compte;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class OperationController extends Controller
{
    public function creditIndex()
    {
        $clients = Client::all()->sortByDesc("created_at");

        return view("admin.credit.index", compact('clients'));
    }

    public function showCrediteur($track_id)
    {
        $client = Client::where('track_id', $track_id)->first();

        return view("admin.credit.addcredit", ["client" => $client]);
    }

    public function addCredit(Request $request)
    {
        $request->validate([
            'montant' => "required|min:5|numeric",
            "compte" => "required"
        ]);

        DB::beginTransaction();
        try {
            $compte = Compte::where('numero_compte', $request->compte)->first();
            if ($compte) {
                $compte->solde += (int)$request->montant;
                $compte->save();
            }
            $transac = Transaction::create([
                "ref" => "010",
                "credit" => $request->montant,
                "solde" => $compte->solde,
                "libelle" => $request->libelle,
                "agent" => Auth::guard('admin')->user()->id,
                "compte" => $compte->id
            ]);
            // dd($transac);

            DB::commit();
            return response()->json(['message' => "Le compte vient d'etre crediter"]);
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return response()->json(['error' => "Veuillez verifier les informations fournis"]);
        }
    }
}
