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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable()->unique();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('birth_place')->nullable();
            $table->enum('gender', ['laki-laki', 'perempuan']);
            $table->enum('marital_status', ['belum menikah', 'menikah', 'cerai', 'janda', 'duda'])->default('belum menikah');
            $table->string('occupation')->nullable();
            $table->string('education')->nullable();
            $table->date('baptism_date')->nullable();
            $table->string('baptism_place')->nullable();
            $table->date('sidi_date')->nullable();
            $table->string('sidi_place')->nullable();
            $table->date('marriage_date')->nullable();
            $table->string('marriage_place')->nullable();
            $table->enum('status', ['aktif', 'tidak aktif', 'pindah', 'meninggal'])->default('aktif');
            $table->string('photo')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('father_id')->nullable()->constrained('members')->onDelete('set null');
            $table->foreignId('mother_id')->nullable()->constrained('members')->onDelete('set null');
            $table->foreignId('spouse_id')->nullable()->constrained('members')->onDelete('set null');
            $table->foreignId('family_id')->nullable()->constrained('families')->onDelete('set null');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
