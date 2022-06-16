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
        Schema::create('user_inbox_members', function (Blueprint $table) {
            $table->foreignId('inbox_id')->constrained('user_inboxes')->restrictOnUpdate()->cascadeOnDelete();
            $table->foreignId('member_id')->constrained('users')->restrictOnUpdate()->cascadeOnDelete();
            $table->foreignId('role_id')->constrained('system_member_roles')->restrictOnUpdate()->restrictOnDelete();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['inbox_id', 'member_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_inbox_members');
    }
};
