<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('custom_id');
            $table->decimal('total_price', 13, 2);
            $table
                ->enum('payment_status', ['1', '2', '3', '4'])
                ->comment(
                    '1=menunggu pembayaran, 2=sudah dibayar, 3=kadaluarsa, 4=batal'
                );
            $table->string('snap_token', 36)->nullable();
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
        Schema::dropIfExists('payments');
    }
}
