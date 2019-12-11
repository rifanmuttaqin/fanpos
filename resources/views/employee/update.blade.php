@extends('master')

@section('title', '')

@section('alert')

@if(Session::has('alert_success'))
  @component('components.alert')
        @slot('class')
            success
        @endslot
        @slot('title')
            Terimakasih
        @endslot
        @slot('message')
            {{ session('alert_success') }}
        @endslot
  @endcomponent
@elseif(Session::has('alert_error'))
  @component('components.alert')
        @slot('class')
            error
        @endslot
        @slot('title')
            Cek Kembali
        @endslot
        @slot('message')
            {{ session('alert_error') }}
        @endslot
  @endcomponent 
@endif

@endsection

@section('content')

			<div class="card col-sm-8">
				<div class="card-body col-sm-12">

					<form  method="post" action="{{ route('doupdate-employee') }}" enctype="multipart/form-data">

					@csrf

					<div class="form-group">
					<label>NIK</label>
	                  <input type="text" class="form-control form-control-user" value="{{$employeeData->employee->nik}}" name ="nik" id="nik" placeholder="NIK">
					@if ($errors->has('nik'))
					    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('nik') }}</p></div>
					@endif
	                </div>

					<div class="form-group">
					<label>Nama Pegawai</label>
	                  <input type="text" value="{{$employeeData->full_name}}" class="form-control form-control-user" name ="full_name" id="full_name" placeholder="Nama Pegawai">
					@if ($errors->has('full_name'))
					    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('full_name') }}</p></div>
					@endif
	                </div>

	                <div class="form-group">
	                <label>Email</label>
	                  <input type="text" value="{{$employeeData->email}}" class="form-control form-control-user" name ="email" id="email" placeholder="Email">
					@if ($errors->has('email'))
					    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('email') }}</p></div>
					@endif
	                </div>

	                <div class="form-group">
	                <label>Alamat</label>
	                  <textarea type="text" class="form-control form-control-user" name ="address" id="address" placeholder="Alamat">{{$employeeData->address}}</textarea>
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
	                  <input type="text" value="{{$employeeData->employee->tempat_lahir}}" class="form-control form-control-user" name ="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir">
					@if ($errors->has('tempat_lahir'))
					    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('tempat_lahir') }}</p></div>
					@endif
	                </div>

	                <div class="form-group">
	                <label>Tanggal Lahir</label>
	                  <input type="date" value="{{$employeeData->employee->tanggal_lahir}}" class="form-control form-control-user" type="text" id="tanggal_lahir" name="tanggal_lahir"> 
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
	                <label>Nomor Telfon</label>
	                  <input type="text" value="{{$employeeData->employee->phone}}" class="form-control form-control-user" name ="phone" id="phone" placeholder="Nomor Telfon">
					@if ($errors->has('phone'))
					    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('phone') }}</p></div>
					@endif
	                </div>

	                <div class="form-group">
	                <label>Tanggal Masuk</label>
	                  <input type="date" value="{{$employeeData->employee->tanggal_masuk}}" class="form-control form-control-user" type="text" id="tanggal_masuk" name="tanggal_masuk"> 
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
	                  <textarea type="text" class="form-control form-control-user" name ="keterangan" id="keterangan" placeholder="Keterangan">{{$employeeData->employee->keterangan}}</textarea>
					@if ($errors->has('keterangan'))
					    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('keterangan') }}</p></div>
					@endif
	                </div>

	                <input type="hidden" value="{{$employeeData->id}}" class="form-control form-control-user" type="text" id="idemployee" name="idemployee"> 

					<div class="form-group" style="padding-top: 20px">
						<button type="submit" class="btn btn-info"> UPDATE </button>
					</div>
					
				</div>	
			</div>

			<!-- Profile Picture  -->

			<div class="card col-sm-4">
				<div style="text-align: center; padding-top: 20px">
					<img src="<?= $employeeData->profile_picture != null ? URL::to('/').'/storage/profile_picture/'.$employeeData->profile_picture : URL::to('/layout/assets/img/no_logo.png') ?>" style="width:200px;height:200px;" class="img-thumbnail center-cropped" id="profile_pic">
				</div>

				<div style="text-align: center; padding-top: 10px">


				<!-- Delete Button -->
								
				<div id="trash" style="<?= $employeeData->profile_picture != null ? '' : 'display: none' ?>;">
					<button type="button" class="btn btn-info" id="delete_image">
						<i class="fas fa-trash"></i>
					</button>
				</div>
				
				<!-- Upload Form  -->
				<div id="upload" style="<?= $employeeData->profile_picture != null ? 'display: none' : '' ?>;">
					<input type="file" name="file" id="file" class="inputfile" accept="image/x-png,image/gif,image/jpeg"/>
					<label for="file"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload Foto</label>
					<p> Gambar Max. 2 MB </p>

					</form>				
				</div>
				
				</div>
			</div>
			

@endsection

@push('scripts')

<script type="text/javascript">

$( document ).ready(function() {

	// Set default value for dropdown
	$("#agama").val('{{$employeeData->employee->agama}}');
	$("#jenis_kelamin").val('{{$employeeData->employee->jenis_kelamin}}');
	$("#status_pernikahan").val('{{$employeeData->employee->status_pernikahan}}');
	$("#tipe_karyawan").val('{{$employeeData->employee->tipe_karyawan}}');

	$("#file").change(function() {

	var size = this.files[0].size;

	if(size >= 2000587)
	{
	swal('Ukuran file maksimal 2 MB', { button:false, icon: "error", timer: 1000});
	return false;
	}

	readURL(this);

	});

	$('#delete_image').click(function() { 
	 	
	 	var employee_id = '{{$employeeData->id}}';

		swal({
			title: "Are you sure?",
			text: "Once deleted, you will not be able to recover this imaginary file!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
			        type:'POST',
			        url: base_url + '/profile/deleteimage',
			        data:
			        {
			          "_token": "{{ csrf_token() }}",
			          employee_id : employee_id,
			        },
			        success:function(data) {
			          if(data.status != false)
			          {
			            swal(data.message, { button:false, icon: "success", timer: 1000});
			            clearFile();   
				   		showUploadImage();
			          }
			          else
			          {
			            swal(data.message, { button:false, icon: "error", timer: 1000});
			          }
			        },
			        error: function(error) {
			          var err = eval("(" + error.responseText + ")");
			          var array_1 = $.map(err, function(value, index) {
			              return [value];
			          });
			          var array_2 = $.map(array_1, function(value, index) {
			              return [value];
			          });
			          var message = JSON.stringify(array_2);
			          swal(message, { button:false, icon: "error", timer: 1000});
			        }
		    	});
					
				} else {
					swal("Gambar Aman");
			}
		});
	});
});

// Clear file sebelum diproses
function clearFile()
{
	$('#file').val('');
}

function showUploadImage()
{
    $('#profile_pic').attr('src', '{{URL::to('/layout/assets/img/no_logo.png')}}');
    $('#upload').show();
    $('#trash').hide();
}

function showTrashImage()
{
	$('#profile_pic').attr('src', '{{URL::to('/layout/assets/img/no_logo.png')}}');
	$('#upload').hide();
    $('#trash').show();
}

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

