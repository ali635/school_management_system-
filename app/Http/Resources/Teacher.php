<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Teacher extends JsonResource
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
            'Name'=> $this->getTranslation('Name',app()->getLocale($request->lang)),
            'Email'=> $this->Email,
            //'Password'=> $this->Password,
            'Specialization_id'=> $this->Specialization_id,
            'Gender_id'=> $this->Gender_id,
            'Joining_Date'=> $this->Joining_Date,
            'Address'=> $this->Address,
            'created_at'=> $this->created_at->format('d/m/Y'),
            'updated_at'=> $this->updated_at->format('d/m/Y'),
        ];
    }
}