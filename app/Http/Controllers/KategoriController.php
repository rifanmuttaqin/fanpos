<?php

namespace App\Http\Controllers;

use App\Model\Kategori\Kategori;
use App\Http\Requests\Kategori\StoreKategoriRequest;
use App\Http\Requests\Kategori\UpdateKategoriRequest;
use App\Http\Resources\Kategori\KategoriResource;

use Illuminate\Http\Request;


use Yajra\Datatables\Datatables;

use DB;

class KategoriController extends Controller
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

            $data = Kategori::all();
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

        return view('kategori.index', ['active'=>'kategori']); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKategoriRequest $request)
    {
        // perlu validate permission
        DB::beginTransaction();

        $kategori = new Kategori();

        $kategori->nama_kategori = $request->get('nama_kategori');
        $kategori->keterangan = $request->get('keterangan');

        if(!$kategori->save())
        {
            DB::rollBack();
            return $this->getResponse(false,400,'','Kategori gagal disimpan');
        }
        else
        {
            // $this->systemLog(false,'Berhasil menyimpan data Kategori : '.$kategori->nama_kategori.' ');
            DB::commit();
            return $this->getResponse(true,200,'','Kategori berhasil dibuat');
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Kategori\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if ($request->ajax()) {
            $kategori = Kategori::findOrFail($request->get('idkategori'));
            return new KategoriResource($kategori);
        }
    }


    /**
     * Display all resources. for select2
     *
     * @param  \App\Model\Kategori\Kategori  $satuan
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        if ($request->ajax()) {
            
            $data_kategori = null;

            if($request->has('search'))
            {
                $data_kategori = Kategori::getKategori($request->get('search'));
            }
            else
            {
                $data_kategori = Kategori::getKategori();
            }

            $arr_data  = array();

            if($data_kategori != null)
            {
                $key = 0;

                foreach ($data_kategori as $data) {
                    $arr_data[$key]['id'] = $data->id;
                    $arr_data[$key]['text'] = $data->nama_kategori;
                    $key++;
                }
            }

            return json_encode($arr_data);
        }
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Kategori\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKategoriRequest $request)
    {
        // perlu validate permission
        DB::beginTransaction();

        $kategori = Kategori::findOrFail($request->get('idkategori'));

        $kategori->nama_kategori = $request->get('nama_kategori');
        $kategori->keterangan = $request->get('keterangan');

        if(!$kategori->save())
        {
            DB::rollBack();
            return $this->getResponse(false,400,'','Kategori gagal diupdate');
        }
        else
        {
            // $this->systemLog(false,'Berhasil menyimpan data Kategori : '.$kategori->nama_kategori.' ');
            DB::commit();
            return $this->getResponse(true,200,'','Kategori berhasil diupdate');
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Kategori\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {

            DB::beginTransaction();
            $kategoriModel = Kategori::findOrFail($request->get('idkategori'));

            if(!$kategoriModel->delete())
            {
                // $this->systemLog(true,'Gagal Mendelete Kategori');
                DB::rollBack();
                return $this->getResponse(false,400,'','Kategori gagal dihapus');
            }

            // if($this->getUserPermission('delete kategori'))
            // {
                // $this->systemLog(false,'Berhasil Mendelete Kategori');
                DB::commit();
                return $this->getResponse(true,200,'','Kategori berhasil dihapus');
            // }
            // else
            // {
            //     return $this->getResponse(false,505,'','Tidak mempunyai izin untuk aktifitas ini');
            // }
        }
    }
}
