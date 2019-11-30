<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'nomor_telfon' => $this->nomor_telfon,
            'email' => $this->email,  
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}