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

					<form  method="post" action="{{ route('update-toko') }}" enctype="multipart/form-data">

					@csrf

					<div class="form-group">
	                  <input type="text" class="form-control form-control-user" name ="nama_toko" id="nama_toko" placeholder="Nama Toko" value="{{ $toko->nama_toko }}">
					@if ($errors->has('nama_toko'))
					    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('nama_toko') }}</p></div>
					@endif
	                </div>

	                <div class="form-group">
	                  <input type="text" class="form-control form-control-user" name="npwp" id="npwp" placeholder="NPWP" value="{{ $toko->npwp }}">
						@if ($errors->has('npwp'))
							<div><p style="color: red"><span>&#42;</span> {{ $errors->first('npwp') }}</p></div>
						@endif
	                </div>

	                <div class="form-group">
	                  <input type="text" class="form-control form-control-user" name="alamat_toko" id="alamat_toko" placeholder="Alamat Toko" value="{{ $toko->alamat_toko }}">
						@if ($errors->has('alamat_toko'))
							<div><p style="color: red"><span>&#42;</span> {{ $errors->first('alamat_toko') }}</p></div>
						@endif
	                </div>

	                <div class="form-group">
	                  <input type="text" class="form-control form-control-user" name="nomor_telfon" id="nomor_telfon" placeholder="Nomor Telfon" value="{{ $toko->nomor_telfon }}">
						@if ($errors->has('nomor_telfon'))
							<div><p style="color: red"><span>&#42;</span> {{ $errors->first('nomor_telfon') }}</p></div>
						@endif
	                </div>

	                <div class="form-group">
	                  <input type="email" class="form-control form-control-user" name="email" id="email" placeholder="Email" value="{{ $toko->email }}">
						@if ($errors->has('email'))
							<div><p style="color: red"><span>&#42;</span> {{ $errors->first('email') }}</p></div>
						@endif
	                </div>

	                <div class="form-group">
	                  <input type="text" class="form-control form-control-user" name="fax" id="fax" placeholder="Fax" value="{{ $toko->fax }}">
						@if ($errors->has('fax'))
							<div><p style="color: red"><span>&#42;</span> {{ $errors->first('fax') }}</p></div>
						@endif
	                </div>

	                <div class="form-group">
	                  <input type="text" class="form-control form-control-user" name="website" id="website" placeholder="Website" value="{{ $toko->website }}">
						@if ($errors->has('website'))
							<div><p style="color: red"><span>&#42;</span> {{ $errors->first('website') }}</p></div>
						@endif
	                </div>

	                <div class="form-group">
	                  <input type="text" class="form-control form-control-user" name="kode_pos" id="kode_pos" placeholder="Kode Pos" value="{{ $toko->kode_pos }}">
						@if ($errors->has('kode_pos'))
							<div><p style="color: red"><span>&#42;</span> {{ $errors->first('kode_pos') }}</p></div>
						@endif
	                </div>


	                <!-- Hiden value for id -->
	                <input name="supplierid" type="hidden" value="">

					<div class="form-group" style="padding-top: 20px">
						<button type="submit" class="btn btn-info"> UPDATE </button>
					</div>

				</div>	
			</div>

			<!-- Profile Picture  -->

			<div class="card col-sm-4">
				<div style="text-align: center; padding-top: 20px">
					<img src="" style="width:200px;height:200px;" class="img-thumbnail center-cropped" id="profile_pic">
				</div>

				<div style="text-align: center; padding-top: 10px">

				<!-- Delete Button -->
								
				<div id="trash" style="">
					<button type="button" class="btn btn-info" id="delete_image">
						<i class="fas fa-trash"></i>
					</button>
				</div>

				<!-- Upload Form  -->
				<div id="upload" style="display: none">
					<input type="file" name="file" id="file" class="inputfile" accept="image/x-png,image/gif,image/jpeg"/>
					<label for="file"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload Logo</label>
					<p> Gambar Max. 2 MB </p>

					</form>				
				</div>

				</div>
			</div>

@endsection

@push('scripts')

<script type="text/javascript">

</script>

@endpush

