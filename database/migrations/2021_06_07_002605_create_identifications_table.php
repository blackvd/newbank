<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdentificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identifications', function (Blueprint $table) {
            $table->id();
            $table->string("photo", 30)->nullable(true);
            $table->string("type_piece", 30);
            $table->string("no_piece", 20);
            $table->datetime("date_expiration_piece");
            $table->string("pays_emission_piece");
            $table->string("piece_recto", 30);
            $table->string("piece_verso", 30);
            $table->string("facture_electricite", 30)->nullable(true);
            $table->string("facture_eau", 30)->nullable(true);
            $table->string("certificat_residence", 30)->nullable(true);
            $table->string("signature", 30)->nullable(true);
            $table->foreignId("client_id")->nullable(true);
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
        Schema::dropIfExists('identifications');
    }
}
