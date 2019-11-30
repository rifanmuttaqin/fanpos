<?php

namespace App\Http\Controllers;

use App\Model\Customer\Customer;
use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Http\Resources\Customer\CustomerResource;

use DB;

use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;

class CustomerController extends Controller
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

            $data = Customer::all();
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
        
        // if($this->getUserPermission('index customer'))
        // {
            // $this->systemLog(false,'Mengakses Halaman Master Customer');
            return view('customer.index', ['active'=>'customer']);   
        // }
        // else
        // {
            // $this->systemLog(true,'Gagal Mengakses Halaman Master Customer');
            // return view('error.unauthorized', ['active'=>'customer']);
        // }
    }

    /**
     * @return void
     */
    public function create()
    {
        // if($this->getUserPermission('create customer'))
        // {
            // $this->systemLog(false,'Mengakses Halaman Create customer');
            return view('customer.store', ['active'=>'customer']);
        // }
        // else
        // {
        //     $this->systemLog(true,'Gagal Mengakses Halaman Create customer');
        //     return view('error.unauthorized', ['active'=>'customer']);
        // }
    }

    /**
     * @return void
     */
    public function store(StoreCustomerRequest $request)
    {  
        // perlu validate permission
        DB::beginTransaction();
   
        $customer = new Customer();

        $customer->nama = $request->get('nama');
        $customer->alamat = $request->get('alamat');
        $customer->nomor_telfon = $request->get('nomor_telfon');
        $customer->email = $request->get('email');

        if(!$customer->save())
        {
            DB::rollBack();
            return redirect('customer')->with('alert_error', 'Gagal Disimpan');
        }
        else
        {
            // $this->systemLog(false,'Berhasil menyimpan data Customer : '.$customer->nama.' ');
            DB::commit();
            return redirect('customer')->with('alert_success', 'Berhasil Disimpan');
        } 
    }

    /**
     * @return void
     */
    public function delete(Request $request)
    {
        if ($request->ajax()) {

            DB::beginTransaction();
            $customerModel = Customer::findOrFail($request->get('idcustomer'));

            if(!$customerModel->delete())
            {
                // $this->systemLog(true,'Gagal Mendelete Customer');
                DB::rollBack();
                return $this->getResponse(false,400,'','Customer gagal dihapus');
            }

            // if($this->getUserPermission('delete customer'))
            // {
                // $this->systemLog(false,'Berhasil Mendelete Customer');
                DB::commit();
                return $this->getResponse(true,200,'','Customer berhasil dihapus');
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
    public function doupdate(UpdateCustomerRequest $request)
    {
        DB::beginTransaction();

        $customer = Customer::findOrFail($request->get('customerid'));
        $customer->nama = $request->get('nama');
        $customer->alamat = $request->get('alamat');
        $customer->nomor_telfon = $request->get('nomor_telfon');
        $customer->email = $request->get('email');

        if(!$customer->save())
        {
            // $this->systemLog(true,'Gagal Mengupdate Customer');
            DB::rollBack();
            return  redirect()->route('view-update', ['id' => $request->get('customerid')])->with('alert_error', 'Gagal Diperbaharui');
            // return $this->getResponse(false,400,'','Customer gagal diupdate');
        }

        // if($this->getUserPermission('update customer'))
        // {
            // $this->systemLog(false,'Berhasil Mengupdate Customer');
            DB::commit();
            return  redirect()->route('view-update', ['id' => $request->get('customerid')])->with('alert_success', 'Berhasil Diperbaharui');
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
        // if($this->getUserPermission('update customer'))
        // {       
            // $this->systemLog(false,'Mengakses Halaman Update customer');
            $customer = Customer::findOrFail($request->id);
            return view('customer.update', ['active'=>'customer','customer'=>$customer]);
        // }
        // else
        // {
        //     $this->systemLog(true,'Gagal Mengakses Halaman Update customer');
        //     return view('error.unauthorized', ['active'=>'customer']);
        // }
    }
}


// ----------------------- NOTE ----------------------
// - Handling error untuk parameter kosong
// - Handling error untuk method yang tidak diizinkan 
