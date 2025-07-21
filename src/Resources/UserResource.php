<?php

namespace Zefy\LaravelSSO\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request): array
    {
        return array_map(
            fn($value) => $this->{$value},
            config('laravel-sso.userFields')
        );
    }
}
