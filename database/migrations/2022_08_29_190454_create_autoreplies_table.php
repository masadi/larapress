<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutorepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autoreplies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('whatsapp_id')->constrained();
            $table->string('keyword', 100);
            $table->longText('reply');
            $table->decimal('aktif', 1, 0)->default(1);
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
        Schema::dropIfExists('autoreplies');
    }
}
