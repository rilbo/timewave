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
        Schema::create('times', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // work_leave - boolean
            $table->boolean('work_leave')->nullable();
            // Sick - boolean
            $table->boolean('sick')->nullable();
            // id_name_site_morning
            $table->foreignId('id_name_site_morning')->constrained('name_site');
            // begin_date_morning
            $table->dateTime('begin_date_morning');
            // end_date_morning
            $table->dateTime('end_date_morning');
            // id_name_site_afternoon
            $table->foreignId('id_name_site_afternoon')->constrained('name_site');
            // begin_date_afternoon
            $table->dateTime('begin_date_afternoon');
            // end_date_afternoon
            $table->dateTime('end_date_afternoon');
            // more_times
            $table->integer('more_times')->nullable();
            // bowl - boolean
            $table->boolean('bowl')->nullable();
            // id_user
            $table->foreignId('id_user')->constrained('users');
            // id_company
            $table->foreignId('id_company')->constrained('companies');
            // done
            $table->boolean('done')->nullable();
            // json
            $table->json('data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('times');
    }
};
