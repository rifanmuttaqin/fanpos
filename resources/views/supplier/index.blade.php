<!-- MENAMBAHKAN PROFILE PICTURE DARI CUSTOMER -->

@extends('master')
 
@section('title', 'Supplier')

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
  <a  href="{{route('create-supplier')}}" type="button" class="btn btn-info"> TAMBAH </a>
</div>

<div class="table-responsive">
<table class="table table-bordered data-table display nowrap" style="width:100%">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Nomor Telfon</th>
            <th>Email</th>
            <th width="100px">Action</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
</div>

@endsection

@section('modal')

<div class="modal fade" id="detailModal" role="dialog" >
<div class="modal-dialog modal-md">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">

    <div class="form-group">
      <label>Nama</label>
      <input type="text" class="form-control" value="" name="nama" id="nama">
    </div>

    <div class="form-group">
      <label>Alamat</label>
      <input type="text" class="form-control" value="" name="alamat" id="alamat">
    </div>

    <div class="form-group">
      <label>Nomor Telfon</label>
      <input type="text" class="form-control" value="" name="nomor_telfon" id="nomor_telfon">
    </div>

    <div class="form-group">
      <label>Email</label>
      <input type="email" class="form-control" value="" name="email" id="email">
    </div>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-danger pull-right" id="hapus_action">Hapus</button>
      <button type="button" id="update_data" class="btn btn-success pull-left">Update</button>
    </div>
  </div>
</div>
</div>

@endsection

@push('scripts')

<script type="text/javascript">

var idsupplier;
var table;

$(function () {

  table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,
      rowReorder: {
          selector: 'td:nth-child(2)'
      },
      responsive: true,
      ajax: "{{ route('supplier-url') }}",
      columns: [
          {data: 'nama', name: 'nama'},
          {data: 'alamat', name: 'alamat'},
          {data: 'nomor_telfon', name: 'nomor_telfon'},
          {data: 'email', name: 'email'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
      ]
  });
});

function hapus(idsupplier)
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
        url: base_url + '/supplier/delete',
        data:{
          idsupplier:idsupplier, 
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

function btnDel(id)
{
  idsupplier = id;
  hapus(idsupplier);
}

function btnUbah(id)
{
  window.location.href = base_url + '/supplier/update/' + id;
}

</script>

@endpush