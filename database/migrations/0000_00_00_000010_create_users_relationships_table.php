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
        Schema::create('user_relationships', function (Blueprint $table) {
            $table->foreignId('from_id')->constrained('users')->restrictOnUpdate()->cascadeOnDelete();
            $table->foreignId('to_id')->constrained('users')->restrictOnUpdate()->cascadeOnDelete();
            $table->foreignId('relationship_id')->constrained('system_user_relationships')->restrictOnUpdate()->restrictOnDelete();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['from_id', 'to_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_relationships');
    }
};
