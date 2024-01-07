<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quote_history', function (Blueprint $table) {
            $table->id();
            $table->integer('id_usuario');
            $table->string('origin_currency');
            $table->string('destination_currency');
            $table->string('value_for_conversion');
            $table->string('form_of_payment');
            $table->string('value_of_the_quoted_currency');
            $table->string('purchased_value_of_quoted_currency');
            $table->string('payment_rate');
            $table->string('conversion_rate');
            $table->string('total_value_excluding_rates');
            $table->datetime('conversion_data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quote_history');
    }
};
