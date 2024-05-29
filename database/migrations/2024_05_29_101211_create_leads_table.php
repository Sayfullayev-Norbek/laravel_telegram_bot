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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->integer('telegram_id');
            $table->string('telegram_name');
            $table->string('lead_name')->nullable();
            $table->integer('lead_phone')->nullable();
            $table->integer('modme_company_id');
            $table->integer('modme_branch_id')->nullable();
            $table->integer('modme_section_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
