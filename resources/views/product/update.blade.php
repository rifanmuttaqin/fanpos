@extends('master')

@section('title', '')

@section('content')

<div class="card col-sm-12">
	<div class="card-body col-sm-12">
	
	<form  method="post" action="{{ route('update-product') }}" enctype="multipart/form-data">

	@csrf

	<div class="form-group">
	<label>Nama Produk</label>
	  <input value="{{ $product->nama_product }}" type="text" class="form-control form-control-user" name ="nama_product" id="nama_product">
	@if ($errors->has('nama_product'))
	    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('nama_product') }}</p></div>
	@endif
	</div>

	<div class="form-group">
	<label>SKU Induk</label>
	  <input value="{{ $product->sku }}" type="text" class="form-control form-control-user" name ="sku" id="sku">
	@if ($errors->has('sku'))
	    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('sku') }}</p></div>
	@endif
	</div>

	<div class="form-group">
	<label>Berat</label>
	  <input value="{{ $product->berat }}" type="text" class="form-control form-control-user" name ="berat" id="berat">
	@if ($errors->has('berat'))
	    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('berat') }}</p></div>
	@endif
	</div>

	
	<div class="form-group">
		<label>Satuan</label>
		<?= $satuan_option ?>
	@if ($errors->has('satuan_id'))
	    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('satuan_id') }}</p></div>
	@endif
	</div>

	<div class="form-group">
		<label>Kategori</label>
		<?= $kategori_option ?>
	@if ($errors->has('kategori_id'))
	    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('kategori_id') }}</p></div>
	@endif
	</div>

	<div class="form-group">
	<label>Volume</label>
	  <input value="{{ $product->volume }}" type="text" class="form-control form-control-user" name ="volume" id="volume">
	@if ($errors->has('volume'))
	    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('volume') }}</p></div>
	@endif
	</div>

	<!-- Harus Diganti Render nya -->

	@if($product->productimage != null)

		<div class="panel panel-default">
		@foreach($product->productimage as $product_image)

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
					<!-- <i class="fa fa-plus imgAdd"></i> -->
				</div>
			</div>
			@endforeach
		</div>
	
	@endif

	<div class="form-group">
	<label>Expired Tanggal</label>
	  <input value="{{ $product->exp }}" type="date" class="form-control form-control-user" name ="exp" id="exp">
	@if ($errors->has('exp'))
	    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('exp') }}</p></div>
	@endif
	</div>

	<div class="form-group">
	<label>Merek / Brand</label>
	  <input value="{{ $product->merek }}" type="text" class="form-control form-control-user" name ="merek" id="merek">
	@if ($errors->has('merek'))
	    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('merek') }}</p></div>
	@endif
	</div>

	<!-- ----------------- Hidden IF Has Varian -->
	<div id="showhide">

		<div class="form-group">
		<label>Harga Beli</label>
		<input value="{{ $product->single_harga_beli }}" type="text" class="form-control form-control-user" name ="single_harga_beli" id="single_harga_beli">
		@if ($errors->has('single_harga_beli'))
			<div><p style="color: red"><span>&#42;</span> {{ $errors->first('single_harga_beli') }}</p></div>
		@endif
		</div>

		<div class="form-group">
		<label>Harga Jual</label>
		<input value="{{ $product->single_harga_jual }}" type="text" class="form-control form-control-user" name ="single_harga_jual" id="single_harga_jual">
		@if ($errors->has('single_harga_jual'))
			<div><p style="color: red"><span>&#42;</span> {{ $errors->first('single_harga_jual') }}</p></div>
		@endif
		</div>
	
	</div>
	<!-------------------------------------------------->

	<div class="form-group">
	<label>Deskripsi Produk</label>
	  <textarea type="text" class="form-control form-control-user" name ="deskripsi" id="deskripsi"> {{ $product->deskripsi }} </textarea>
	@if ($errors->has('deskripsi'))
	    <div><p style="color: red"><span>&#42;</span> {{ $errors->first('deskripsi') }}</p></div>
	@endif
	</div>
	
	
	
	<div class="col-sm-1" style="padding-left: 0px">
	
	<label><strong>Variasi</strong></label>
		<input name="varian_check"; <?= $product->has_varian != Product::PRODUCT_HAS_NOT_VARIANT ? 'checked' : ''; ?> id="varian_check" type="checkbox" data-toggle="toggle">
	</div>

	<div id="varian_form">
	
	<hr>

	<label><strong> VARIAN OPTION </strong></label>

	<div class="form-group">
		<label>Nama Variasi</label>
		<input type="text" class="form-control form-control-user" value="{{$product->variant->nama_variant}}" name ="nama_variant" id="nama_variant">
		@if ($errors->has('nama_variant'))
			<div><p style="color: red"><span>&#42;</span> {{ $errors->first('nama_variant') }}</p></div>
		@endif
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
		<button type="submit" class="btn btn-info"> UPDATE </button>
	</div>

	</form>

	</div>
</div>

@endsection

@push('scripts')

<script>

	function loadVarian()
	{
		var has_variant = "{{ $product->has_varian }}";

		if(has_variant == "{{ Product::PRODUCT_HAS_VARIANT }}")
		{
			$('#varian_check').prop("checked", true);
			$('#varian_form').show();
			$('#showhide').hide();
		}
		else if(has_variant == "{{ Product::PRODUCT_HAS_NOT_VARIANT }}")
		{
			$("#varian_check").prop("checked", false);
			$('#varian_form').hide();
			$('#showhide').show();
		}
		
	}

	
	$( document ).ready(function() {
		
		loadVarian();
				
		$("#varian_check").change(function() {

			if($('#varian_check').is(":checked"))
			{
				$('#varian_form').show();
				$('#showhide').hide();
			} 
			else
			{
				$('#varian_form').hide();
				$('#showhide').show();
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

		$('#satuan_id').select2({
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
		});

		$('#kategori_id').select2({
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
		});
      
	});


</script>

@endpush