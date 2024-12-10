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
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("title");
            $table->string("procedure");
            $table->string("description");
            $table->string("brief_description");
            $table->string("author");
            $table->boolean("generate_pop_up")->default(false)->nullable();
            $table->date("pop_up_expiration")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notices');
    }
};
