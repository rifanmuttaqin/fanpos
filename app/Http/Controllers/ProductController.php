<?php

namespace App\Http\Controllers;

use App\Model\Product\Product;
use App\Model\Product\ProductImage;
use App\Model\Variant\Variant;
use App\Model\Variant\VariantDetail;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;

use App\Model\Kategori\Kategori;
use App\Http\Resources\Kategori\KategoriResource;

use App\Model\Satuan\Satuan;

use App\Model\Stock\StockHistory;
use App\Model\Stock\StockProduct;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use Yajra\Datatables\Datatables;

use DB;
use Image;
use URL;


class ProductController extends Controller
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

            $data = Product::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('product_image', function($row){
                        
                        $first_product_image = ProductImage::where('product_id', $row->id)->first(); 
                       
                        if($first_product_image != null)
                        {
                            return 
                            "<img style='margin-left: auto; margin-right: auto; display: block;' src= '". URL::to('/'). '/storage/product/'. $first_product_image->image_url . "' width='50' height='50'>"; 
                        }
                        else
                        {
                            "-"; 
                        }

                    })
                    ->addColumn('variant', function($row){
                        
                        if(Product::findOrFail($row->id)->has_varian == Product::PRODUCT_HAS_VARIANT)
                        {
                            $variant = Variant::where('product_id', $row->id)->first();

                            $variant_detail_arr = [];

                            if($variant != null)
                            {   
                                foreach ($variant->variantDetail->all() as $key => $detail) {                                   
                                    array_push($variant_detail_arr, $detail->option);
                                }

                                return implode ("<br> ", $variant_detail_arr);
                            }
                            else
                            {
                                return '-';
                            }   
                        }
                        else
                        {
                            return '-';
                        }                        
                    })
                    ->addColumn('action', function($row){  
                        $btn = '
                        <button onclick="btnUbah('.$row->id.')" name="btnUbah" type="button" class="btn btn-success btn-circle btn-sm"><i class="far fa-edit"></i></button>';
                        $delete = '<button onclick="btnDel('.$row->id.')" name="btnDel" type="button" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></button>';
                        return $btn .'&nbsp'.'&nbsp'. $delete; 
                    })
                    ->rawColumns(['action','product_image','variant'])
                    ->make(true);
        }
        else
        {
            // if($this->getUserPermission('index product'))
            // {
                // $this->systemLog(false,'Mengakses Halaman Master Product');
                return view('product.index', ['active'=>'product']);   
            // }
            // else
            // {
                // $this->systemLog(true,'Gagal Mengakses Halaman Master Product');
                // return view('error.unauthorized', ['active'=>'product']);
            // }
        }
    }

    /*
     */
    public function setupInitialStock($product_id=null,$variant_id=null,$variant_detail_id=null)
    {
        DB::beginTransaction();

        $stock_product = new StockProduct();
        $stock_product->product_id = $product_id;
        $stock_product->variant_id = $variant_id;
        $stock_product->variant_detail_id = $variant_detail_id;
        $stock_product->stock = 0;
        
        if(!$stock_product->save())
        {
            DB::rollBack();
            return false;
        }

        $stock_history = new StockHistory();
        $stock_history->variant_detail_id = $variant_detail_id;
        $stock_history->stock_in = 0;
        $stock_history->stock_out = 0;
        $stock_history->current_stock = 0;

        if(!$stock_history->save())
        {
            DB::rollBack();
            return false;
        }

        DB::commit();
        return true;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if($this->getUserPermission('create product'))
        // {
            // $this->systemLog(false,'Mengakses Halaman Create Product');
            return view('product.store', ['active'=>'product']);
        // }
        // else
        // {
        //     $this->systemLog(true,'Gagal Mengakses Halaman Create product');
        //     return view('error.unauthorized', ['active'=>'product']);
        // }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        // perlu validate permission
        DB::beginTransaction();

        $product            = new Product();
        $variant            = new Variant();

        $product->nama_product      = $request->get('nama_product');
        $product->sku               = $request->get('sku');
        $product->berat             = $request->get('berat');
        $product->volume            = $request->get('volume');
        $product->merek             = $request->get('merek');
        $product->exp               = $request->get('exp');
        $product->deskripsi         = $request->get('deskripsi');
        $product->kategori_id       = $request->get('kategori_id');
        $product->satuan_id         = $request->get('satuan_id');
        // Option Product
        $product->has_grosir        = Product::PRODUCT_HAS_NOT_GROSIR;
        // Option Varian
        $request->get('varian_check') === 'on' ? $product->has_varian = Product::PRODUCT_HAS_VARIANT : $product->has_varian = Product::PRODUCT_HAS_NOT_VARIANT;

        if(!$product->save())
        {
            DB::rollBack();
            return redirect()->back()->with('alert_error', 'Gagal di simpan');
        }

        // Save Image Procuct
        if ($request->hasFile('file')) {

            foreach ($request->file('file') as $images) {
                
                $fileName   = time() . '.' . $images->getClientOriginalExtension();

                $img = Image::make($images->getRealPath());
                $img->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();                 
                });

                $img->stream();
                Storage::disk('local')->put('public/product/'.$fileName, $img, 'public');
                
                $product_image = new ProductImage();
                $product_image->product_id = $product->id;
                $product_image->image_url = $fileName;

                if(!$product_image->save())
                {
                    DB::rollBack();
                    return redirect()->back()->with('alert_error', 'Gagal di simpan');
                }
            }
        }

        // Save Varian Product
        if($request->get('varian_check') === 'on')
        {
            $variant->product_id    = $product->id;
            $variant->nama_variant  = $request->get('nama_variant');

            if(!$variant->save())
            {
                DB::rollBack();
                return redirect()->back()->with('alert_error', 'Gagal di simpan');
            }

            // Save Varian Detail
            if(!$request->get('variant_detail'))
            {
                DB::rollBack();
                return redirect()->back()->with('alert_error', 'Gagal di simpan');
            }
            
            $arr_variant_detail = [];
        
            foreach ($request->get('variant_detail') as $key => $variants) {
                                
                if($key == "'option'")
                {
                    $arr_variant_detail['option'] = $variants;
                }
                
                if($key == "'harga_beli'")
                {
                    $arr_variant_detail['harga_beli'] = $variants;
                }
                
                if($key == "'harga_jual'")
                {
                    $arr_variant_detail['harga_jual'] = $variants;
                }
            }

            $counter = count($arr_variant_detail['option']);
            
            for ($num = 0; $num < $counter ; $num++) 
            {
                $variant_detail = new VariantDetail();
                $variant_detail->variant_id     = $variant->id;
                $variant_detail->variant_code   = $variant_detail->makevariantCode($request->get('nama_product'));
                $variant_detail->option         = $arr_variant_detail['option'][$num];
                $variant_detail->harga_jual     = $arr_variant_detail['harga_jual'][$num];
                $variant_detail->harga_beli     = $arr_variant_detail['harga_beli'][$num];
                
                if(!$variant_detail->save())
                {
                    DB::rollBack();
                    return redirect()->back()->with('alert_error', 'Gagal di simpan');
                }

                $this->setupInitialStock($product->id,$variant->id,$variant_detail->id);
            }
        }
        else // IF NOT HAVE VARIANT
        {
            // Save default variant from single product
            $variant->product_id    = $product->id;
            $variant->nama_variant  = 'Single Product '. $product->nama_product;

            if(!$variant->save())
            {
                DB::rollBack();
                return redirect()->back()->with('alert_error', 'Gagal di simpan');
            }

            $variant_detail = new VariantDetail();
            $variant_detail->variant_id     = $variant->id;
            $variant_detail->option         = null;
            $variant_detail->variant_code   = $variant_detail->makevariantCode($request->get('nama_product'));
            $variant_detail->harga_jual     = $request->get('single_harga_jual');
            $variant_detail->harga_beli     = $request->get('single_harga_beli');

            if(!$variant_detail->save())
            {
                DB::rollBack();
                return redirect()->back()->with('alert_error', 'Gagal di simpan');
            }

            $this->setupInitialStock($product->id,$variant->id,$variant_detail->id);
        }

        DB::commit();
        
        return redirect()->route('product')->with('alert_sucsess', 'Produk Berhasil disimpan');

        // Save Grosir        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Product\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function viewupdate(Request $request)
    {
        // if($this->getUserPermission('update product'))
        // {       
            // $this->systemLog(false,'Mengakses Halaman Update customer');

            $product        = Product::findOrFail($request->id);
            $data_kategori  = Kategori::getKategori();
            $data_satuan    = Satuan::getSatuan(); 

            $kategori_option = '<select class="js-example-basic-single form-control" name="kategori_id" id="kategori_id" style="width: 100%">';
            foreach ($data_kategori as $kategori) {
                $kategori_option .= '<option value="'.$kategori->id.'">'.$kategori->nama_kategori.'</option>';
            }           
            $kategori_option .= '</select>';

            $satuan_option = '<select class="js-example-basic-single form-control" name="satuan_id" id="satuan_id" style="width: 100%">';
            foreach ($data_satuan as $satuan) {
                $satuan_option .= '<option value="'.$satuan->id.'">'.$satuan->nama_satuan.'</option>';
            }           
            $satuan_option .= '</select>';

            return view('product.update', ['active'=>'product','product'=>$product,'kategori_option'=>$kategori_option,'satuan_option'=>$satuan_option]);

        // }
        // else
        // {
        //     $this->systemLog(true,'Gagal Mengakses Halaman Update product');
        //     return view('error.unauthorized', ['active'=>'product']);
        // }
    }

    public function update(UpdateProductRequest $request)
    {
        DB::beginTransaction();

        $product = Product::findOrFail($request->get('id_product'));
        
        $product->nama_product      = $request->get('nama_product');
        $product->sku               = $request->get('sku');
        $product->berat             = $request->get('berat');
        $product->volume            = $request->get('volume');
        $product->merek             = $request->get('merek');
        $product->has_grosir        = $request->get('has_grosir');
        $product->exp               = $request->get('exp');
        $product->deskripsi         = $request->get('deskripsi');
        $product->kategori_id       = $request->get('kategori_id');
        $product->satuan_id         = $request->get('satuan_id');
        $product->has_grosir        = Product::PRODUCT_HAS_NOT_GROSIR;

        $request->get('varian_check') === 'on' ? $product->has_varian = Product::PRODUCT_HAS_VARIANT : $product->has_varian = Product::PRODUCT_HAS_NOT_VARIANT;

        if(!$product->save())
        {
            DB::rollBack();
            return redirect()->back()->with('alert_error', 'Gagal di simpan (Produk)');
        }

        // Save Image Procuct
        if ($request->hasFile('file')) {

            $this->deleteImage($request->get('id_product'));
            
            foreach ($request->file('file') as $images) {
                
                $fileName   = time() . '.' . $images->getClientOriginalExtension();

                $img = Image::make($images->getRealPath());
                $img->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();                 
                });

                $img->stream();
                Storage::disk('local')->put('public/product/'.$fileName, $img, 'public');
                
                $product_image = new ProductImage();
                $product_image->product_id = $request->get('id_product');
                $product_image->image_url = $fileName;

                if(!$product_image->save())
                {
                    DB::rollBack();
                    return redirect()->back()->with('alert_error', 'Gagal di simpan');
                }
            }
        }

         // Save Varian Product
         if($request->get('varian_check') === 'on')
         {
            // Updating Old File
            $variant = $this->updateVariant($request->get('id_product'),$request->get('nama_variant'));            
             
            // Update Varian Detail
             if(!$request->get('variant_detail'))
             {
                DB::rollBack();
                return redirect()->back()->with('alert_error', 'Gagal di simpan (Detail)');
             }
             
             $arr_variant_detail = [];
         
             foreach ($request->get('variant_detail') as $key => $variants) {
                
                if($key == "'variant_code'")
                {
                    $arr_variant_detail['variant_code'] = $variants;
                }

                 if($key == "'option'")
                 {
                     $arr_variant_detail['option'] = $variants;
                 }
                 
                 if($key == "'harga_beli'")
                 {
                     $arr_variant_detail['harga_beli'] = $variants;
                 }
                 
                 if($key == "'harga_jual'")
                 {
                     $arr_variant_detail['harga_jual'] = $variants;
                 }
             }
 
             $counter = count($arr_variant_detail['option']);
             
             for ($num = 0; $num < $counter ; $num++) 
             {
                 $variant_detail = VariantDetail::findByVariantCode($variant->id, $arr_variant_detail['variant_code'][$num]);

                 $variant_detail->variant_id     = $variant->id;
                 $variant_detail->variant_code   = $arr_variant_detail['variant_code'][$num];
                 $variant_detail->option         = $arr_variant_detail['option'][$num];
                 $variant_detail->harga_jual     = $arr_variant_detail['harga_jual'][$num];
                 $variant_detail->harga_beli     = $arr_variant_detail['harga_beli'][$num];
                 
                 if(!$variant_detail->save())
                 {
                     DB::rollBack();
                     return redirect()->back()->with('alert_error', 'Gagal di simpan');
                 }
             }
         }
         else // IF NOT HAVE VARIANT
         {
            // Updating Old File
            $variant = $this->updateVariant($request->get('id_product'), null);
            
            $variant_detail = VariantDetail::findByVariantCode($variant->id, $request->get('single_variant_code'));

            $variant_detail->variant_id     = $variant->id;
            $variant_detail->option         = null;
            $variant_detail->harga_jual     = $request->get('single_harga_jual');
            $variant_detail->harga_beli     = $request->get('single_harga_beli');

            if(!$variant_detail->save())
            {
                DB::rollBack();
                return redirect()->back()->with('alert_error', 'Gagal di simpan');
            }
         }
 
         DB::commit();
         return redirect()->route('product')->with('alert_sucsess', 'Produk Berhasil diupdate');
    }

    /**
     * 
     */
    protected function deleteImage($id_product)
    {
        // Deleting old File
        $products_image = ProductImage::findByProduct($id_product);

        if($products_image != null)
        {
            foreach ($products_image as $image) {
                Storage::disk('local')->delete('public/product/'.$image->image_url);
                $image->delete();
            }
        }
    }

    /**
     * 
     */
    protected function updateVariant($id_product,$variant_name=null)
    {
        DB::beginTransaction();
       
        $variant                = Variant::findByProduct($id_product);
        $variant->nama_variant  = $variant_name;

         if(!$variant->save())
         {
            DB::rollBack();
            return redirect()->back()->with('alert_error', 'Gagal di simpan (Varian)');
         }

        DB::commit();
        return $variant;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Product\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        DB::beginTransaction();
       
        $product = Product::findOrfail($request->get('idproduct'));

        if(!$product->delete())
        {
            DB::rollBack();
            return $this->getResponse(false,400,'','Produk gagal dihapus');
        }

        DB::commit();
        return $this->getResponse(true,200,'','Produk berhasil dihapus');
    }
}
