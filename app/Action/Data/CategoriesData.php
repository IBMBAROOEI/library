<?php

namespace App\Action\Data;


use Illuminate\Validation\Rule;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation;

class CategoriesData extends Data
{
    public function __construct(
        #[Validation('required|string')]
        public string $name,


    ) {}

    public static function rules(): array
    {
        return [
            'name' => 'required|string',


		];
    }

    public static function messages(): array
    {
        return [
            'name.required' => 'دسته بندی  کتاب الزامی است و نباید خالی باشد.',

        ];
    }
}
