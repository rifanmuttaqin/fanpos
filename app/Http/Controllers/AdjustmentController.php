<?php

namespace App\Http\Controllers;

use App\Model\Stock\StockProduct;

use App\Model\Product\Product;

use App\Model\Variant\Variant;

use App\Model\Variant\VariantDetail;

use Illuminate\Http\Request;

use DB;

class AdjustmentController extends Controller
{
    /**
     * Memerlukan authentifikasi
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            if($request->get('product_id'))
            {
                $variant = Variant::findByProduct($request->get('product_id'));

                if(Product::findOrFail($request->get('product_id'))->has_varian != Product::PRODUCT_HAS_NOT_VARIANT)
                {
                    $stock_product = '';

                    $data_render = '<table class="table">';
                    $data_render .= '<thead>
                    <tr>
                    <th scope="col">No</th>
                    <th scope="col">'.$variant->nama_variant.'</th>
                    <td><input type="hidden" value="'.$variant->id.' " class="form-control" id="variant_id" name="variant_id" /></td>
                    <th scope="col">Stock</th>
                    </tr>
                    </thead>
                    <tbody>';

                    $num = 1;

                    foreach ($variant->variantDetail as $key => $variant_detail)
                    {
                        $data_render .= '<tr>
                        <th scope="row">'.$num.'</th>
                        <td>'.$variant_detail->option.'</td>
                        <td><input type="text" value="'.StockProduct::getByVariantVariantDetail($variant->id,$variant_detail->id)->stock.' " class="form-control stock" id="stock" name="stock[]" /></td>
                        <td><input type="hidden" value="'.$variant_detail->id.' " class="form-control variant" id="variant_detail" name="variant_detail[]" /></td>
                        </tr>';

                        $num++;
                    }

                    $data_render .= '</tbody>
                    </table>';

                    $data_render .= '<a  href="#" type="button" id="btnProsess" onclick="btnProsess()" class="btn btn-info"> UPDATE </a>';

                    return $data_render;
                }
                else
                {
                    $data_render =

                    '<div class="form-group">
                    <label>Jumlah Stock</label>
                        <td><input type="hidden" value="'.$variant->id.' " class="form-control" id="variant_id" name="variant_id" /></td>
                        <td><input type="hidden" value="'.VariantDetail::getDetailSingleProduct($variant->id)->id.' " class="form-control variant" id="variant_detail" name="variant_detail" /></td>
	                  <input type="text" class="form-control form-control-user stock" name ="stock" id="stock" value="'.StockProduct::getByVariantVariantDetail($variant->id,VariantDetail::getDetailSingleProduct($variant->id)->id)->stock.'" placeholder="Stock">
                    </div>';

                    $data_render .= '<a  href="#" type="button" id="btnProsess" onclick="btnProsess()" class="btn btn-info"> UPDATE </a>';

                    return $data_render;
                }
            }
        }
        else
        {
            return view('adjustment.index', ['active'=>'adjustment']);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Stock\StockProduct  $stockProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        DB::beginTransaction();
        
        $data = $request->get('array_result');

        if($request->get('array_result'))
        {
            if(Product::findOrFail($data['prduct_id'])->has_varian != Product::PRODUCT_HAS_NOT_VARIANT)
            {
                foreach ($data['variant_detail_id'] as $key => $variant_detail) 
                {
                    $stock_product = StockProduct::findByVariant($data['prduct_id'],$data['variant_id'],$variant_detail);

                    $stock_product->product_id          = $data['prduct_id'];
                    $stock_product->variant_id          = $data['variant_id'];
                    $stock_product->variant_detail_id   = $variant_detail;
                    $stock_product->stock              = $data['stock'][$key];

                    if(!$stock_product->save())
                    {
                        DB::rollBack();
                        return $this->getResponse(true,400,'','Adjusment gagal dibuat');
                    }
                    
                    // Save History Stock
                }
            }
            else
            {
                $stock_product = StockProduct::findByVariant($data['prduct_id'],$data['variant_id'],$data['variant_detail'][0]);
                $stock_product->stock  = $data['stock'][0];

                if(!$stock_product->save())
                {
                    DB::rollBack();
                    return $this->getResponse(true,400,'','Adjusment gagal dibuat');
                }

                // Save History Stock

            }

            DB::commit();
            return $this->getResponse(true,200,'','Adjusment berhasil dibuat');
                       
        }
    }
}
