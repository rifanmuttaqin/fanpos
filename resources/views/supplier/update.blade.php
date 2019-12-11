<!-- Update Gambar Belum Selesai Clear File Masih Trouble-->

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

					<form  method="post" action="{{ route('doupdate') }}" enctype="multipart/form-data">

					@csrf

					<div class="form-group">
					<label>Nama</label>
	                  <input type="text" class="form-control form-control-user" name ="nama" id="nama" placeholder="Nama Supplier" value="{{ $supplier->nama }}">
					@if ($errors->has('nama'))
					    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('nama') }}</p></div>
					@endif
	                </div>

	                <div class="form-group">
	                <label>Alamat</label>
	                  <input type="text" class="form-control form-control-user" name="alamat" id="alamat" placeholder="Alamat" value="{{ $supplier->alamat }}">
						@if ($errors->has('alamat'))
							<div><p style="color: red"><span>&#42;</span> {{ $errors->first('alamat') }}</p></div>
						@endif
	                </div>

	                <div class="form-group">
	                <label>Nomor Telfon</label>
	                  	<input type="text" class="form-control form-control-user" name="nomor_telfon" id="nomor_telfon" placeholder="Nomor Telfon" value="{{ $supplier->nomor_telfon }}">
						@if ($errors->has('nomor_telfon'))
							<div><p style="color: red"><span>&#42;</span> {{ $errors->first('nomor_telfon') }}</p></div>
						@endif
	                </div>

	                <div class="form-group">
	                <label>Email</label>
	                  <input type="email" class="form-control form-control-user" value="{{$supplier->email}}" name="email" id="email" placeholder="Email">
						@if ($errors->has('email'))
							<div><p style="color: red"><span>&#42;</span> {{ $errors->first('email') }}</p></div>
						@endif
	                </div>

	                <!-- Hiden value for id -->
	                <input name="supplierid" type="hidden" value="{{ $supplier->id }}">

					<div class="form-group" style="padding-top: 20px">
						<button type="submit" class="btn btn-info"> UPDATE </button>
					</div>

				</div>	
			</div>

			<!-- Profile Picture  -->

			<div class="card col-sm-4">
				<div style="text-align: center; padding-top: 20px">
					<img src="<?= $supplier->url_profile_pic != null ? URL::to('/').'/storage/supplier_profile/'.$supplier->url_profile_pic : URL::to('/layout/assets/img/avatar.png') ?>" style="width:200px;height:200px;" class="img-thumbnail center-cropped" id="profile_pic">
				</div>

				<div style="text-align: center; padding-top: 10px">

				<!-- Delete Button -->
								
				<div id="trash" style="<?= $supplier->url_profile_pic != null ? '' : 'display: none' ?>;">
					<button type="button" class="btn btn-info" id="delete_image">
						<i class="fas fa-trash"></i>
					</button>
				</div>

				<!-- Upload Form  -->
				<div id="upload" style="<?= $supplier->url_profile_pic != null ? 'display: none' : '' ?>;">
					<input type="file" name="file" id="file" class="inputfile" accept="image/x-png,image/gif,image/jpeg"/>
					<label for="file"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Pilih Gambar</label>
					<p> Gambar Max. 2 MB </p>

					</form>				
				
				</div>

				</div>
			</div>

@endsection

@push('scripts')

<script type="text/javascript">

$( document ).ready(function() {

	clearFile();

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
 	
	 	clearFile();   
	    showUploadImage();

	});

});

function showUploadImage()
{
    $('#profile_pic').attr('src', '{{URL::to('/layout/assets/img/avatar.png')}}');
    $('#upload').show();
    $('#trash').hide();
}

function showTrashImage()
{
	$('#profile_pic').attr('src', '{{URL::to('/layout/assets/img/avatar.png')}}');
	$('#upload').hide();
    $('#trash').show();
}

function readURL(input) {
  
  showTrashImage();

  if (input.files && input.files[0]) {

    var reader = new FileReader();
    reader.onload = function(e) {
      $('#profile_pic').attr('src', e.target.result);
    }
  
    reader.readAsDataURL(input.files[0]);
  }

}

// Clear file sebelum diproses
function clearFile()
{
	$('#file').val('');
}

</script>

@endpush

