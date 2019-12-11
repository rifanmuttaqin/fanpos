@extends('master')
 
@section('title', 'Pegawai')

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
  <a  href="{{route('create-employee')}}" type="button" id="btnTambah" class="btn btn-info"> TAMBAH </a>
</div>

<div class="table-responsive">
<table class="table table-bordered data-table display nowrap" style="width:100%">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Alamat</th>
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

<div class="modal fade" id="passwordModal" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <p class="modal-title"></p>
      </div>
      <div class="modal-body">
        
        <div class="form-group col-md-12">
          <label>Password</label>
          <input type="password" class="form-control" value="" id="password" name="password">
        </div>

        <div class="form-group col-md-12">
          <label>Re Password</label>
          <input type="password" class="form-control" value="" id="password_confirmation" name="password_confirmation">
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="modal-footer">
        <button type="button" id="update_password" class="btn btn-info pull-left">Update</button>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')

<script type="text/javascript">

var idemployee;
var table;

$( document ).ready(function() {

  clearForm();

  $('#update_password').click(function() { 

    var password = $('#password').val();
    var password_confirmation = $('#password_confirmation').val();
    
    if(password != null && password_confirmation != null)
    {
      $.ajax({
        type:'POST',
        url: base_url + '/employee/update-password',
        data:{
              idemployee:idemployee, 
              "_token": "{{ csrf_token() }}",
              password : password,
              password_confirmation : password_confirmation
        },
        success:function(data) {
          if(data.status != false)
          {
            swal(data.message, { button:false, icon: "success", timer: 1000});
            $("#passwordModal .close").click();
            clearForm();
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
  })

});

function clearForm()
{
  $('#password').val('');
  $('#password_confirmation').val('');
}

function btnDel(id)
{
  idemployee = id;
  hapus(idemployee);
}

function btnPass(id)
{
  idemployee = id;
  $('#passwordModal').modal('toggle');
}

function btnUbah(id)
{
  idemployee = id;
  var url = '{{ route("update-employee", ":idemployee") }}';
  url     = url.replace(':idemployee', idemployee);
  window.location.href = url;
}

$(function () {

  table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,
      rowReorder: {
          selector: 'td:nth-child(2)'
      },
      responsive: true,
      ajax: "{{ route('employee') }}",
      columns: [
          {data: 'full_name', name: 'full_name'},
          {data: 'address', name: 'address'},
          {data: 'email', name: 'email'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
      ]
  });
});

function hapus()
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
        url: base_url + '/employee/delete',
        data:{
          idemployee:idemployee, 
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

</script>

@endpush