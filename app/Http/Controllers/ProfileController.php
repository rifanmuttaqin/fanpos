<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Http\Requests\Profile\UpdatePasswordRequest;
use App\Model\User\User;


use Auth;

use DB;

use URL;

use Image;

class ProfileController extends Controller
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
     * Show the application index.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
    	$data_user = Auth::user();

        // if($this->getUserPermission('index profile'))
        // {
            // $this->systemLog(false,'Mengakses halaman Profile');
            return view('profile.index', ['active'=>'profile', 'data_user'=>$data_user]);
        // }
        // else
        // {
            // $this->systemLog(true,'Gagal Mengakses halaman Profile');
            // return view('error.unauthorized', ['active'=>'profile']);
        // }
    }

    public function update(UpdateProfileRequest $request)
    {
        DB::beginTransaction();

        $user = User::findOrFail(Auth::user()->id);

        $user->email = $request->get('email');
        $user->address = $request->get('address');
        $user->full_name = $request->get('full_name');

        if($request->hasFile('file'))
        {
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
            // $this->systemLog(true,'Gagal mengupdate Profile');
            DB::rollBack();
            return redirect('profile')->with('alert_error', 'Gagal Disimpan');
        }

        // if($this->getUserPermission('update profile'))
        // {
            // $this->systemLog(false,'Berhasil mengupdate Profile');
            DB::commit();
            return redirect('profile')->with('alert_success', 'Berhasil Disimpan');
        // }
        // else
        // {
        //     $this->systemLog(true,'Gagal mengupdate Profile');
        //     DB::rollBack();
        //     return view('error.unauthorized', ['active'=>'profile']);
        // }   
    }

    /**
     * @return void
     */
    public function deleteimage(Request $request)
    {
        if ($request->ajax()) {
            
            DB::beginTransaction();
            $user = User::findOrFail($request->employee_id);
            $user->profile_picture = null;

            if(!$user->save())
            {
                DB::rollBack();
                return $this->getResponse(false,400,null,'Gambar gagal dihapus');
            }

            DB::commit();
            return $this->getResponse(true,200,'','Gambar berhasil dihapus');
        }
    }

    /**
     * @return void
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        if ($request->ajax()) {

            DB::beginTransaction();

            if(User::passwordChangeValidation($request->get('old_password'),Auth::user()->password))
            {
                $user = User::findOrFail(Auth::user()->id);
                $user->password = Hash::make($request->get('password'));

                if(!$user->save())
                {
                    // $this->systemLog(true,'Gagal mengupdate Password');
                    DB::rollBack();
                    return $this->getResponse(false,400,null,'Password gagal diupdate');
                }

                // if($this->getUserPermission('change password'))
                // {
                //     $this->systemLog(false,'Berhasil mengupdate Password');
                    DB::commit();
                    return $this->getResponse(true,200,'','Password berhasil diupdate');
                // }
                // else
                // {
                //     $this->systemLog(true,'Gagal mengupdate Password');
                //     DB::rollBack();
                //     return $this->getResponse(false,505,'','Tidak mempunyai izin untuk aktifitas ini');
                // }
            }

            DB::rollBack();
            return $this->getResponse(false,400,null,'Password lama yang anda masukkan tidak sesuai');
        }
    }
}
