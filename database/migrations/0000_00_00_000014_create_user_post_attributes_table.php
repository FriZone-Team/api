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
        Schema::create('user_post_attributes', function (Blueprint $table) {
            $table->foreignId('post_id')->constrained('user_posts')->restrictOnUpdate()->cascadeOnDelete();
            $table->foreignId('attribute_id')->constrained('system_user_post_attributes')->restrictOnUpdate()->cascadeOnDelete();
            $table->string('value')->nullable();
            $table->unique(['post_id', 'attribute_id']);
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
        Schema::dropIfExists('user_post_attributes');
    }
};
