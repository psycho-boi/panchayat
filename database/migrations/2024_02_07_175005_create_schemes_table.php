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
        Schema::create('schemes', function (Blueprint $table) {
            // $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('eligibility');
            $table->dateTime('start_datetime');
            $table->dateTime('end_datetime');
            $table->boolean( 'is_active' )->default( true );
            $table->id('scheme_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schemes');
    }
};
