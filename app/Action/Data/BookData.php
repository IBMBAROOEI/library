<?php

namespace App\Action\Data;

use Illuminate\Validation\Rule;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation;

class BookData extends Data
{
    public function __construct(
        #[Validation('required|string|max:255')]
        public string $title,

        #[Validation('required|string|max:255')]
        public string $author,

        #[Validation('nullable|string')]
        public ?string $description,

        #[Validation('required|date')]
        public string $published_at, // Changed to string to match validation

        #[Validation('required|numeric')]
        public float $price,
    ) {}

    // برای تعریف قوانین و پیام‌های خطا
    public static function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'published_at' => 'required|date',
            'price' => 'required|numeric',
        ];
    }

    public static function messages(): array
    {
        return [
            'title.required' => 'عنوان کتاب الزامی است و نباید خالی باشد.',
            'author.required' => 'نویسنده کتاب الزامی است و نباید خالی باشد.',
            'description.string' => 'توضیحات باید یک متن باشد.',
            'published_at.required' => 'تاریخ انتشار الزامی است.',
            'published_at.date' => 'تاریخ انتشار باید یک تاریخ معتبر باشد.',
            'price.required' => 'قیمت باید مشخص شود و نمی‌تواند خالی باشد.',
            'price.numeric' => 'قیمت باید یک عدد باشد.',
        ];
    }
}