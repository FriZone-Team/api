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
        Schema::create('user_attributes', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->restrictOnUpdate()->cascadeOnDelete();
            $table->foreignId('attribute_id')->constrained('system_user_attributes')->restrictOnUpdate()->cascadeOnDelete();
            $table->string('value')->nullable();
            $table->unique(['user_id', 'attribute_id']);
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
        Schema::dropIfExists('user_attributes');
    }
};
