<?php

namespace App\Http\Resources\Supplier;

use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        'nama' => $this->nama,
        'alamat' => $this->alamat,
        'nomor_telfon' => $this->nomor_telfon,
        'email' => $this->email,  
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at
    }
}
