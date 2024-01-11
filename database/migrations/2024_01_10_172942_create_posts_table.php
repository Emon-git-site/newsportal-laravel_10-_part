<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->integer('division_id');
            $table->integer('district_id');
            $table->integer('user_id');
            $table->string('title_bn');
            $table->string('title_en');
            $table->string('image');
            $table->text('details_en')->nullable();
            $table->text('details_bn');
            $table->text('tag_bn');
            $table->text('tag_en')->nullable();
            $table->integer('headline')->nullable();
            $table->integer('first_section')->nullable();
            $table->integer('first_section_thumbnail')->nullable();
            $table->integer('bigthumbnail')->nullable();
            $table->string('post_date')->default(DB::raw('CURRENT_DATE'));
            $table->string('post_month')->default(DB::raw('DATE_FORMAT(CURRENT_DATE, "%Y-%m")'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
