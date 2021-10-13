<?php

namespace App\Http\Controllers\User;

use App\Models\Client;
use App\Models\Compte;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Mail\RibAskMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use PHPUnit\Util\TestDox\CliTestDoxPrinter;

class DemandeController extends Controller
{
    public function rib(Request $request)
    {
        $pdf = App::make('dompdf.wrapper');

        $client = Client::where('id', Auth::user()->client_id)->first();
        $compte = Compte::findOrfail($request->compte)->first();
        $pdf = $pdf->loadView('emails.rib', compact(['compte', 'client']));

        $request->flash();

        switch ($request->options) {
            case 'mail':
                Mail::to($client->email)->send(new RibAskMail($client, $compte));
                return redirect()->back()->with('success', "Un mail vous a ete envoyer veuillez le consulter svp");
                break;

            case 'two':
                Mail::to($client->email)->send(new RibAskMail($client, $compte));
                Session::flash('success', "Téléchargement du pdf et l'envoie de mail, merci de nous avoir fait confiance");
                return $pdf->download($compte->numero_compte . "-rib.pdf");
                break;

            case 'download':
                Session::flash('success', "Téléchargement en cours, merci de nous avoir fait confiance");
                return $pdf->download($compte->numero_compte . "-rib.pdf");
                break;

            default:
                return redirect()->back()->with('echec', "Veuillez reéssayer plus tard merci");
                break;
        }
    }

    public function relever(Request $request)
    {
        $from = substr($request->periode, 0, 10);
        $to = substr($request->periode, 14);
        // dd($to);
        $client = Client::whereBetween('created_at', [$from, $to])->get();
        dd($client);

        // dd($request->periode);
    }
}
