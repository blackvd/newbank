<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string("track_id", 15);
            $table->string("sexe", 10)->nullable(true);
            $table->string("civilite", 5)->nullable(true);
            $table->string("nom", 70)->nullable(true);
            $table->string("prenoms", 200)->nullable(true);
            $table->date("date_naissance")->nullable(true);
            $table->string("lieu_naissance", 100)->nullable(true);
            $table->string("nationnalite", 150)->nullable(true);
            $table->string("pays_residence", 150)->nullable(true);
            $table->string("ville", 100)->nullable(true);
            $table->string("lieu_residence", 200)->nullable(true);
            $table->string("email", 170)->nullable(true);
            $table->string("numero_telephone1", 170)->nullable(true);
            $table->string("numero_telephone2", 170)->nullable(true);
            $table->string("statut_marital", 15)->nullable(true);
            $table->string("secteur_activite", 200)->nullable(true);
            $table->string("profession", 200)->nullable(true);
            $table->string("choix_type_compte", 3);
            $table->string("objet_compte")->nullable(true);
            $table->integer("etape")->default(0);
            $table->integer("statut_ouverture_compte");
            $table->boolean("accord_termes_conditions")->default(false);
            $table->integer("admin_code")->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
