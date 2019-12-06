<!-- Tambah dirubah dari submit ke AJAX -->

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

@push('scripts')

<script type="text/javascript">

var iduser;
var table;

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

</script>

@endpush