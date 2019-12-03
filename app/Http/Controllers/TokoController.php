<?php

namespace App\Http\Controllers;

use App\Model\Toko\Toko;

use App\Http\Requests\Toko\StoreTokoRequest;
use App\Http\Requests\Toko\UpdatTokoRequest;
use App\Http\Resources\Toko\TokoResource;

use Illuminate\Http\Request;

use DB;


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
        return view('toko.index', ['active'=>'toko']);
    }
}
