<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_comments', function (Blueprint $table) {
            $table->increments('id')->comment('ID');
            $table->longText('content')->comment('内容');
            $table->timestamps();
            $table->unsignedInteger('user_id')->comment('用户ID');
            $table->unsignedInteger('blog_id')->comment('日志ID');
            $table->unsignedInteger('zhan')->default('0')->comment('点赞人数');
            $table->index('blog_id');
            $table->engine='innodb';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_comments');
    }
}
