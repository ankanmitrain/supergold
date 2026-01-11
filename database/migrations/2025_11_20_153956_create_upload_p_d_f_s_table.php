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
        Schema::create('UploadPDF', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('pdf_path');
            $table->date('publish_date')->nullable();
            $table->time('publish_time')->nullable();
            $table->boolean('enable_pdf')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('UploadPDF');
    }
};



