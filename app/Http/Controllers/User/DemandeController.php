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

class DemandeController extends Controller
{
    public function rib(Request $request)
    {
        dd($request);
        $pdf = App::make('dompdf.wrapper');

        $client = Client::where('id', Auth::user()->client_id)->first();
        $compte = Compte::findOrfail($request->compte)->first();
        // dd($compte);
        // dd($client);
        // $pdf = PDF::loadView('email.rib', compact(["compte", "client"]));
        $pdf = $pdf->loadView('emails.rib', compact(['compte', 'client']));


        switch ($request->options) {
            case 'mail':
                Mail::to($client->email)->send(new RibAskMail($client, $compte));
                return redirect()->back()->with('success', "Un mail vous a ete envoyer veuillez le consulter svp");
                break;

            case 'two':
                Mail::to($client->email)->send(new RibAskMail($client, $compte));
                return $pdf->download($compte->numero_compte . "-rib.pdf");
                break;

            case 'download':
                return $pdf->download($compte->numero_compte . "-rib.pdf");
                break;

            default:
                return redirect()->back()->with('echec', "Veuillez reessayer plus tard merci");
                break;
        }
    }
}
