<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pret;
use App\Models\Role;
use App\Models\Admin;
use App\Models\Carte;
use App\Models\Client;
use App\Models\Compte;
use App\Models\Commande;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('adminAuth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::guard('admin')->user()->username;

        // stat de compte
        $compte_en_cours = $this->compte_en_cours();
        $compte_ouvert = $this->compte_ouvert();
        $compte_bloquer = $this->compte_bloquer();

        // stat de pret
        $pret_accord = $this->pret_accord();
        $pret_en_cours = $this->pret_en_cours();
        $pret_reject = $this->pret_reject();

        // stat carte
        $carte_commande = $this->carte_commande();
        $carte_activ = $this->carte_activ();
        $carte_reject = $this->carte_reject();

        // transactions
        $transaction = $this->transactions();

        // element agent depot
        $depot_agent = $this->admin_agent();

        // dd($compte_en_cours);
        return view('admin.dashboard', compact(
            'compte_en_cours',
            'compte_ouvert',
            "compte_bloquer",
            'pret_accord',
            'pret_en_cours',
            'pret_reject',
            'carte_commande',
            'carte_activ',
            'carte_reject',
            'transaction',
            'depot_agent'
        ));
    }

    private function compte_en_cours()
    {
        $data = Client::whereBetween('statut_ouverture_compte', [1, 2])->get();
        return count($data);
    }

    private function compte_ouvert()
    {
        $data = Client::where('statut_ouverture_compte', 3)->get();
        return count($data);
    }

    private function compte_bloquer()
    {
        $data = Client::whereBetween('statut_ouverture_compte', [-2, 0])->get();
        return count($data);
    }

    private function pret_accord()
    {
        $data = Pret::where('statut', 1)->get();
        return count($data);
    }

    private function pret_en_cours()
    {
        $data = Pret::where('statut', 0)->get();
        return count($data);
    }

    private function pret_reject()
    {
        $data = Pret::where('statut', -1)->get();
        return count($data);
    }

    private function carte_commande()
    {
        $data = Commande::all();
        return count($data);
    }

    private function carte_activ()
    {
        $data = Carte::where('statut', 1)->get();
        return count($data);
    }


    private function carte_reject()
    {
        $data = Carte::where('statut', 0)->get();
        return count($data);
    }

    private function admin_agent()
    {
        $data = Admin::where('role', 2)->paginate(5);
        return $data;
    }

    private function transactions()
    {
        $data = Transaction::paginate(5);
        return $data;
    }
}
