<?php

namespace App\Http\Controllers;

use App\Models\Compte;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeInt(Request $request)
    {
        DB::beginTransaction();

        if (($request->account_deb_trans_inter == $request->account_cred_trans_inter) || is_null($request->amount_trans_inter)) {
            return redirect()->back()->with('echec', "<strong>Transfert inter-compte</strong>: Veuillez prendre un compte different du premier ou Le montant ne doit pas etre null");
        }
        try {
            $compte_credit = Compte::where('id', $request->account_cred_trans_inter)->first();
            $compte_debit = Compte::where('id', $request->account_deb_trans_inter)->first();

            if ($compte_debit->solde < $request->amount_trans_inter) {
                return redirect()->back()->with('attention', "<strong>Transfert inter-compte</strong>: Le solde du compte a debiter est insuffisant. Votre solde est de $compte_debit->solde");
            }
            $compte_debit->solde -= (int)$request->amount_trans_inter;
            $compte_credit->solde += (int)$request->amount_trans_inter;


            $type_compte_cred = $compte_credit->type_compte == 1 ? "Courant" : "Epargne";
            $type_compte_deb = $compte_debit->type_compte == 1 ? "Courant" : "Epargne";

            $compte_debit->save();
            $compte_credit->save();

            $trans1 = Transaction::create([
                "ref" => "011",
                "credit" => $request->amount_trans_inter,
                "solde" => $compte_credit->solde,
                "libelle" => "Operation credit du compte $type_compte_deb de NewBank au compte $type_compte_cred de NewBank",
                "compte" => $compte_credit->id
            ]);

            $trans2 = Transaction::create([
                "ref" => "012",
                "credit" => $request->amount_trans_inter,
                "solde" => $compte_debit->solde,
                "libelle" => "Operation debit du compte $type_compte_deb NewBank au compte $type_compte_cred de NewBank",
                "compte" => $compte_debit->id
            ]);
            $trans1->save();
            $trans2->save();
            DB::commit();

            return redirect()->back()->with('success', "<strong>Transfert inter-compte</strong>:Le transfert a été effectué.");
        } catch (\Exception $th) {
            DB::rollback();
            return redirect()->back()->with('echec', "<strong>Transfert inter-compte</strong>:Les informations sont pas correct.");
        }
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeExt(Request $request)
    {
        DB::beginTransaction();
        $compte_credit = null;

        if (is_null($request->amount_trans_extra)) {
            return redirect()->back()->with('echec', "<strong>Transfert de client a client</strong>:Le montant ne doit pas etre null");
        }

        if (substr($request->account_cred_trans_extra, 0, 2) == "CI") {
            $compte_credit = Compte::where('numero_compte', $request->account_cred_trans_extra)->first();
        } else {
            $compte_credit = Compte::where('rib', $request->account_cred_trans_extra)->first();
        }

        try {
            $compte_debit = Compte::where('id', $request->account_deb_trans_extra)->first();
            if ($compte_credit->id == $compte_debit->id) {
                return redirect()->back()->with('attention', "<strong>Transfert de client a client</strong>: Ce compte est le meme que vous voulez debiter");
            }

            if ($compte_debit->solde < $request->amount_trans_extra) {
                return redirect()->back()->with('attention', "<strong>Transfert de client a client</strong>: Le solde du compte a debiter est insuffisant. Votre solde est de $compte_debit->solde");
            }
            $compte_debit->solde -= (int)$request->amount_trans_extra;
            $compte_credit->solde += (int)$request->amount_trans_extra;


            $type_compte_cred = $compte_credit->type_compte == 1 ? "Courant" : "Epargne";
            $type_compte_deb = $compte_debit->type_compte == 1 ? "Courant" : "Epargne";

            $compte_debit->save();
            $compte_credit->save();

            $trans1 = Transaction::create([
                "ref" => "011",
                "credit" => $request->amount_trans_extra,
                "solde" => $compte_credit->solde,
                "libelle" => "Operation credit du compte $type_compte_deb de NewBank au compte $type_compte_cred",
                "compte" => $compte_credit->id
            ]);

            $trans2 = Transaction::create([
                "ref" => "012",
                "credit" => $request->amount_trans_extra,
                "solde" => $compte_debit->solde,
                "libelle" => "Operation debit du compte $type_compte_deb NewBank au compte $type_compte_cred",
                "compte" => $compte_debit->id
            ]);
            $trans1->save();
            $trans2->save();
            DB::commit();

            return redirect()->back()->with('success', "<strong>Transfert de client a client</strong>:Le transfert a été effectué.");
        } catch (\Exception $th) {
            DB::rollback();
            dd($th);
            return redirect()->back()->with('echec', "<strong>Transfert de client a client</strong>:Les informations sont pas correct.");
        }
    }
}
