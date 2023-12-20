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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id_fk');
            $table->unsignedBigInteger('package_id_fk');
            $table->unsignedBigInteger('user_id_fk');
            $table->string('status');
            $table->integer('percent');
            $table->float('price');
            $table->float('Ded_amount');
            $table->float('commission');
            $table->float('current_balance');
            $table->foreign('branch_id_fk')->references('id')->on('branches');
            $table->foreign('package_id_fk')->references('id')->on('packages');
            $table->foreign('user_id_fk')->references('id')->on('users');
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
