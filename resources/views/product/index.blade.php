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
  <a  href="{{route('create-product')}}" type="button" id="btnTambah" class="btn btn-info"> TAMBAH PRODUK </a>
</div>


@endsection

@section('modal')



@endsection

@push('scripts')

<script type="text/javascript">



</script>

@endpush