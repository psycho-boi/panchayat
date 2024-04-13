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
        Schema::create('online_facilities', function (Blueprint $table) {
            $table->string('title');
            $table->text('description');
            // $table->integer('rent');
            $table->boolean( 'is_active' )->default( true );
            $table->id('facility_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('online_facilities');
    }
};
