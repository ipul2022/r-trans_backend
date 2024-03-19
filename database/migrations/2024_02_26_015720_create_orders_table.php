<?php

use App\Http\Enum\ServiceTypeEnum;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
        //    $table->enum('service_type', ['R-Ride'=> ServiceTypeEnum::R_Ride, 'R-Shop'=> ServiceTypeEnum::R_Shop,'R-Pickup'=> ServiceTypeEnum::R_Pickup])->default(ServiceTypeEnum::R_Ride);
        $table->string('service');
        $table->string('gender_driver')->nullable();
            $table->string('jenis_kendaraan')->nullable();
            $table->string('alamat_penjemputan')->nullable();
            $table->string('alamat_tujuan')->nullable();
            // $table->string('alamat_pembelian')->nullable();
            // $table->string('alamat_pengambilan')->nullable();
            // $table->string('alamat_pengantaran')->nullable();
            $table->string('jadwal_pengantaran')->nullable();
            $table->string('jenis_barang')->nullable();
            $table->string('jumlah_barang')->nullable();
            $table->string('dana_talangan')->nullable();
            $table->string('berat_barang')->nullable();
            $table->string('jarak');
            $table->string('tarif');
            $table->string('status')->default('diproses');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            //nanti tambahin type order , r-ride , r-pickup,atau r-shop
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
