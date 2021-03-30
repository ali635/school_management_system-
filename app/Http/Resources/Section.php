<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Section extends JsonResource
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
            'Name_Section'=> $this->getTranslation('Name_Section',app()->getLocale($request->lang)),
            'Status'=> $this->Status,
            'Class_id'=> $this->Class_id,
            'Grade_id'=> $this->Grade_id,
            'teacher_id'=> $this->teacher_id,
            'created_at'=> $this->created_at->format('d/m/Y'),
            'updated_at'=> $this->updated_at->format('d/m/Y'),
        ];
    }
}
