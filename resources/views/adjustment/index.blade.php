@extends('master')

@section('title', 'Penyesuaian')

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
<form>

<div class="form-group">
    <label>Produk</label>
    <select style="width: 100%" class="form-control form-control-user select2-class" name="product_id" id="product_id">
    <option value="AL"> </option>
    <option value="WY"> </option>
    </select>
</div>

<div id="content_stock">

<hr>

<div id="result"> </div>

</div>


</form>
</div>
</div>

@endsection

@push('scripts')

<script type="text/javascript">

function btnProsess() {

    var stock = $('.stock').map(function(){
        return $(this).val()
    }).get();

    console.log(stock);

    return false;

    $.ajax({
        url: "{{route("update-stock")}}",
        type: "POST",
        data:
            {
                "_token": "{{ csrf_token() }}",
                stock: stock
            },
        success: function (data) {

        },
    })

}

$( document ).ready(function() {

    $('.select2-class').select2();

    $('#content_stock').hide();

    $('#product_id').select2({
        allowClear: true,
        ajax: {
        url: '{{route("list-product")}}',
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

    $('#product_id').on('select2:select', function (e) {

        var data = e.params.data;

        $.ajax({
            url: "{{route('adjustment')}}",
            type: "GET",
            data:
                {
                    "_token": "{{ csrf_token() }}",
                    product_id: data.id
                },
            success: function (data) {

                // Do something
                $('#content_stock').show();
                document.getElementById("result").innerHTML = data;

            },
        })
    });

});


</script>

@endpush
