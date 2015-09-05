<?php

use Illuminate\Database\Migrations\Migration;

class CreateChatMessagesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('chats_messages', function($table) {
            $table->increments('id');
            $table->string('sender_user_id');
            $table->text('message');
            $table->boolean('read')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('chats_messages');
    }

}
