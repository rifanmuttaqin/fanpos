<!-- Tambah dirubah dari submit ke AJAX -->

@extends('master')
 
@section('title', 'Produk')

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

<div style="padding-bottom: 20px">
  <a  href="{{route('create-product')}}" type="button" id="btnTambah" class="btn btn-info"> TAMBAH PRODUK </a>
</div>

<div class="table-responsive">
<table class="table table-bordered data-table display nowrap" style="width:100%">
    <thead>
        <tr>
            <th>Foto Product</th>
            <th>Nama Product</th>
            <th>variasi</th>
            <th width="100px">Action</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
</div>

@endsection

@push('scripts')

<script type="text/javascript">

var idproduct;
var table;

$(function () {

  table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,
      rowReorder: {
          selector: 'td:nth-child(2)'
      },
      responsive: true,
      ajax: "{{ route('product') }}",
      columns: [
          {data: 'product_image', name: 'product_image'},
          {data: 'nama_product', name: 'nama_product'},
          {data: 'variant', name: 'variant'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
      ]
  });
});

function btnUbah(id)
{
  window.location.href = base_url + '/product/update/' + id;
}

function btnDel(id)
{
  idproduct = id;
  swal({
      title: "Apakah anda yakin ingin menghapus ini ?",
      text: 'Dengan menghapus maka data yang berkaitan dengan produk ini akan dihilangkan | terkecuali pada transaksi', 
      icon: "warning",
      buttons: true,
      dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      $.ajax({
        type:'POST',
        url: base_url + '/product/delete',
        data:{
          idproduct:idproduct, 
          "_token": "{{ csrf_token() }}",},
        success:function(data) {
          
          if(data.status != false)
          {
            swal(data.message, { button:false, icon: "success", timer: 1000});
          }
          else
          {
            swal(data.message, { button:false, icon: "error", timer: 1000});
          }
          table.ajax.reload();
        },
        error: function(error) {
          swal('Terjadi kegagalan sistem', { button:false, icon: "error", timer: 1000});
        }
      });      
    }
  });
}

$( document ).ready(function() {


})

</script>

@endpush