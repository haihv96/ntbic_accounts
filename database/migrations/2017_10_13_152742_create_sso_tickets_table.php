<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSsoTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sso_tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sso_ticket_secret')->unique();
            $table->text('access_token')->nullable();
            $table->string('username_input')->nullable();
            $table->string('password_input')->nullable();
            $table->string('message')->nullable();
            $table->string('return_url')->nullable();
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
        Schema::dropIfExists('sso_tickets');
    }
}
