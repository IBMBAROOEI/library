<?php

namespace App\Data;


use App\BookStatus;

use Illuminate\Auth\Events\Validated;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Data;
use spatie\LaravelData\Attributes\Validation;
use Spatie\LaravelData\Attributes\Validation\Rule as ValidationRule;

 class BookData extends Data{


     public function __construct(
    #[Validated('required|string|max:255')]
    public  string $title,


       #[Validated('required|string|max:255')]
    public  string $author,



       #[Validated('nullable|string')]
    public  ?string $description,



       #[ValidationRule('required|string|in'.
       implode(',' ,BookStatus::types()))]
    public  ?string $type,


       #[ValidationRule('required|date')]
    public  ?string  $published_at,



       #[ValidationRule('required|numeric')]
    public  float $price


     ){}}