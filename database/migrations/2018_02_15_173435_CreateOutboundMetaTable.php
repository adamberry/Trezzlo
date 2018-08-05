<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutboundMetaTable extends Migration
{
    const TABLE = 'message.outbound_meta';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->increments('id');
            $table->integer('outbound_id');
            $table->string('message_id');
            $table->integer('handle_id')->nullable();
            $table->integer('contact_id')->nullable();
            $table->integer('mechanism_id');
            $table->timestamps();
            $table->index('outbound_id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(self::TABLE);
    }
}
