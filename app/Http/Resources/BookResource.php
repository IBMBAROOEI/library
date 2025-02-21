<?php

namespace App\Http\Resources;
use App\BookStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'id'=>$this->id,
            'title'=>$this->title,
            'author'=>$this->author,
            'price'=>$this->price,
            'published_at'=>$this->published_at,
            'type'=>$this->getReadableType()
        ];
    }






    private function getReadableType(): string
    {
        return match ($this->type) {
            BookStatus::Active => 'active',
            BookStatus::Deactive => 'deactive',
            default => 'unknown',
        };
    }

}
