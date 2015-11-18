<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EventInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('event_invoice', function (Blueprint $table) {
            $table->increments('Id');
            $table->string('CientAddress');
            $table->string('ClientName');
            $table->string('ClientEmail');
            $table->string('RepresentativeNo');
            $table->string('InvoiceDate');
            $table->string('DueDate');
            $table->string('Particulars');
            $table->string('AnnualSerialNo');
            $table->string('AnnualText');
            $table->string('AnnualCurrencyType');
            $table->string('AnnualAmount');
            $table->string('SerialNo');
            $table->string('EventName');
            $table->string('CurrencyType');
            $table->string('Amount');
            $table->string('ServiceTax');
            $table->string('ServiceTaxAmount');
            $table->string('GrandTotal');
            $table->string('AmountInWords');
            $table->string('PaymentTerms');
            $table->string('InvoiceCode');
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
         Schema::drop('event_invoice');
    }
}
