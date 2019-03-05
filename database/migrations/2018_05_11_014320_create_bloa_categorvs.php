<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBloaCategorvs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bloa_categorvs', function (Blueprint $table) {
            $table->increments('id')->comment('ID');
            $table->string('cat_name',30)->comment('分类名称');
            $table->unsignedInteger('user_id')->comment('用户ID');
            $table->index('user_id');

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
        Schema::dropIfExists('bloa_categorvs');
    }
}
