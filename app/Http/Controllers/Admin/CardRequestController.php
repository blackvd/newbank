<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Carte;
use App\Models\Client;
use App\Models\Commande;
use App\Events\CardBlock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CardRequestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware("adminAuth");
    }

    public function index()
    {
        $commandes = Commande::all();
        // dd($commandes[1]->client->comptes()->get());
        return view('admin.card/index', compact('commandes'));
    }

    public function show($id)
    {
        $commande = Commande::where('no_commande', $id)->first();
        // dd($commande->client_id);
        $client = Client::find($commande->client_id);
        return view('admin.card/show', compact("client", 'commande'));
    }

    public function livraison($id)
    {
        DB::beginTransaction();

        $commande = Commande::where('no_commande', $id)->first();
        $client = Client::find($commande->client_id);

        try {
            $numCarte = substr((string)Carbon::now()->timestamp, 0) . "009";

            if ($commande->type_de_compte == "Courant") {
                $id = $client->comptes()->where('type_compte', 1)->first()->id;
                $carte = Carte::create([
                    'type_carte' => 2,
                    'compte_id' => $id,
                    "no_carte" => $numCarte,
                    'statut' => 1
                ]);
            } else {
                $id = $client->comptes()->where('type_compte', 2)->first()->id;
                $carte = Carte::create([
                    'type_carte' => 2,
                    'compte_id' => $id,
                    "no_carte" => $numCarte,
                    'statut' => 1
                ]);
            }
            $commande->statut = Commande::STATUT['LIVRAISON'];
            $commande->save();
            DB::commit();

            return redirect()->back()->with('success', "La carte a ete bien confectionner, elle est pret a etre livrer");
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
            return redirect()->back()->with('echec', "Veuillez patienter avant de reprendre l'operation");
        }
    }

    public function bloquer($id)
    {
        DB::beginTransaction();
        $commande = Commande::where('no_commande', $id)->first();
        // dd($client->comptes()->first()->carte()->first());
        try {

            $client = Client::find($commande->client_id);

            $carte = $client->comptes()->first()->carte()->first();

            if ($carte->statut == 0) {
                return redirect()->back()->with('echec', "Vous essayez de bloquer une carte déjà bloquer");
            }

            $carte->statut = 0;

            $carte->save();

            CardBlock::dispatch($client);

            DB::commit();

            return redirect()->back()->with('success', "La carte du $client->nom $client->prenoms vient d'être bloquer.");
        } catch (\Exception $th) {
            DB::rollback();
            return redirect()->back()->with('echec', "Aucun compte n'est associé à cette carte");
        }
    }

    public function delivrer($id)
    {
        DB::beginTransaction();
        try {
            $commande = Commande::where('no_commande', $id)->first();
            $commande->statut = Commande::STATUT['DELIVRÉ'];

            $commande->save();

            DB::commit();
            return redirect()->back()->with('success', "La carte a été bien confectioné, elle est prête à être livrer");
        } catch (\Exception $th) {
            DB::rollback();
            throw $th;
            return redirect()->back()->with('echec', "Veuillez patienter avant de réprendre l'operation");
        }
        dd("delivrer");
        dd($id);
    }
}
