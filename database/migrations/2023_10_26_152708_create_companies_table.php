<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // title
            $table->string('title');
            // desc
            $table->string('desc')->nullable();
            // url_logo
            $table->string('url_logo')->nullable();
            // url_website
            $table->string('url_website')->nullable();
            // siret
            $table->string('siret');
            // address
            $table->string('address');
            // address
            $table->string('address2')->nullable();
            // zip_code
            $table->integer('zip_code');
            // city
            $table->string('city');
            // id_country
            $table->foreignId('id_country')->constrained('countries');
            // primary_color
            $table->string('primary_color')->nullable();
            // secondary_color
            $table->string('secondary_color')->nullable();
            // data
            $table->json('data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
