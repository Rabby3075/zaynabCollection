<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('companyName')->nullable();
            $table->string('businessType')->nullable();
            $table->string('businessMoto')->nullable();
            $table->string('fbLink')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->text('address')->nullable();
            $table->string('ownerName')->nullable();
            $table->string('logo')->nullable();
            $table->text('details')->nullable();
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
        Schema::dropIfExists('companies');
    }
};
