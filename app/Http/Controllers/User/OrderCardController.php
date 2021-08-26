<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
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

    public function index(){
       
        $user = Client::find(Auth::user()->client_id)->first();
        return view('user.order_card.index', ["user" => $user]);
    }

    public function orderCard(Request $req)
    {   
        $client = Client::find(Auth::user()->client_id)->first();
        $NComde = substr((string)Carbon::now()->timestamp,5)."-NBK";

       
        
        try {
            DB::beginTransaction();
            $NComde = substr((string)Carbon::now()->timestamp,5) . "-NBK";
            
            $req->validate([
                "account_type"=>"required",
                "adresse_for_delivred"=>"required|string"
            ]);

            $commande = Commande::create([
                "no_commande" => $NComde,
                "client_id" => $client->id,
                "statut" => Commande::STATUT['EN ATTENTE'],
                "type_de_compte" => $req->account_type == 1 ? Compte::TYPE_COMPTE['COURANT'] : Compte::TYPE_COMPTE['EPARGNE'],
            ]);

            $adresse = AdresseLivraison::create([
                "longitude"=>20.1,
                "latitude"=>20.01,
                "description" => $req->adresse_for_delivred,
                "commande_id" => $commande->id,
            ]);
            
            DB::commit();
            
            return redirect('/order-card');
            
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->withInput();
            
        }
        
    }

}
