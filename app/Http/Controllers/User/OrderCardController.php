<?php

namespace App\Http\Controllers\User;

use App\Events\CardBlock;
use Carbon\Carbon;
use App\Models\Carte;
use App\Models\Client;
use App\Models\Compte;
use App\Models\Commande;
use Illuminate\Http\Request;
use App\Models\AdresseLivraison;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderCardController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $client = Client::where('id', Auth::user()->client_id)->first();
        return view('user.order_card.index', ["client" => $client]);
    }

    public function cards()
    {
        $client = Client::where('id', Auth::user()->client_id)->first();
        $compte = $client->comptes()->where("type_compte", "1")->first();

        // dd($compte->carte()->first());
        if (is_null($compte)) {
            return redirect('/')->with('attention', "Pas de carte disponible pour le moment");
        }
        return view('user.order_card.cards', compact(['client', "compte"]));
    }

    public function orderCard(Request $req)
    {

        try {
            $client = Client::where('id', Auth::user()->client_id)->first();
            $NComde = substr((string)Carbon::now()->timestamp, 5) . "-NBK";

            $commande = Commande::create([
                "no_commande" => $NComde,
                "client_id" => $client->id,
                "statut" => Commande::STATUT['EN ATTENTE'],
                "type_de_compte" => $req->account_type == 1 ? Compte::TYPE_COMPTE['COURANT'] : Compte::TYPE_COMPTE['EPARGNE'],
            ]);

            $adresse = AdresseLivraison::create([
                "longitude" => 20.1,
                "latitude" => 20.01,
                "description" => $req->adresse_for_delivred,
                "commande_id" => $commande->id,
            ]);

            DB::commit();

            return redirect('/order-card')->with('success', "Votre demande de carte est en cours de traitement");
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('echec', "Veuillez a bien choisir votre compte et une agence");
        }
    }

    public function bloquer(Request $request)
    {
        $carte = Carte::where('no_carte', $request->numero)->first();
        $client = $carte->compte->client()->first();
        try {

            DB::beginTransaction();
            if ($carte->statut == 0) {
                return ['error' => "Votre carte est deja desativer."];
            }
            // suspendre la carte

            $carte->statut = 0;
            $carte->save();

            CardBlock::dispatch($client);

            DB::commit();

            return response()->json(['message' => "Votre carte vient d'etre bloquer, merci d'en commander une autre"]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['error' => "Une Erreur s'est produite veuillez reessayer plus tard"], 500);
        }
    }
}
