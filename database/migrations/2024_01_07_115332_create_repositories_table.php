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
        Schema::create('repositories', function (Blueprint $table) {
            $table->id("ff_id");
            $table->string("group_no");
            $table->boolean("is_folder");
            $table->integer("sub_ff_of")->nullable();
            $table->string("file_path")->nullable();
            $table->string("ff_title");
            $table->string("file_size")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repositories');
    }
};
