<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * WhatsApp Business app numbers connected through Embedded Signup
     * (Coexistence), with their business token (encrypted).
     */
    public function up(): void
    {
        Schema::create('whatsapp_onboardings', function (Blueprint $table) {
            $table->id();
            $table->string('waba_id', 32);
            $table->string('phone_number_id', 32)->unique();
            $table->json('phone')->nullable();
            $table->text('access_token');
            $table->timestamp('onboarded_at');
            $table->timestamp('contacts_synced_at')->nullable();
            $table->timestamp('history_synced_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('whatsapp_onboardings');
    }
};
