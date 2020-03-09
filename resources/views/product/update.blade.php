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
	
	<form  method="post" action="{{ route('update-product') }}" enctype="multipart/form-data">

	@csrf

	<input value="{{ $product->id }}" type="hidden" class="form-control form-control-user" name ="id_product" id="id_product">

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

	@if(!empty($product->productimage))

	<div class="panel panel-default">
		<div class="panel-heading"><strong>Foto Produk</strong></div>
		<br>
		<div class="container" style="padding-left: 10px">
			<div class="row">
		
			@foreach($product->productimage as $product_image)

				@if($product_image != null)

				<div class="col-sm-2 imgUp" style="padding-left: 0px">
					<div class="imagePreviewUpdate" style="background-image:url({{ URL::to('/').'/storage/product/'.$product_image->image_url }})"></div>
					<label class="btn btn-primary">
						<i class="fas fa-upload"></i>
					<input type="file" name="file[]" class="uploadFile img" value="" style="width: 0px;height: 0px;overflow: hidden;">
					</label>
				</div>

				@endif

			@endforeach

				<i class="fa fa-plus imgAddUpdate"></i>
			</div>
		</div>
	</div>	

	@endif

	<div class="form-group" style="padding-top:10px">
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
		<input value="<?= $product->has_varian == Product::PRODUCT_HAS_NOT_VARIANT ? $product->variant->variantDetail[0]->harga_beli : null  ?>" type="text" class="form-control form-control-user" name ="single_harga_beli" id="single_harga_beli">
		@if ($errors->has('single_harga_beli'))
			<div><p style="color: red"><span>&#42;</span> {{ $errors->first('single_harga_beli') }}</p></div>
		@endif
		</div>
		
		<!-- Fill if product single -->
		<input value="{{ $product->variant->variantDetail[0]->variant_code }}" type="hidden" class="form-control form-control-user" name ="single_variant_code" id="single_variant_code">

		<div class="form-group">
		<label>Harga Jual</label>
		<input value="<?= $product->has_varian == Product::PRODUCT_HAS_NOT_VARIANT ? $product->variant->variantDetail[0]->harga_jual : null ?>" type="text" class="form-control form-control-user" name ="single_harga_jual" id="single_harga_jual">
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

	<!-- Dynamic Form -->

	<div class="table-responsive">
			
				<span id="result"></span>
				<table class="table table-bordered table-striped" id="user_table">
			<thead>
			<tr>
				<th width="35%">Option</th>
				<th width="35%">Harga Jual</th>
				<th width="35%">Harga Beli</th>
				
				<th width="30%">Action</th>
			</tr>
			</thead>
			<tbody>

			@foreach ($product->variant->variantDetail as $index => $variant)
			
			<tr>
			<td><input type="text" value="{{ $variant->option}}"  name="variant_detail['option'][]" class="form-control" /></td>
			<td><input type="text" value="{{ $variant->harga_jual }}" name="variant_detail['harga_jual'][]" class="form-control" /></td>
			<td><input type="text" value="{{ $variant->harga_beli }}" name="variant_detail['harga_beli'][]" class="form-control" /></td>
			<input type="hidden" value="{{ $variant->variant_code }}" name="variant_detail['variant_code'][]" class="form-control" />
			
			@if($index == 0)
			<td><button type="button" name="add" id="add" class="btn btn-success"><i class="fas fa-plus-square"></i></i></button></td></tr>
			@else
			<td><button type="button" name="remove" id="remove" class="btn btn-danger remove"><i class="fas fa-fw fa-trash-alt"></i></button></td></tr>
			@endif

			</tr>

			@endforeach
		
			</tbody>
		</table>
		
	</div>

	<!-- End Dynamic Form -->


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

		// Dynamic Form Begin

		var index;
		var count = <?= count($product->variant->variantDetail) ?>;
			
		dynamic_field(count);

		function dynamic_field(count)
		{
			html = '<tr>';
			html += '<td><input type="text" name="option[]" class="form-control" /></td>';
			html += '<td><input type="text" name="harga_jual[]" class="form-control" /></td>';
			html += '<td><input type="text" name="harga_beli[]" class="form-control" /></td>';

			if(count != 0)
			{
				html += '<td><button type="button" name="remove" id="remove" class="btn btn-danger remove"><i class="fas fa-fw fa-trash-alt"></i></button></td></tr>';
            	$('tbody').append(html);
			}

		}

		$(document).on('click', '#add', function(){
			count++;
			dynamic_field(count);
		});

		$(document).on('click', '.remove', function(){
			count--;
			$(this).closest("tr").remove();
			console.log(count);
		});

		$('#dynamic_form').on('submit', function(event){
				event.preventDefault();
				$.ajax({
					url:'#',
					method:'post',
					data:$(this).serialize(),
					dataType:'json',
					beforeSend:function(){
						$('#save').attr('disabled','disabled');
					},
					success:function(data)
					{
						if(data.error)
						{
							var error_html = '';
							for(var count = 0; count < data.error.length; count++)
							{
								error_html += '<p>'+data.error[count]+'</p>';
							}
							$('#result').html('<div class="alert alert-danger">'+error_html+'</div>');
						}
						else
						{
							dynamic_field(1);
							$('#result').html('<div class="alert alert-success">'+data.success+'</div>');
						}
						$('#save').attr('disabled', false);
					}
				})
				
				// End Dynamic Form 
		});
     
	});


</script>

@endpush