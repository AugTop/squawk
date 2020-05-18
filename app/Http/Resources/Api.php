<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Api extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
/*        return [
            'min_squawk'=> $this->min_value,
            'max_squawk' => $this->max_value];*/
    }
}
