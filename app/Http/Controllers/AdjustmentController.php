<?php

namespace App\Http\Controllers;

use App\Model\Stock\StockProduct;

use App\Model\Product\Product;

use App\Model\Variant\Variant;

use App\Model\Variant\VariantDetail;

use Illuminate\Http\Request;

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
                if(Product::findOrFail($request->get('product_id'))->has_varian != Product::PRODUCT_HAS_NOT_VARIANT)
                {
                    $variant = Variant::findByProduct($request->get('product_id'));
                    $variant_backup = $variant;
                    $stock_product = '';

                    $data_render = '<table class="table">';
                    $data_render .= '<thead>
                    <tr>
                    <th scope="col">No</th>
                    <th scope="col">'.$variant->nama_variant.'</th>
                    <th scope="col">Stock</th>
                    </tr>
                    </thead>
                    <tbody>';

                    $num = 1;

                    foreach ($variant->variantDetail as $key => $variant)
                    {
                        $data_render .= '<tr>
                        <th scope="row">'.$num.'</th>
                        <td>'.$variant->option.'</td>
                        <td><input type="text" value="'.StockProduct::getByVariantVariantDetail($variant_backup->id,$variant->id)->stock.' " class="form-control stock" id="stock" name="stock[]" /></td>
                        <td><input type="hidden" value="'.$variant->id.' " class="form-control stock" id="variant_detail" name="variant_detail[]" /></td>
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
	                  <input type="text" class="form-control form-control-user stock" name ="stock" id="stock" placeholder="Stock">
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
        if($request->get('stock'))
        {
            dd($request->all());
        }
    }
}
