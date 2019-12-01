<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Supplier\Supplier;
use App\Http\Requests\Supplier\StoreSupplierRequest;
use App\Http\Requests\Supplier\UpdateSupplierRequest;
use App\Http\Resources\Supplier\SupplierResource;

use DB;
use Image;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use Yajra\Datatables\Datatables;

class SupplierController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Supplier::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){  
                        $btn = '
                        <button onclick="btnUbah('.$row->id.')" name="btnUbah" type="button" class="btn btn-success btn-circle btn-sm"><i class="icon-pencil"></i></button>';
                        $delete = '<button onclick="btnDel('.$row->id.')" name="btnDel" type="button" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></button>';
                        return $btn .'&nbsp'.'&nbsp'. $delete; 
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        // if($this->getUserPermission('index supplier'))
        // {
            // $this->systemLog(false,'Mengakses Halaman Master Supplier');
            return view('supplier.index', ['active'=>'supplier']);   
        // }
        // else
        // {
            // $this->systemLog(true,'Gagal Mengakses Halaman Master Supplier');
            // return view('error.unauthorized', ['active'=>'supplier']);
        // }
    }

    /**
     * @return void
     */
    public function create()
    {
        // if($this->getUserPermission('create supplier'))
        // {
            // $this->systemLog(false,'Mengakses Halaman Create supplier');
            return view('supplier.store', ['active'=>'supplier']);
        // }
        // else
        // {
        //     $this->systemLog(true,'Gagal Mengakses Halaman Create supplier');
        //     return view('error.unauthorized', ['active'=>'supplier']);
        // }
    }

    /**
     * @return void
     */
    public function store(StoreSupplierRequest $request)
    {  
        // perlu validate permission
        DB::beginTransaction();
   
        $supplier = new Supplier();

        $supplier->nama = $request->get('nama');
        $supplier->alamat = $request->get('alamat');
        $supplier->nomor_telfon = $request->get('nomor_telfon');
        $supplier->email = $request->get('email');

        if ($request->hasFile('file')) {
            
            $image      = $request->file('file');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();

            $img = Image::make($image->getRealPath());
            $img->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();                 
            });

            $img->stream();
            Storage::disk('local')->put('public/supplier_profile/'.$fileName, $img, 'public');

            $supplier->url_profile_pic = $fileName;
        }

        if(!$supplier->save())
        {
            DB::rollBack();
            return redirect('supplier')->with('alert_error', 'Gagal Disimpan');
        }
        else
        {
            // $this->systemLog(false,'Berhasil menyimpan data Supplier : '.$supplier->nama.' ');
            DB::commit();
            return redirect('supplier')->with('alert_success', 'Berhasil Disimpan');
        } 
    }

    /**
     * @return void
     */
    public function delete(Request $request)
    {
        if ($request->ajax()) {

            DB::beginTransaction();
            $supplierModel = Supplier::findOrFail($request->get('idsupplier'));

            if(!$supplierModel->delete())
            {
                // $this->systemLog(true,'Gagal Mendelete Supplier');
                DB::rollBack();
                return $this->getResponse(false,400,'','Supplier gagal dihapus');
            }

            // if($this->getUserPermission('delete supplier'))
            // {
                // $this->systemLog(false,'Berhasil Mendelete Supplier');
                DB::commit();
                return $this->getResponse(true,200,'','Supplier berhasil dihapus');
            // }
            // else
            // {
            //     return $this->getResponse(false,505,'','Tidak mempunyai izin untuk aktifitas ini');
            // }
        }
    }

    /**
     * @return void
     */
    public function doupdate(UpdateSupplierRequest $request)
    {
        DB::beginTransaction();

        $supplier = Supplier::findOrFail($request->get('supplierid'));
        $supplier->nama = $request->get('nama');
        $supplier->alamat = $request->get('alamat');
        $supplier->nomor_telfon = $request->get('nomor_telfon');
        $supplier->email = $request->get('email');

        if ($request->hasFile('file')) {
            
            $image      = $request->file('file');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();

            $img = Image::make($image->getRealPath());
            $img->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();                 
            });

            $img->stream();
            Storage::disk('local')->put('public/supplier_profile/'.$fileName, $img, 'public');

            $supplier->url_profile_pic = $fileName;
        }
        else
        {
            $supplier->url_profile_pic = null;
        }

        if(!$supplier->save())
        {
            // $this->systemLog(true,'Gagal Mengupdate Supplier');
            DB::rollBack();
            return  redirect()->route('view-update', ['id' => $request->get('supplierid')])->with('alert_error', 'Gagal Diperbaharui');
            // return $this->getResponse(false,400,'','Supplier gagal diupdate');
        }

        // if($this->getUserPermission('update supplier'))
        // {
            // $this->systemLog(false,'Berhasil Mengupdate Supplier');
            DB::commit();
            return  redirect()->route('view-update', ['id' => $request->get('supplierid')])->with('alert_success', 'Berhasil Diperbaharui');
        // }
        // else
        // {
        //     return $this->getResponse(false,505,'','Tidak mempunyai izin untuk aktifitas ini');   
        // }   
    }

    /**
     * @return void
     */
    public function viewupdate(Request $request)
    {
        // if($this->getUserPermission('update supplier'))
        // {       
            // $this->systemLog(false,'Mengakses Halaman Update supplier');
            $supplier = Supplier::findOrFail($request->id);
            return view('supplier.update', ['active'=>'supplier','supplier'=>$supplier]);
        // }
        // else
        // {
        //     $this->systemLog(true,'Gagal Mengakses Halaman Update supplier');
        //     return view('error.unauthorized', ['active'=>'supplier']);
        // }
    }
}
