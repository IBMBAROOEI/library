<?php

use App\BookStatus;
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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');


            $table->text('description')->nullable();
            $table->enum('type', array_map(fn($status) => $status->value, BookStatus::types()))
                ->default(BookStatus::Deactive->value);
            $table->decimal('price', 10, 3);
            $table->date('published_at');
                       $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
