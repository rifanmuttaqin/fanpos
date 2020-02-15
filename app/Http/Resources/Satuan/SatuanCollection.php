<?php

namespace App\Http\Resources\Satuan;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Model\Satuan\Satuan;

/**
 * 
 */
class SatuanCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $this->collection->transform(function (Satuan $satuan) {
            return new SatuanResource($satuan);
        });

        return parent::toArray($request);
    }

}