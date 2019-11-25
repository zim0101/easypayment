<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMolliePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mollie_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('currency', 10);
            $table->unsignedDecimal('amount', 7,2);
            $table->string('description');
            $table->string('redirect_url')->nullable();
            $table->string('web_hook_url')->nullable();
            $table->string('locale')->nullable();
            $table->text('metadata')->nullable();
            $table->string('sequence_type')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('mandate_id')->nullable();
            $table->string('bank_transfer_billing_email')->nullable();
            $table->string('bank_locale')->nullable();
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
        Schema::dropIfExists('mollie_payments');
    }
}
