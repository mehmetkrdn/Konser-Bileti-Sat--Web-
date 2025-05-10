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
        Schema::create('concerts', function (Blueprint $table) {
            $table->id();
            $table->string('baslik');                // Konser başlığı
            $table->text('aciklama');                // Konser açıklaması
            $table->string('konum');                 // Mekan
            $table->date('tarih');                   // Tarih 
            $table->time('saat');                    // Saat 
            $table->integer('stok');                 // Bilet adedi
            $table->decimal('fiyat', 8, 2);          // Bilet fiyatı
            $table->string('gorsel')->nullable();    // Görsel dosya adı 
            $table->boolean('aktif')->default(true); // Satışta mı
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
        Schema::dropIfExists('concerts');
    }
};
