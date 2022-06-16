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
        Schema::create('user_post_comment_likes', function (Blueprint $table) {
            $table->foreignId('comment_id')->constrained('user_post_comments')->restrictOnUpdate()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->restrictOnUpdate()->cascadeOnDelete();
            $table->foreignId('type_id')->constrained('system_like_types')->restrictOnUpdate()->cascadeOnDelete();
            $table->unique(['comment_id', 'user_id']);
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
        Schema::dropIfExists('user_post_comment_likes');
    }
};
