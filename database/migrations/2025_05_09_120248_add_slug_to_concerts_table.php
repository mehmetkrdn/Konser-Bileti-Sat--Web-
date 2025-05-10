<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
{
    Schema::table('concerts', function (Blueprint $table) {
        $table->string('slug')->unique()->after('baslik');
    });
}

public function down()
{
    Schema::table('concerts', function (Blueprint $table) {
        $table->dropColumn('slug');
    });
}
};
