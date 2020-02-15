<?php

namespace App\Http\Controllers;

use App\Model\Product\Product;
use App\Model\Product\ProductImage;
use App\Model\Variant\Variant;
use App\Model\Variant\VariantDetail;
use App\Http\Requests\Product\StoreProductRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use Yajra\Datatables\Datatables;

use DB;
use Image;

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
                    ->addColumn('action', function($row){  
                        $btn = '
                        <button onclick="btnUbah('.$row->id.')" name="btnUbah" type="button" class="btn btn-success btn-circle btn-sm"><i class="far fa-edit"></i></button>';
                        $delete = '<button onclick="btnDel('.$row->id.')" name="btnDel" type="button" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></button>';
                        return $btn .'&nbsp'.'&nbsp'. $delete; 
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

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
        $product_image      = new ProductImage();
        $variant            = new Variant();
        $variant_detail     = new VariantDetail();

        $product->nama_product      = $request->get('nama_product');
        $product->sku               = $request->get('sku');
        $product->berat             = $request->get('berat');
        $product->volume            = $request->get('volume');
        $product->has_varian        = $request->get('has_varian');
        $product->has_grosir        = $request->get('has_grosir');
        $product->exp               = $request->get('exp');
        $product->deskripsi         = $request->get('deskripsi');
        $product->kategori_id       = $request->get('kategori_id');
        $product->satuan_id         = $request->get('satuan_id');

        // Option Product
        $product->has_grosir        = Product::PRODUCT_HAS_NOT_GROSIR;

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

            foreach ($request->get('variant_detail') as $key => $variants) {

                $variant_detail->variant_id     = $variant->id;

                if($key == "'option'")
                {
                    $variant_detail->option         = $variants;
                }
                else if($key == "'harga'")
                {
                    $variant_detail->harga          = $variants;
                }

                if(!$variant_detail->save())
                {
                    DB::rollBack();
                    return redirect()->back()->with('alert_error', 'Gagal di simpan');
                }
            }
        }

        DB::commit();
        return redirect()->back()->with('alert_sucsess', 'Produk Berhasil disimpan');

        // Save Grosir

        // Save History Stock
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Product\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Product\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Product\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Product\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        
    }
}
