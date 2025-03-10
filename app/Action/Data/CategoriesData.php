<?php

namespace App\Action\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation;
use Spatie\LaravelData\Attributes\Unique;

class CategoriesData extends Data
{


    #[Validation('required', 'string', 'name', 'unique:categories')]


    public string $name;






    // برای تعریف قوانین و پیام‌های خطا
    public static function rules(): array
    {
        return [
            'name' => 'required|string',
            'name.unique' => 'required|string|unique:categories,name|name',




        ];
    }

    public static function messages(): array
    {
        return [
            'name.required' => 'نام دسته‌بندی الزامی است.',
            'name.string' => 'نام دسته‌بندی باید یک متن باشد.',
            'name.unique' => 'این نام دسته‌بندی قبلاً ثبت شده است.',
        ];
    }
}
