<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Class_room extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        return [
            'id'=> $this->id,
            'Name_Class'=> $this->getTranslation('Name_Class',app()->getLocale($request->lang)),
            'Grade_id'=> $this->Grade_id,
            'created_at'=> $this->created_at->format('d/m/Y'),
            'updated_at'=> $this->updated_at->format('d/m/Y'),
        ];
    }
}
