<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->Increments('kd_produk');
            // unsigned integer berarti integer tidak bisa menyimpan nilai negatif
            $table->unsignedInteger('kd_kategori');
            // kolom kd_kategori di relasikan dengan kolom kd_kategori pada tabel kategori
            $table->foreign ('kd_kategori')->references('kd_kategori')->on('kategori');
            $table->string('nama_produk',255);
            $table->integer('harga');
            $table->string('gambar_produk',255);
            $table->integer('stok');
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
        // menghapus foreign key pada kd_kategori
        Schema::table('produk',function(Blueprint $table){
            $table->dropForeign(['kd_kategori']);
        });
        Schema::dropIfExists('produk');
    }
}
