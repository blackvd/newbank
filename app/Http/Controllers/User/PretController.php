<?php

namespace App\Http\Controllers\User;

use App\Events\PretDone;
use App\Events\PretRejected;
use App\Models\Pret;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PretController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('admin.pret_account.index', compact('clients'));
    }


    public function show($res)
    {
        $client = Client::where('track_id', $res)->first();

        return view('admin.pret_account.show', compact('client'));
    }


    public function askPret(Request $req)
    {
        return $this->validation($req->all());
    }

    private function validation($req)
    {
        $validator = Validator::make($req, [
            'amount' => 'required',
            'agence' => 'required',
            'reason' => 'required',
        ]);

        // dd($validator->fails());
        if ($validator->fails()) {
            return redirect('/')->with('echec', "Veuillez s'il vous plait a bien 
            renseigner les champs de la demande");
        }

        $pret = Pret::create([
            "montant" => $req['amount'],
            "reste" => $req["amount"],
            "agence" => $req['agence'],
            "motif" => $req['reason'],
            "client_id" => $req['user'],
            "statut" => 0
        ]);

        if ($pret) {
            return redirect('/')->with('success', 'Votre demande a ete pris en charge 
        vous recevrez un mail par la suite');
        }
    }

    public function reject(String $trackId)
    {
        $client = Client::where('track_id', $trackId)->first();
        $pret = $client->prets()->latest()->first();

        $pret->statut = -1;
        $pret->reste = 0;
        $pret->save();

        PretRejected::dispatch($client);

        return redirect()->back()->with(
            'success',
            'La demande de pret a ete rejecter !'
        );
    }

    public function eligibilite($id)
    {
        $client = Client::find($id);
        foreach ($client->comptes as $value) {
            if ($value->type_compte == 1 && $value->solde == 0) {
                return redirect()->back()->with("echec", "$client->civilite $client->nom $client->prenoms n'est pas eligible car solde a zero");
            }
        }

        foreach ($client->prets as $pret) {
            if ($pret->reste > 0 && $pret->statut != -1) {
                return redirect()->back()->with("echec", "$client->civilite $client->nom $client->prenoms n'est pas eligible car est en train de rembourser un pret");
            }
        }
        return redirect()->back()->with("success", "$client->civilite $client->nom $client->prenoms n'est pas eligible car est en train de rembourser un pret");
        return redirect()->back();
    }

    public function accorder($id)
    {
        $client = Client::find($id);
        $pret = $client->prets()->latest()->first();
        $pret->statut = 1;
        $pret->reste = $pret->montant;
        $pret->save();

        // event par mail pour informer de l'accord du pret
        PretDone::dispatch($client);

        redirect()->back()->with("success", "Le pret a ete accorder a $client->civilite $client->nom $client->prenoms");
    }
}
