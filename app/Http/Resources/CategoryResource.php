<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /** Transform the resource into an array. */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
        ];
    }
}
