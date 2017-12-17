<?php

namespace App\Http\Resources;

use App\ApplicationStatus;
use Illuminate\Http\Resources\Json\Resource;

class Application extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "type" => $this->type->name,
        ];
    }
}