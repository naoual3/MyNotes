<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Note extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       // return parent::toArray($request);
       return [
           'id'=>$this->id,
           'user_id'=>$this->user_id,
           'date'=>$this->date,
           'hour'=>$this->hour,
           'title'=>$this->title,
           'note'=>$this->note,
           'created_at'=>$this->created_at->format('d/m/Y'),
           'updated_at'=>$this->updated_at->format('d/m/Y'),
       ];
    }
}
