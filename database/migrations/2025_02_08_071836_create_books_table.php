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
             $table->integer('stock_quantity')->default(0);



    $table->string('language')->nullable();
 $table->foreignId('parent_id')->nullable()->constrained('books')->onDelete('cascade');


            $table->decimal('rating', 2, 1)->default(0);
            $table->integer('page_count')->nullable();
            $table->json('related_books')->nullable();
            $table->string('cover_image')->nullable();


            $table->enum('type',array_column(BookStatus::cases(),column_key: 'value'))->default('active');


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
