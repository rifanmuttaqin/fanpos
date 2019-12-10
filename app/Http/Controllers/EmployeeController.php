<?php

namespace App\Http\Controllers;

use App\Model\User\User;
use App\Model\User\UserEmployee;

use App\Http\Requests\User\PasswordRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\Employee\StoreEmployeeRequest;

use Yajra\Datatables\Datatables;

use App\Http\Resources\User\UserResource;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use DB;


class EmployeeController extends Controller
{
    /**
     * Create a new controller instance.
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

            $data_employee = User::getUserEmployee();
           
            return Datatables::of($data_employee)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){  
                        $btn = '<button onclick="btnUbah('.$row->id.')" name="btnUbah" type="button" class="btn btn-info"><i class="far fa-edit"></i></button>';
                        $pass = '<button onclick="btnPass('.$row->id.')" name="btnPass" type="button" class="btn btn-info"><i class="fas fa-user-lock"></i></button>';
                        $delete = '<button onclick="btnDel('.$row->id.')" name="btnDel" type="button" class="btn btn-info"><i class="fas fa-trash"></i></button>';
                        return $btn .'&nbsp'. $pass .'&nbsp'. $delete; 
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        // if($this->getUserPermission('index employee'))
        // {
            // $this->systemLog(false,'Mengakses halaman manajemen employee');
            return view('employee.index', ['active'=>'employee']);
        // }
        // else
        // {
        //     $this->systemLog(true,'Gagal Mengakses halaman manajemen employee');
        //     return view('error.unauthorized', ['active'=>'employee']);
        // }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if($this->getUserPermission('create employee'))
        // {
            // $this->systemLog(false,'Mengakses Halaman Create employee');
            return view('employee.store', ['active'=>'employee']);
        // }
        // else
        // {
        //     $this->systemLog(true,'Gagal Mengakses Halaman Create employee');
        //     return view('error.unauthorized', ['active'=>'employee']);
        // }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        // perlu validate permission
        DB::beginTransaction();

        $user = new User();
        $employee = new UserEmployee();

        $user->username     = $request->get('username');
        $user->password     = Hash::make($request->get('password'));
        $user->full_name    = $request->get('full_name');
        $user->email        = $request->get('email');
        $user->adress       = $request->get('adreess');
        $user->status       = User::USER_STATUS_ACTIVE;
        $user->account_type = User::ACCOUNT_TYPE_EMPLOYEE;

        if(!$user->save())
        {
            DB::rollBack();
            return redirect('employee')->with('alert_error', 'Gagal Disimpan');
        }
        else
        {
            $employee->user_id              = $user->id;
            $employee->nik                  = $request->get('nik');
            $employee->jenis_kelamin        = $request->get('jenis_kelamin');
            $employee->tempat_lahir         = $request->get('tempat_lahir');
            $employee->tanggal_lahir        = $request->get('tanggal_lahir');
            $employee->agama                = $request->get('agama');
            $employee->status_pernikahan    = $request->get('status_pernikahan');
            $employee->phone                = $request->get('phone');
            $employee->tanggal_masuk        = $request->get('tanggal_masuk');
            $employee->tipe_karyawan        = $request->get('tipe_karyawan');
            $employee->keterangan           = $request->get('keterangan');

            if(!$employee->save())
            {
                DB::rollBack();
                return redirect('employee')->with('alert_error', 'Gagal Disimpan');
            }

            DB::commit();
            return redirect('employee')->with('alert_success', 'Berhasil Disimpan');
        }
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\User\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\User\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\User\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        
    }
}
