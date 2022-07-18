<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->enum('role_id',[0,1])->default(0);
            $table->string('first_name',100);
            $table->string('last_name',100);
            $table->string('email',200)->unique();
            $table->string('phone',15)->nullable();
            $table->string('street_address',100)->nullable();
            $table->string('password');
            $table->string('country',50)->nullable();
            $table->string('provice',50)->nullable();
            $table->string('city',50)->nullable();
            $table->string('zip_code',10)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
