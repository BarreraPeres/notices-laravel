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
        Schema::create('notification_users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId("id_notification")->constrained("notifications");
            $table->foreignId("id_user")->constrained("users");
            $table->boolean("seen")->default(false);
            $table->date("date_seen")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications_user');
    }
};
