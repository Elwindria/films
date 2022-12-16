<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("actor");
            $table->string("director");
            $table->integer("year");
            $table->enum('category', ['action', 'aventure', 'biblique', 'catastrophe','comédie' , 'comédie-française', 'comédie-dramatique', 'comédie-policière', 'dessin-animé', 'documentaire', 'drame', 'espionnage', 'fait-vécu', 'fantastique', 'guerre', 'policier', 'horreur', 'science-fiction', 'série', 'super-héros', 'thriller', 'vieux-film', 'western']);
            $table->enum('type', ['available', 'unavailable', 'need']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('films');
    }
};
