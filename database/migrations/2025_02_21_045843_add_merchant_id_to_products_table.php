<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMerchantIdToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('merchant_id')->after('id');
            $table->foreign('merchant_id')->references('id')->on('merchants')->onDelete('no action'); // Use NO ACTION
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['merchant_id']);
            $table->dropColumn('merchant_id');
        });
    }
}