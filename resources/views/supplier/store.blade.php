<!-- Note pada page ini posisi tag form masih belum benar, harap dicari solusinya kemudian -->

@extends('master')

@section('title', '')

@section('content')

			<div class="card col-sm-8">
				<div class="card-body col-sm-12">

					<form  method="post" action="{{ route('store-supplier') }}" enctype="multipart/form-data">

					@csrf

					<div class="form-group">
					<label>Nama</label>
	                  <input type="text" class="form-control form-control-user" name ="nama" id="nama" placeholder="Nama Supplier">
					@if ($errors->has('nama'))
					    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('nama') }}</p></div>
					@endif
	                </div>

	                <div class="form-group">
	                <label>Alamat</label>
	                  <input type="text" class="form-control form-control-user" name="alamat" id="alamat" placeholder="Alamat">
						@if ($errors->has('alamat'))
							<div><p style="color: red"><span>&#42;</span> {{ $errors->first('alamat') }}</p></div>
						@endif
	                </div>

	                <div class="form-group">
	                <label>Nomor Telfon</label>
	                  	<input type="text" class="form-control form-control-user" name="nomor_telfon" id="nomor_telfon" placeholder="Nomor Telfon">
						@if ($errors->has('nomor_telfon'))
							<div><p style="color: red"><span>&#42;</span> {{ $errors->first('nomor_telfon') }}</p></div>
						@endif
	                </div>

	                <div class="form-group">
	                <label>Email</label>
	                  <input type="email" class="form-control form-control-user" name="email" id="email" placeholder="Email">
						@if ($errors->has('email'))
							<div><p style="color: red"><span>&#42;</span> {{ $errors->first('email') }}</p></div>
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

