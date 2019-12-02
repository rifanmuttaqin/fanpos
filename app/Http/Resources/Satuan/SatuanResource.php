<?php

namespace App\Http\Resources\Satuan;

use Illuminate\Http\Resources\Json\JsonResource;

class SatuanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'nama_satuan' => $this->nama_satuan,
            'simbol_satuan' => $this->simbol_satuan,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
