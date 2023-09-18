<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sticker_pack_resolvers', function (Blueprint $table) {
            $table->id();
            $table->string('file_id');
            $table->foreignId('pack_id')->constrained();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sticker_pack_resolvers');
    }
};
