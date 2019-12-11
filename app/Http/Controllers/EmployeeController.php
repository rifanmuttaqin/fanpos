<?php

namespace App\Http\Controllers;

use App\Model\User\User;
use App\Model\User\UserEmployee;

use App\Http\Requests\User\PasswordRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Http\Requests\Employee\PasswordChangeEmployeeRequest;
use App\Http\Resources\User\UserResource;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use Yajra\Datatables\Datatables;

use DB;

use URL;

use Image;


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
        $user->address      = $request->get('address');
        $user->status       = User::USER_STATUS_ACTIVE;
        $user->account_type = User::ACCOUNT_TYPE_EMPLOYEE;

        if ($request->hasFile('file')) {
            
            $image      = $request->file('file');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();

            $img = Image::make($image->getRealPath());
            $img->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();                 
            });

            $img->stream();
            Storage::disk('local')->put('public/profile_picture/'.$fileName, $img, 'public');

            $user->profile_picture = $fileName;
        }
        else
        {
            $user->profile_picture = null;
        }

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
     * Update Password for Employee via AJAX request
     *
     * @param  \App\Model\User\User  $user
     * @return \Illuminate\Http\Response
     */
    public function editPassword(PasswordChangeEmployeeRequest $request)
    {
        if ($request->ajax()) {

            DB::beginTransaction();

            $employee = User::findOrFail($request->idemployee);
            $employee->password = Hash::make($request->password);

            if(!$employee->save())
            {
                DB::rollBack();
                return $this->getResponse(true,400,null,'Password gagal diupdate');
            }

            // if($this->getUserPermission('change password'))
            // {
                DB::commit();
                return $this->getResponse(true,200,'','Password berhasil diupdate');
            // }
            // else
            // {
            //     return $this->getResponse(false,505,'','Tidak mempunyai izin untuk aktifitas ini');
            // }   
        }
    }

    /**
     * Render Update the Page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\User\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update($idemployee=null)
    {
        if($idemployee != null)
        {
            $employeeData = User::findOrFail($idemployee);

            return view('employee.update', ['active'=>'employee','employeeData'=>$employeeData]);
        }
    }

    public function doupdate(UpdateEmployeeRequest $request)
    {
        // perlu validate permission
        DB::beginTransaction();

        $user = User::findOrFail($request->idemployee);

        $user->full_name    = $request->get('full_name');
        $user->email        = $request->get('email');
        $user->address      = $request->get('address');
        $user->status       = User::USER_STATUS_ACTIVE;
        $user->account_type = User::ACCOUNT_TYPE_EMPLOYEE;

        // Detail Employee

        $user->employee->nik                  = $request->get('nik');
        $user->employee->jenis_kelamin        = $request->get('jenis_kelamin');
        $user->employee->tempat_lahir         = $request->get('tempat_lahir');
        $user->employee->tanggal_lahir        = $request->get('tanggal_lahir');
        $user->employee->agama                = $request->get('agama');
        $user->employee->status_pernikahan    = $request->get('status_pernikahan');
        $user->employee->phone                = $request->get('phone');
        $user->employee->tanggal_masuk        = $request->get('tanggal_masuk');
        $user->employee->tipe_karyawan        = $request->get('tipe_karyawan');
        $user->employee->keterangan           = $request->get('keterangan');

        if ($request->hasFile('file')) {
            
            $image      = $request->file('file');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();

            $img = Image::make($image->getRealPath());
            $img->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();                 
            });

            $img->stream();
            Storage::disk('local')->put('public/profile_picture/'.$fileName, $img, 'public');

            $user->profile_picture = $fileName;
        }
       
        if(!$user->push())
        {
            DB::rollBack();
            return redirect()->back()->with('alert_error', 'Gagal Disimpan');
        }

        DB::commit();
        return redirect()->back()->with('alert_success', 'Berhasil Disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\User\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {

            DB::beginTransaction();
            
            $userModel = User::findOrFail($request->get('idemployee'));
            $userModel->status = User::USER_STATUS_NOT_ACTIVE;

            if(!$userModel->save())
            {
                // $this->systemLog(true,'Gagal Mendelete User');
                DB::rollBack();
                return $this->getResponse(false,400,'','Kategori gagal dihapus');
            }

            // if($this->getUserPermission('delete employee'))
            // {
                // $this->systemLog(false,'Berhasil Mendelete Employee');
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
