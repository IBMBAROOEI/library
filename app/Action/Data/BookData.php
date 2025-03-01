<?php

namespace App\Action\Data;

use App\BookStatus;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation;

class BookData extends Data
{
    public function __construct(
        #[Validation('required|string')]
        public string $title,

        #[Validation('required|string')]
        public string $author,

        #[Validation('nullable|string')]
        public ?string $description = null,

        #[Validation('required|date')]
        public string $published_at,
        #[Validation('required|numeric|min:0')]
        public float $price,

        #[Validation('required|integer|min:0')]
        public int $stock_quantity = 0,

        #[Validation('nullable|string')]
        public ?string $language = null,

        #[Validation('nullable|integer')]
        public ?int $page_count = null,
   #[Validation('nullable|image|mimes:jpg,jpeg,png,bmp|max:2048')]
        public ?string $cover_image = null,

		#[Validation('in:' . BookStatus::Active->value . ',' . BookStatus::Deactive->value)]
		public ?string $type = BookStatus::Active->value
    ) {}

    // برای تعریف قوانین و پیام‌های خطا
    public static function rules(): array
    {
        return [
            'title' => 'required|string',
            'author' => 'required|string',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,bmp|max:2048', // قوانین تصویر
            'published_at' => 'required|date',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'language' => 'nullable|string', // می‌تواند یک رشته خیالی باشد
            'page_count' => 'nullable|integer|min:0', // تعداد صفحات می‌تواند منفی نباشد
			'type' => 'in:' . BookStatus::Active->value . ',' . BookStatus::Deactive->value,

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
            'price.min' => 'قیمت نمی‌تواند منفی باشد.',
            'stock_quantity.required' => 'مقدار موجودی الزامی است.',
            'stock_quantity.integer' => 'مقدار موجودی باید یک عدد صحیح باشد.',
            'stock_quantity.min' => 'مقدار موجودی نمی‌تواند منفی باشد.',
            'language.string' => 'زبان باید یک متن باشد.',
            'page_count.integer' => 'تعداد صفحات باید یک عدد صحیح باشد.',
            'page_count.min' => 'تعداد صفحات نمی‌تواند منفی باشد.',
            'type.in' => 'نوع کتاب را مشخص کنید.',
              'cover_image.image' => 'تصویر باید از نوع تصویر باشد.',
            'cover_image.mimes' => 'تصویر باید از نوع jpg، jpeg، png، یا bmp باشد.',
            'cover_image.max' => 'اندازه تصویر نباید بیشتر از 2048 کیلوبایت باشد.',
        ];
    }
}
