<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Identification;
use Carbon\Carbon;
use App\Events\ClientRegistered;

class OpenAccountController extends Controller
{
    public function Index(){
        return view('open_account');
    }

    public function openAccount(){
        $client = new Client();

        $client->track_id = "NBK-".Carbon::now()->timestamp;;
        $client->choix_type_compte = implode(",",request()->accounts);
        $client->statut_ouverture_compte = Client::STATUT['EN ATTENTE'];
        $client->sexe = request()->sexe;
        $client->civilite = request()->civilite;
        $client->nom = request()->nom;
        $client->prenoms = request()->prenoms;
        $client->date_naissance = request()->date_naissance;
        $client->lieu_naissance = request()->lieu_naissance;
        $client->nationalite = request()->nationalite;
        $client->pays_residence = request()->pays_residence;
        $client->ville = request()->ville;
        $client->lieu_residence = request()->lieu_residence;
        $client->email = request()->email;
        $client->numero_telephone1 = request()->numero_telephone1;
        $client->numero_telephone2 = request()->numero_telephone2;
        $client->statut_marital = request()->statut_marital;
        $client->profession = request()->profession;
        $client->objet_compte = request()->objet_compte;
        $client->accord_termes_conditions = request()->accord_termes_conditions == "on" ? 1 : 0;

        $client->save();

        $lastestClient = Client::latest()->first();

        $identification = new Identification();
        $identification->type_piece = request()->type_piece;
        $identification->no_piece = request()->no_piece;
        $identification->date_expiration_piece = request()->date_expiration_piece;
        $identification->pays_emission_piece = request()->pays_emission_piece;
        $identification->client_id = $lastestClient->id;
        $photo = request()->photo;
        $photoFileName = "PHOTO.".$photo->extension();
        request()->photo->storeAs("clients/pieces/$client->track_id", $photoFileName, "public");

        $piece_recto = request()->piece_recto;
        $pieceRectoFileName = "PIECE-R.".$piece_recto->extension();
        request()->piece_recto->storeAs("clients/pieces/$client->track_id.", $pieceRectoFileName, "public");

        $piece_verso = request()->piece_verso;
        $pieceVersoFileName = "PIECE-V.".$piece_verso->extension();
        request()->piece_verso->storeAs("clients/pieces/$client->track_id", $pieceVersoFileName, "public");

        $facture_electricite = request()->facture_electricite;
        if($facture_electricite){
            $factureEleFileName = "FACTURE ELECTRICITE.".$facture_electricite->extension();
            request()->facture_electricite->storeAs("clients/pieces/$client->track_id", $factureEleFileName, "public");
        }else{
            $factureEleFileName = "";
        }

        $facture_eau = request()->facture_eau;
        if($facture_eau){
            $factureEauFileName = "FACTURE ELECTRICITE.".$facture_eau->extension();
            request()->facture_eau->storeAs("clients/pieces/$client->track_id", $factureEauFileName, "public");
        }else{
            $factureEauFileName = "";
        }

        $certificat_residence = request()->certificat_residence;
        $certificatResidenceFileName = "CERTIFCAT RESIDENCE.".$certificat_residence->extension();
        request()->certificat_residence->storeAs("clients/pieces/$client->track_id", $certificatResidenceFileName, "public");

        $signature = request()->signature;
        $signatureFileName = "SIGNATURE.".$signature->extension();
        request()->signature->storeAs("clients/pieces/$client->track_id", $signatureFileName, "public");

        $identification->photo = $photoFileName;
        $identification->piece_recto = $pieceRectoFileName;
        $identification->piece_verso = $pieceVersoFileName;
        $identification->facture_electricite = $factureEleFileName;
        $identification->facture_eau = $factureEauFileName;
        $identification->certificat_residence = $certificatResidenceFileName;
        $identification->signature = $signatureFileName;
        $identification->save();

        ClientRegistered::dispatch($lastestClient);

        return redirect('/open-account/success');
    }

    public function openAccountSuccess(){
        $client = Client::latest()->first();
        return view('open-account-success', ["client" => $client]);
    }
}
