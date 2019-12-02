<!-- Tambah dirubah dari submit ke AJAX -->

@extends('master')
 
@section('title', 'Kategori')

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
  <a  href="#" type="button" id="btnTambah" class="btn btn-info"> TAMBAH </a>
</div>

<div class="table-responsive">
<table class="table table-bordered data-table display nowrap" style="width:100%">
    <thead>
        <tr>
            <th>Nama Kategori</th>
            <th>Keterangan</th>
            <th width="100px">Action</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
</div>

@endsection

@section('modal')

<!-- Modal Update -->

<div class="modal fade" id="detailModal" role="dialog" >
<div class="modal-dialog modal-md">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">

    <div class="form-group">
      <label>Nama Kategori</label>
      <input type="text" class="form-control" value="" name="nama_kategori" id="nama_kategori">
    </div>

    <div class="form-group">
      <label>Keterangan</label>
      <input type="text" class="form-control" value="" name="keterangan" id="keterangan">
    </div>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-danger pull-right" id="hapus_action">Hapus</button>
      <button type="button" id="update_data" class="btn btn-success pull-left">Update</button>
    </div>
  </div>
</div>
</div>


<!-- Modal Create -->

<div class="modal fade" id="createModal" role="dialog" >
<div class="modal-dialog modal-md">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">

    <div class="form-group">
      <label>Nama Kategori</label>
      <input type="text" class="form-control" value="" name="nama_kategori_add" id="nama_kategori_add">
    </div>

    <div class="form-group">
      <label>Keterangan</label>
      <input type="text" class="form-control" value="" name="keterangan_add" id="keterangan_add">
    </div>

    </div>
    <div class="modal-footer">
      <button type="button" id="create_data" class="btn btn-success pull-left">Create</button>
    </div>
  </div>
</div>
</div>

@endsection

@push('scripts')

<script type="text/javascript">

var idkategori;
var table;

$(function () {

  table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,
      rowReorder: {
          selector: 'td:nth-child(2)'
      },
      responsive: true,
      ajax: "{{ route('kategori-url') }}",
      columns: [
          {data: 'nama_kategori', name: 'nama_kategori'},
          {data: 'keterangan', name: 'keterangan'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
      ]
  });
});

// Clear Form Data
function clear()
{
  $('#nama_kategori_add').val('');
  $('#keterangan_add').val('');
}

function hapus(idkategori)
{
  swal({
      title: "Menghapus",
      text: 'Apakah anda yakin ingin menghapus ini ?', 
      icon: "warning",
      buttons: true,
      dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      $.ajax({
        type:'POST',
        url: base_url + '/kategori/delete',
        data:{
          idkategori:idkategori, 
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




// -------------- Button ---------------

$( document ).ready(function() {

  $('#hapus_action').click(function() {
    hapus(idkategori);
    $("#detailModal .close").click();
  });

  $('#btnTambah').click(function() {
    $('#createModal').modal('toggle');
  });

  // Do Create
  $('#create_data').click(function() {
    
    var nama_kategori = $('#nama_kategori_add').val();
    var keterangan = $('#keterangan_add').val();

    $.ajax({
    type:'POST',
    url: base_url + '/kategori/store',
    data:{
          "_token": "{{ csrf_token() }}",
          nama_kategori : nama_kategori,
          keterangan : keterangan
    },
    success:function(data) {
      if(data.status != false)
      {
        swal(data.message, { button:false, icon: "success", timer: 1000});
        $("#createModal .close").click();
        clear();
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

  });

})


function btnDel(id)
{
  idkategori = id;
  hapus(idkategori);
}

function btnUbah(id)
{
  idkategori = id;
  $.ajax({
     type:'POST',
     url: base_url + '/kategori/show',
     data:{idkategori:idkategori, "_token": "{{ csrf_token() }}",},
     success:function(data) {
        $('#detailModal').modal('toggle');
        $('#nama_kategori').val(data.data.nama_kategori);
        $('#keterangan').val(data.data.keterangan);
     }
  });

// ----------- Update Data -----------------

$('#update_data').click(function() {

  var nama_kategori = $('#nama_kategori').val();
  var keterangan = $('#keterangan').val();
  
  $.ajax({
    type:'POST',
    url: base_url + '/kategori/update',
    data:{
          idkategori:idkategori, 
          "_token": "{{ csrf_token() }}",
          nama_kategori : nama_kategori,
          keterangan : keterangan
    },
   success:function(data) {
      if(data.status != false)
      {
        swal(data.message, { button:false, icon: "success", timer: 1000});
        $("#detailModal .close").click()
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

})

}

</script>

@endpush