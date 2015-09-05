<?php

use Illuminate\Database\Migrations\Migration;

class CreateChatsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('chats', function($table) {
            $table->increments('id');
            $table->string('user1_id');
            $table->string('user2_id');
            $table->boolean('user1_typing')->default(false);
            $table->boolean('user2_typing')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('chats');
    }

}
