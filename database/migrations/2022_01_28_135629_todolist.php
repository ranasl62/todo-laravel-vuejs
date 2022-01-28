<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Todolist extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todo_list', function (Blueprint $table) {
            $table->id();
            /**
             *  Refer to  todo unique ID. Unique char(36) string.
             */
            $table->uuid('tuid');
            /**
             * The title of the todo item
             */
            $table->string('title', 128);
            /**
             * The status of the todo item. It's indicate the task is completed or not
             */
            $table->boolean('status')->default(0);
            /**
             * Add a "deleted at" timestamp for this table.
             */
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
