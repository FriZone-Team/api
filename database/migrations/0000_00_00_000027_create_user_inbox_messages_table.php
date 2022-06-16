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
        Schema::create('user_inbox_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inbox_id')->constrained('user_inboxes')->restrictOnUpdate()->cascadeOnDelete();
            $table->foreignId('owner_id')->constrained('users')->restrictOnUpdate()->cascadeOnDelete();
            $table->foreignId('parent_id')->nullable()->constrained('user_inbox_messages')->restrictOnUpdate()->cascadeOnDelete();
            $table->foreignId('type_id')->constrained('system_message_types')->restrictOnUpdate()->cascadeOnDelete();
            $table->foreignId('sticker_id')->nullable()->constrained('system_stickers')->restrictOnUpdate()->cascadeOnDelete();
            $table->json('data');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_inbox_messages');
    }
};
