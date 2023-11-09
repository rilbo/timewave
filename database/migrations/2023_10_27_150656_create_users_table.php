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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // firstname
            $table->string('firstname', 100);
            // lastname
            $table->string('lastname', 100);
            // email
            $table->string('email',150)->unique();
            // password
            $table->string('password',255);
            // job
            $table->string('job', 40)->nullable();
            // url_profil_picture
            $table->string('url_profil_picture',255)->nullable();
            // id_role
            $table->foreignId('id_role', 1)->default(3)->constrained('roles'); // 1 = superadmin, 2 = admin, 3 = user
            // id_company
            $table->foreignId('id_company')->constrained('companies');
            //token
            $table->rememberToken();
            // email_verified_at
            $table->timestamp('email_verified_at')->nullable();
            // data
            $table->json('data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
