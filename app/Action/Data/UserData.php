<?php
namespace App\Action\Data;

use Illuminate\Validation\Rule;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation;


 class UserData  extends data{



 public function __construct(
        #[Validation('required|email|')]
        public string $email,

        #[Validation('required|string|max:9|regex:/
        [a-z]/regex:[A-Z]/|regex:/[0-9]
        /|regex:/[@$!%*?&]/')]
        public string $password,

    ) {}

    // برای تعریف قوانین و پیام‌های خطا
    public static function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => ['required|max:8',
            'string',
            'regex:/[a-z]/',
            'regex:/[A-Z]/',
            'regex:/[0-9]/',
            'regex:/[@$!%*?&]/',
            ]

		];
    }

    public static function messages(): array
    {
        return [
           'email.required'=>'ایملیل الزامی است',
           'email.required'=>'ایملیل الزامی است',
           'password.required'=>'رمز عبور الزامی است ',
         'password.min'=>'رمز عبور باید 8کاراکتر باشد  ',
            'password.regex' => 'رمز عبور باید حداقل یک حرف بزرگ، یک حرف کوچک، یک عدد، و یک کاراکتر ویژه شامل شود.',



        ];
    }


 }
