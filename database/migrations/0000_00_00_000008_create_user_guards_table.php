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
        Schema::create('user_guards', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->restrictOnUpdate()->cascadeOnDelete();
            $table->foreignId('guard_id')->constrained('system_user_guards')->restrictOnUpdate()->cascadeOnDelete();
            $table->string('key')->nullable()->unique();
            $table->json('data')->nullable();
            $table->date('expired_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['user_id', 'guard_id']);
            $table->unique(['guard_id', 'key']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_guards');
    }
};
