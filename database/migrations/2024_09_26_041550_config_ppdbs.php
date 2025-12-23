<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('config_ppdbs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('link_group_smp');
            $table->string('link_group_sma');
            $table->string('qr_code_smp')->nullable();
            $table->string('qr_code_sma')->nullable();
            $table->boolean('status')->default(true);
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('config_ppdbs');
    }
};
