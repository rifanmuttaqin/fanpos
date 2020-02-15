@extends('master')

@section('title', '')

@section('content')

<div class="card col-sm-12">
	<div class="card-body col-sm-12">
	
	<form  method="post" action="{{ route('store-product') }}" enctype="multipart/form-data">

	@csrf

	<div class="form-group">
	<label>Nama Produk</label>
	  <input type="text" class="form-control form-control-user" name ="nama_product" id="nama_product">
	@if ($errors->has('nama_product'))
	    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('nama_product') }}</p></div>
	@endif
	</div>

	<div class="form-group">
	<label>SKU Induk</label>
	  <input type="text" class="form-control form-control-user" name ="sku" id="sku">
	@if ($errors->has('sku'))
	    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('sku') }}</p></div>
	@endif
	</div>

	<div class="form-group">
	<label>Berat</label>
	  <input type="text" class="form-control form-control-user" name ="berat" id="berat">
	@if ($errors->has('berat'))
	    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('berat') }}</p></div>
	@endif
	</div>

	
	<div class="form-group">
		<label>Satuan</label>
		<select style="width: 100%" class="form-control form-control-user select2-class" name="satuan" id="satuan">
		<option value="AL"> </option>
		<option value="WY"> </option>
		</select>
	@if ($errors->has('satuan'))
	    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('satuan') }}</p></div>
	@endif
	</div>


	<div class="form-group">
		<label>Kategori</label>
		<select style="width: 100%" class="form-control form-control-user select2-class" id="kategori" name="kategori">
		<option value="AL"></option>
		<option value="WY"></option>
		</select>
	@if ($errors->has('kategori'))
	    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('kategori') }}</p></div>
	@endif
	</div>

	<div class="form-group">
	<label>Volume</label>
	  <input type="text" class="form-control form-control-user" name ="volume" id="volume">
	@if ($errors->has('volume'))
	    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('volume') }}</p></div>
	@endif
	</div>

	<div class="panel panel-default">
	<div class="panel-heading"><strong>Foto Produk</strong></div>
	<br>
	<div class="container" style="padding-left: 10px">
		<div class="row">
			<div class="col-sm-2 imgUp" style="padding-left: 0px">
				<div class="imagePreview"></div>
				<label class="btn btn-primary">
					<i class="fas fa-upload"></i>
				<input type="file" name="file[]" class="uploadFile img" value="" style="width: 0px;height: 0px;overflow: hidden;">
				</label>
			</div>
			<i class="fa fa-plus imgAdd"></i>
		</div>
	</div>
	</div>

	<div class="form-group">
	<label>Expired Tanggal</label>
	  <input type="date" class="form-control form-control-user" name ="exp" id="exp">
	@if ($errors->has('exp'))
	    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('exp') }}</p></div>
	@endif
	</div>

	<div class="form-group">
	<label>Merek / Brand</label>
	  <input type="text" class="form-control form-control-user" name ="merek" id="merek">
	@if ($errors->has('merek'))
	    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('merek') }}</p></div>
	@endif
	</div>

	<div class="form-group">
	<label>Deskripsi Produk</label>
	  <textarea type="text" class="form-control form-control-user" name ="deskripsi" id="deskripsi"> </textarea>
	@if ($errors->has('deskripsi'))
	    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('deskripsi') }}</p></div>
	@endif
	</div>

	

	<div class="col-sm-1" style="padding-left: 0px">
	<label><strong>Variasi</strong></label>
		<input name="varian_check" id="varian_check" type="checkbox" data-toggle="toggle">
	</div>

	<div id="varian_form" style="display: none">
	
	<hr>
	
	<label><strong> VARIAN OPTION </strong></label>

	<div class="form-group">
	<label>Nama Variasi</label>
	  <input type="text" class="form-control form-control-user" name ="varian" id="varian">
	@if ($errors->has('varian'))
	    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('varian') }}</p></div>
	@endif
	</div>

	<div class="container" style="padding-left: 0px">
		<div class="row">
		<div class="col-md-12">
		    <div data-role="dynamic-fields">
		        <div class="form-inline">
		            <div class="form-group">
		                <label class="sr-only" for="field-name">Pilihan</label>
		                <input type="text" name="variant_detail['option'][]" class="form-control" id="field-name" placeholder="Pilihan">
		            </div>

		            <span>&nbsp - &nbsp</span>
		            
		            <div class="form-group">
		                <label class="sr-only" for="field-value">Harga</label>
		                <input type="text" name="variant_detail['harga'][]" class="form-control" id="field-value" placeholder="Harga">
		            </div>

		            <span>&nbsp - &nbsp</span>

		            <div class="form-group">
		                <label class="sr-only" name="stock[]" for="field-value">Stock</label>
		                <input type="text" class="form-control" id="field-value" placeholder="Stock">
		            </div>

		            <span>&nbsp &nbsp</span>
		            
		            <button class="btn btn-danger" data-role="remove">
		                <i class="fas fa-eraser"></i>
		            </button>
		            
		            <button class="btn btn-primary" data-role="add">
		                <i class="fas fa-plus"></i>
		            </button>
		        </div>  <!-- /div.form-inline -->
		    </div>  <!-- /div[data-role="dynamic-fields"] -->
		</div>  <!-- /div.col-md-12 -->
		</div>  <!-- /div.row -->
	</div>

	</div>

	<div class="col-sm-1" style="padding-left: 0px; padding-top: 10px">
	
	<label><strong>Grosir</strong></label>
		<input name="grosir_check" id="grosir_check" type="checkbox" data-toggle="toggle">
	</div>

	<div id="grosir_form" style="display: none">
		
		<hr>

		<label><strong> GROSIR OPTION </strong> <small><p style="color: blue">(Grosir berlaku jika harga varian tidak ada yang berbeda)</p></small></label>
		<div class="container" style="padding-left: 0px">
		<div class="row">
		<div class="col-md-12">
		    <div data-role="dynamic-fields">
		        <div class="form-inline">
		            <div class="form-group">
		                <label class="sr-only" for="field-name">Minimal</label>
		                <input type="text" name="min[]" class="form-control" id="minimal" placeholder="Minimal">
		            </div>

		            <span>&nbsp - &nbsp</span>
		            
		            <div class="form-group">
		                <label class="sr-only" for="field-value">Maksimal</label>
		                <input type="text" name="mak[]" class="form-control" id="maksimal" placeholder="Maksimal">
		            </div>

		            <span>&nbsp - &nbsp</span>

		            <div class="form-group">
		                <label class="sr-only" name="stock[]" for="field-value">Harga Satuan</label>
		                <input  name="harga_satuan[]" type="text" class="form-control" id="harga_satuan" placeholder="Harga Satuan">
		            </div>

		            <span>&nbsp &nbsp</span>
		            
		            <button class="btn btn-danger" data-role="remove">
		                <i class="fas fa-eraser"></i>
		            </button>
		            
		            <button class="btn btn-primary" data-role="add">
		                <i class="fas fa-plus"></i>
		            </button>
		        </div>  
		    </div>  
		</div> 
		</div>
	</div>

	</div>

	<div class="form-group" style="padding-top: 20px">
		<button type="submit" class="btn btn-info"> TAMBAH </button>
	</div>

	</form>

	</div>
</div>

@endsection

@push('scripts')

<script>
	
	$( document ).ready(function() {

		$('.select2-class').select2();  

		$('#varian_check').prop('checked', false);
		$('#grosir_check').prop('checked', false);

		$("#varian_check").change(function() {

			if($('#varian_check').is(":checked"))
			{
				$('#varian_form').show();
			} 
			else
			{
				$('#varian_form').hide();
			}

		});

		$("#grosir_check").change(function() {

			if($('#grosir_check').is(":checked"))
			{
				$('#grosir_form').show();
			} 
			else
			{
				$('#grosir_form').hide();
			}

		});

		// --------------- select2 catch data----------------------

		$('#satuan').select2({
			allowClear: true,
			ajax: {
			url: '{{route("list-satuan")}}',
			type: "POST",
			dataType: 'json',
				data: function(params) {
				  return {
				  	"_token": "{{ csrf_token() }}",
				    search: params.term
				  }
				},
				processResults: function (data, page) {
				  return {
				    results: data
				  };
				}
			}
		})

		$('#kategori').select2({
			allowClear: true,
			ajax: {
			url: '{{route("list-kategori")}}',
			type: "POST",
			dataType: 'json',
				data: function(params) {
				  return {
				  	"_token": "{{ csrf_token() }}",
				    search: params.term
				  }
				},
				processResults: function (data, page) {
				  return {
				    results: data
				  };
				}
			}
		})

	});

</script>

@endpush