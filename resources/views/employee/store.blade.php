@extends('master')

@section('title', '')

@section('content')

			<div class="card col-sm-8">
				<div class="card-body col-sm-12">

					<form  method="post" action="{{ route('store-employee') }}" enctype="multipart/form-data">

					@csrf

					<div class="form-group">
					<label>NIK</label>
	                  <input type="text" class="form-control form-control-user" name ="nik" id="nik" placeholder="NIK">
					@if ($errors->has('nik'))
					    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('nik') }}</p></div>
					@endif
	                </div>

	                <div class="form-group">
	                <label>Username</label>
	                  <input type="text" class="form-control form-control-user" name ="username" id="username" placeholder="Username">
					@if ($errors->has('username'))
					    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('username') }}</p></div>
					@endif
	                </div>

	                <div class="form-group">
	                <label>Password</label>
	                  <input type="password" class="form-control form-control-user" name ="password" id="password" placeholder="Password">
					@if ($errors->has('password'))
					    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('password') }}</p></div>
					@endif
	                </div>

	                <div class="form-group">
	                <label>Repassword</label>
	                  <input type="password" class="form-control form-control-user" name ="password_confirmation" id="password_confirmation" placeholder="Repassword">
					@if ($errors->has('repassword'))
					    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('repassword') }}</p></div>
					@endif
	                </div>

					<div class="form-group">
					<label>Nama Pegawai</label>
	                  <input type="text" class="form-control form-control-user" name ="full_name" id="full_name" placeholder="Nama Pegawai">
					@if ($errors->has('full_name'))
					    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('full_name') }}</p></div>
					@endif
	                </div>

	                <div class="form-group">
	                <label>Email</label>
	                  <input type="text" class="form-control form-control-user" name ="email" id="email" placeholder="Email">
					@if ($errors->has('email'))
					    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('email') }}</p></div>
					@endif
	                </div>

	                <div class="form-group">
	                <label>Alamat</label>
	                  <textarea type="text" class="form-control form-control-user" name ="address" id="address" placeholder="Alamat"></textarea>
					@if ($errors->has('address'))
					    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('address') }}</p></div>
					@endif
	                </div>

	                <div class="form-group">
	                <label>Jenis Kelamin</label>
						<select class="form-control form-control-user" id="jenis_kelamin" name="jenis_kelamin">
						<option value="{{ UserEmployee::JENIS_KELAMIN_LAKI_LAKI }}">Laki Laki</option>
						<option value="{{ UserEmployee::JENIS_KELAMIN_PEREMPUAN }}">Perempuan</option>
						</select> 
					@if ($errors->has('jenis_kelamin'))
					    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('jenis_kelamin') }}</p></div>
					@endif
	                </div>

	                <div class="form-group">
	                	<label>Agama</label>
						<select class="form-control form-control-user" id="agama" name="agama">
						<option value="{{UserEmployee::AGAMA_ISLAM}}">Islam</option>
						<option value="{{UserEmployee::AGAMA_KRISTEN}}">Kristen</option>
						<option value="{{UserEmployee::AGAMA_BUDHA}}">Budha</option>
						<option value="{{UserEmployee::AGAMA_KONGHUCU}}">Konghucu</option>
						<option value="{{UserEmployee::AGAMA_KATOLIK}}">Katolik</option>
						</select> 
					@if ($errors->has('agama'))
					    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('agama') }}</p></div>
					@endif
	                </div>

	                <div class="form-group">
	                <label>Tempat Lahir</label>
	                  <input type="text" class="form-control form-control-user" name ="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir">
					@if ($errors->has('tempat_lahir'))
					    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('tempat_lahir') }}</p></div>
					@endif
	                </div>

	                <div class="form-group">
	                <label>Tanggal Lahir</label>
	                  <input type="date" class="form-control form-control-user" type="text" id="tanggal_lahir" name="tanggal_lahir"> 
					@if ($errors->has('tanggal_lahir'))
					    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('tanggal_lahir') }}</p></div>
					@endif
	                </div>

	                <div class="form-group">
	                <label>Status Pernikahan</label>
						<select class="form-control form-control-user" id="status_pernikahan" name="status_pernikahan">
						<option value="{{UserEmployee::STATUS_BELUM_MENIKAH}}">Belum Menikah</option>
						<option value="{{UserEmployee::STATUS_MENIKAH}}">Menikah</option>
						</select> 
					@if ($errors->has('status_pernikahan'))
					    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('status_pernikahan') }}</p></div>
					@endif
	                </div>

	                <div class="form-group">
	                <label>Phone</label>
	                  <input type="text" class="form-control form-control-user" name ="phone" id="phone" placeholder="Nomor Telfon">
					@if ($errors->has('phone'))
					    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('phone') }}</p></div>
					@endif
	                </div>

	                <div class="form-group">
	                <label>Tanggal Masuk</label>
	                  <input type="date" class="form-control form-control-user" type="text" id="tanggal_masuk" name="tanggal_masuk"> 
					@if ($errors->has('tanggal_masuk'))
					    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('tanggal_masuk') }}</p></div>
					@endif
	                </div>

	                <div class="form-group">
	                <label>Tipe Karyawan</label>
						<select class="form-control form-control-user" id="tipe_karyawan" name="tipe_karyawan">
						<option value="{{UserEmployee::TIPE_KARYAWAN_KONTRAK}}">Kontrak</option>
						<option value="{{UserEmployee::TIPE_KARYAWAN_TETAP}}">Tetap</option>
						</select> 
					@if ($errors->has('tipe_karyawan'))
					    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('tipe_karyawan') }}</p></div>
					@endif
	                </div>

	                <div class="form-group">
	                <label>Keterangan</label>
	                  <textarea type="text" class="form-control form-control-user" name ="keterangan" id="keterangan" placeholder="Keterangan"></textarea>
					@if ($errors->has('keterangan'))
					    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('keterangan') }}</p></div>
					@endif
	                </div>

					<div class="form-group" style="padding-top: 20px">
						<button type="submit" class="btn btn-info"> TAMBAH </button>
					</div>
					
				</div>	
			</div>

			<!-- Profile Picture  -->

			<div class="card col-sm-4">
				<div style="text-align: center; padding-top: 20px">
					<img src="{{URL::to('/layout/assets/img/avatar.png')}}" style="width:200px;height:200px;" class="img-thumbnail center-cropped" id="profile_pic">
				</div>

				<div style="text-align: center; padding-top: 10px">
				
				<input type="file" name="file" id="file" class="inputfile" accept="image/x-png,image/gif,image/jpeg"/>
				<label for="file"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Pilih Gambar</label>

				<p> Gambar Max. 2 MB </p>

				</form>

				</div>
			</div>
			

@endsection

@push('scripts')

<script type="text/javascript">

$( document ).ready(function() {

  $("#file").change(function() {
    
    var size = this.files[0].size;
  
    if(size >= 2000587)
    {
      swal('Ukuran file maksimal 2 MB', { button:false, icon: "error", timer: 1000});
      return false;
    }

    readURL(this);

  });

});

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#profile_pic').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]);
  }
}

</script>


@endpush

