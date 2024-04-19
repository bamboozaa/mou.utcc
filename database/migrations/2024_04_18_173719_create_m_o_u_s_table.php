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
        Schema::create('m_o_u_s', function (Blueprint $table) {
            $table->id('mou_id');
            $table->unsignedTinyInteger('mou_no');
            $table->char('mou_year', 4);
            $table->string('subject');
            $table->string('ext_department');
            $table->bigInteger('dep_id');
            $table->char('country', 3);
            $table->date('start_date', $precision = 0);
            $table->date('end_date', $precision = 0);
            $table->string('file_path')->nullable();
            $table->integer('mou_type')->nullable();
            $table->Integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_o_u_s');
    }
};
