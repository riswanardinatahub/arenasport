<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnBookTimeAndBookDateToTableTransactionDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_details', function (Blueprint $table) {
             $table->string('book_date')->nullable()->after('price');
             $table->string('book_time')->nullable()->after('book_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_details', function (Blueprint $table) {
             $table->dropColumn('book_date');
             $table->dropColumn('book_time');
            
        });
    }
}
