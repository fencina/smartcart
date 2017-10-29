<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEpcFieldOnProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('epc')->nullable()->after('id');
        });

        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'AddEPCToProducts']);

        Schema::table('products', function (Blueprint $table) {
            $table->string('epc')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('epc');
        });
    }
}
