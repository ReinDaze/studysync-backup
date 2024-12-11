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
        Schema::create('hasil_gaya_belajar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Menghubungkan hasil dengan user
            $table->string('dominant_style'); // Gaya belajar dominan (Visual/Auditori/Kinestetik)
            $table->text('description'); // Deskripsi gaya belajar dominan
            $table->integer('visual_score')->default(0); // Persentase gaya belajar Visual
            $table->integer('auditori_score')->default(0); // Persentase gaya belajar Auditori
            $table->integer('kinestetik_score')->default(0); // Persentase gaya belajar Kinestetik
            $table->timestamps(); // Timestamps untuk created_at dan updated_at

            // Foreign key untuk user
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_gaya_belajar');
    }
};
