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
        Schema::create('user_post_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained('user_posts')->restrictOnUpdate()->cascadeOnDelete();
            $table->foreignId('parent_id')->nullable()->constrained('user_post_comments')->restrictOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('user_post_comments');
    }
};
