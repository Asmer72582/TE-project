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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id("task_id");
            $table->integer("week_no")->nullable();
            $table->string("task_title");
            $table->string("task_remark")->nullable();
            $table->date("task_due_date")->nullable();
            $table->date("task_completed_date")->nullable();
            $table->boolean("task_status")->nullable();
            $table->string("group_no");
            $table->integer("task_folder")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
