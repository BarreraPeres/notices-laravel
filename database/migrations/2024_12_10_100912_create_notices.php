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
            $table->enum("user_type", [
                "all",
                "students",
                "teachers",
                "financial"
            ]);
            $table->string("procedure");
            $table->string("description");
            $table->string("brief_description");
            $table->string("author");
            $table->boolean("generate_pop_up")->default(false)->nullable();
            $table->date("pop_up_expiration")->nullable();
            $table->string("pop_up_image")->nullable();
            $table->boolean("notice_active")->default(true);
            $table->date("date_inactivation")->nullable();
            $table->string("motive_inactivation")->nullable();
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
