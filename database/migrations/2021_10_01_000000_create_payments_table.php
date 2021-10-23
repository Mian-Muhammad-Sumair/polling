<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
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
            $table->text('first_name');
            $table->text('last_name');
            $table->text('email');
            $table->string('country');
            $table->string('city');
            $table->string('state');
            $table->string('amount');
            $table->string('payment_mode');
            $table->string('name_on_card');
            $table->string('card_number');
            $table->string('card_expiry');
            $table->string('security_code');
            $table->date('approved_date')->nullable();
            $table->boolean('status')->default(0);
            $table->text('subscription_plan_value_id');
            $table->text('user_id');
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
