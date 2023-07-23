<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->timestamp('collected_at')->index();
            $table->foreignId('user_id')->index()->nullable()->constrained();
            $table->text('action');
            $table->json('payload')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('statistics');
    }
};
