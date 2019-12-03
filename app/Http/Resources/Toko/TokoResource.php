<?php

namespace App\Http\Resources\Toko;

use Illuminate\Http\Resources\Json\JsonResource;

class TokoResource extends JsonResource
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
            'nama_toko' => $this->nama_toko,
            'npwp' => $this->npwp,
            'alamat_toko' => $this->alamat_toko,
            'nomor_telfon' => $this->nomor_telfon,
            'email' => $this->email,
            'fax' => $this->fax,
            'website' => $this->website, 
            'kode_pos' => $this->kode_pos,
            'logo_url' => $this->logo_url,  
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
