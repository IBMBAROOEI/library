<?php

namespace App\Action\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation;

class UserData extends Data
{
    public function __construct(
        #[Validation('required', 'email', 'unique:users,email')]
        public string $email,

        #[Validation('required', 'string', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[\W]/')]
        public string $password // افزودن ویژگی پسورد
    ) {}

    public static function messages(): array
    {
        return [
            'email.required' => 'ایمیل الزامی است.',
            'email.email' => 'لطفاً یک ایمیل معتبر وارد کنید.',
            'email.unique' => 'این ایمیل قبلاً ثبت شده است.',
            'password.required' => 'رمز عبور الزامی است.',
            'password.string' => 'پسورد باید یک متن باشد.',
            'password.min' => 'پسورد باید حداقل 8 کاراکتر باشد.',
            'password.regex' => 'پسورد باید شامل حداقل یک حرف بزرگ، یک حرف کوچک، یک عدد و یک کاراکتر ویژه باشد.',
        ];
    }
}
