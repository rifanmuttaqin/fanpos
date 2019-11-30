<!-- Note pada page ini posisi tag form masih belum benar, harap dicari solusinya kemudian -->

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

			<div class="card col-sm-12">
				<div class="card-body col-sm-12">

					<form  method="post" action="{{ route('doupdate') }}" enctype="multipart/form-data">

					@csrf

					<div class="form-group">
	                  <input type="text" class="form-control form-control-user" name ="nama" id="nama" placeholder="Nama Customer" value="{{ $customer->nama }}">
					@if ($errors->has('nama'))
					    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('nama') }}</p></div>
					@endif
	                </div>

	                <div class="form-group">
	                  <input type="text" class="form-control form-control-user" name="alamat" id="alamat" placeholder="Alamat" value="{{ $customer->alamat }}">
						@if ($errors->has('alamat'))
							<div><p style="color: red"><span>&#42;</span> {{ $errors->first('alamat') }}</p></div>
						@endif
	                </div>

	                <div class="form-group">
	                  	<input type="text" class="form-control form-control-user" name="nomor_telfon" id="nomor_telfon" placeholder="Nomor Telfon" value="{{ $customer->nomor_telfon }}">
						@if ($errors->has('nomor_telfon'))
							<div><p style="color: red"><span>&#42;</span> {{ $errors->first('nomor_telfon') }}</p></div>
						@endif
	                </div>

	                <div class="form-group">
	                  <input type="email" class="form-control form-control-user" value="{{$customer->email}}" name="email" id="email" placeholder="Email">
						@if ($errors->has('email'))
							<div><p style="color: red"><span>&#42;</span> {{ $errors->first('email') }}</p></div>
						@endif
	                </div>

	                <!-- Hiden value for id -->
	                <input name="customerid" type="hidden" value="{{ $customer->id }}">

					<div class="form-group" style="padding-top: 20px">
						<button type="submit" class="btn btn-info"> UPDATE </button>
					</div>

					</form>

				</div>	
			</div>
@endsection

@push('scripts')

<script type="text/javascript">
	
</script>

@endpush

