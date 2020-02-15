<?php

namespace App\Http\Controllers;

use App\Model\Satuan\Satuan;
use App\Http\Requests\Satuan\StoreSatuanRequest;
use App\Http\Requests\Satuan\UpdateSatuanRequest;
use App\Http\Resources\Satuan\SatuanResource;
use App\Http\Resources\Satuan\SatuanCollection;

use Illuminate\Support\Collection;


use Illuminate\Http\Request;

use DB;

use Yajra\Datatables\Datatables;

class SatuanController extends Controller
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

            $data = Satuan::all();
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

        return view('satuan.index', ['active'=>'satuan']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSatuanRequest $request)
    {
        // perlu validate permission
        DB::beginTransaction();

        $satuan = new Satuan();

        $satuan->nama_satuan = $request->get('nama_satuan');
        $satuan->simbol_satuan = $request->get('simbol_satuan');

        if(!$satuan->save())
        {
            DB::rollBack();
            return $this->getResponse(false,400,'','Satuan gagal disimpan');
        }
        else
        {
            // $this->systemLog(false,'Berhasil menyimpan data Satuan : '.$satuan->nama_satuan.' ');
            DB::commit();
            return $this->getResponse(true,200,'','Satuan berhasil dibuat');
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Satuan\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if ($request->ajax()) {
            $satuan = Satuan::findOrFail($request->get('idsatuan'));
            return new SatuanResource($satuan);
        }
    }


    /**
     * Display all resources. for select2
     *
     * @param  \App\Model\Satuan\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        if ($request->ajax()) {
            
            $data_satuan = null;

            if($request->has('search'))
            {
                $data_satuan = Satuan::getSatuan($request->get('search'));
            }
            else
            {
                $data_satuan = Satuan::getSatuan();
            }

            $arr_data  = array();

            if($data_satuan != null)
            {
                $key = 0;

                foreach ($data_satuan as $data) {
                    $arr_data[$key]['id'] = $data->id;
                    $arr_data[$key]['text'] = $data->nama_satuan;
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
     * @param  \App\Model\Satuan\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSatuanRequest $request)
    {
         // perlu validate permission
        DB::beginTransaction();

        $satuan = Satuan::findOrFail($request->get('idsatuan'));

        $satuan->nama_satuan = $request->get('nama_satuan');
        $satuan->simbol_satuan = $request->get('simbol_satuan');

        if(!$satuan->save())
        {
            DB::rollBack();
            return $this->getResponse(false,400,'','Satuan gagal diupdate');
        }
        else
        {
            // $this->systemLog(false,'Berhasil menyimpan data Satuan : '.$satuan->nama_satuan.' ');
            DB::commit();
            return $this->getResponse(true,200,'','Satuan berhasil diupdate');
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Satuan\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {

            DB::beginTransaction();
            $satuanModel = Satuan::findOrFail($request->get('idsatuan'));

            if(!$satuanModel->delete())
            {
                // $this->systemLog(true,'Gagal Mendelete Satuan');
                DB::rollBack();
                return $this->getResponse(false,400,'','Satuan gagal dihapus');
            }

            // if($this->getUserPermission('delete satuan'))
            // {
                // $this->systemLog(false,'Berhasil Mendelete Satuan');
                DB::commit();
                return $this->getResponse(true,200,'','Satuan berhasil dihapus');
            // }
            // else
            // {
            //     return $this->getResponse(false,505,'','Tidak mempunyai izin untuk aktifitas ini');
            // }
        }
    }
}
