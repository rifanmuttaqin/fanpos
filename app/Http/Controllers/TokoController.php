<?php

namespace App\Http\Controllers;

use App\Model\Toko\Toko;

use App\Http\Requests\Toko\StoreTokoRequest;
use App\Http\Requests\Toko\UpdateTokoRequest;
use App\Http\Resources\Toko\TokoResource;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use DB;
use Image;

class TokoController extends Controller
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
    public function index()
    {
        $toko = Toko::firstOrFail();
        return view('toko.index', ['active'=>'toko', 'toko'=>$toko]);
    }

    public function update(UpdateTokoRequest $request)
    {
        DB::beginTransaction();

        $toko = Toko::first();

        

        $toko->nama_toko = $request->get('nama_toko');
        $toko->npwp = $request->get('npwp');
        $toko->alamat_toko = $request->get('alamat_toko');
        $toko->nomor_telfon = $request->get('nomor_telfon');
        $toko->email = $request->get('email');
        $toko->fax = $request->get('fax');
        $toko->website = $request->get('website');
        $toko->kode_pos = $request->get('kode_pos');

        if ($request->hasFile('file')) {
            
            $image      = $request->file('file');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();

            $img = Image::make($image->getRealPath());
            $img->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();                 
            });

            $img->stream();
            Storage::disk('local')->put('public/toko_profile/'.$fileName, $img, 'public');

            $toko->logo_url = $fileName;
        }
        else
        {
            $toko->logo_url = null;
        }

        if(!$toko->save())
        {
            // $this->systemLog(true,'Gagal Mengupdate Customer');
            DB::rollBack();
            return redirect()->back()->with('alert_error', 'Gagal di Update');
            // return $this->getResponse(false,400,'','Customer gagal diupdate');
        }

        // if($this->getUserPermission('update customer'))
        // {
            // $this->systemLog(false,'Berhasil Mengupdate Customer');
            DB::commit();
            return redirect()->back()->with('alert_success', 'Berhasil di Update');
        // }
        // else
        // {
        //     return $this->getResponse(false,505,'','Tidak mempunyai izin untuk aktifitas ini');   
        // }   
    }
}
