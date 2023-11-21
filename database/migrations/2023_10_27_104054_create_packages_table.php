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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('package_tag');
            $table->string('package_type');
            $table->unsignedBigInteger('sender_ID');
            $table->unsignedBigInteger('receiver_ID');
            $table->string('status');
            $table->unsignedBigInteger('from_branch_id');
            $table->unsignedBigInteger('to_branch_id');
            $table->float('weight');
            $table->foreign('sender_ID')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('receiver_ID')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('from_branch_id')->references('id')->on('branches');
            $table->foreign('to_branch_id')->references('id')->on('branches');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
