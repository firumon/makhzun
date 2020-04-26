@extends('Makhzun::products.layout')
@php
$item = 'product'; $itemTitle = \Illuminate\Support\Str::of(MRN($item))->title()->__toString(); $itemTitle2 = \Illuminate\Support\Str::plural($itemTitle);
$criteria = ['Name' => 'PRDNAME','Code' => 'PRDCODE','Stock' => 'PRDSTOCK'];
$actions = ['page.product.details' => 'More','javascript:updateProduct("--id--")' => 'Update'];
$modalActions = ['text' => 'Update', 'action' => 'doUpdateProduct()'];
@endphp


@section('modal')
    <x-makhzun-modal :title="'Update '.MRN($item).' Details'" centered :actions="$modalActions">
        <x-makhzun-form code="UPDATEPRODUCT" :card="false" name="update-product-form"></x-makhzun-form>
    </x-makhzun-modal>
@endsection

@section('content-header')
    <h4>{{ $itemTitle }}</h4>
@stop

@section('content')
    <div class="row">
        @unless(request()->filled('search_text'))
            <div class="col-12 col-md-6">
                <x-makhzun-form code="QUICKADDPRODUCT" color="primary"></x-makhzun-form>
            </div>
            <div class="col-6 col-md-3">
                <x-makhzun-box :text="'Total ' . $itemTitle2" number="" id="prdcount"></x-makhzun-box><x-makhzun-api code="PRDCOUNT"></x-makhzun-api>
                <x-makhzun-box text="Total Stock Value" number="" id="prdstockvalue"></x-makhzun-box><x-makhzun-api code="PRDSTOCKVALUE"></x-makhzun-api>
                <x-makhzun-box :text="'Non Stock ' . $itemTitle2" number="" id="prdnonstockcount"></x-makhzun-box><x-makhzun-api code="PRDNONSTOCKCOUNT"></x-makhzun-api>
            </div>
            <div class="col-6 col-md-3"></div>
        @endunless
        <div class="col-12">
            <x-makhzun-card color="primary" :title="$itemTitle2">
                <x-makhzun-table :records="$products" :criteria="$criteria" :actions="$actions" iteration sm></x-makhzun-table>
                <x-slot name="footer"><div class="float-right">{!! $links !!}</div></x-slot>
            </x-makhzun-card>
        </div>
    </div>
@stop

@push('js')
    <script type="text/javascript">

        function updateProduct(id) {
            MODAL.modal('show'); modalOverlay(true);
            fetchModel('Product',id,function(r){
                formValues('update-product-form',r);
                modalOverlay(false);
            })
        }

        function doUpdateProduct() {
            $('[name="update-product-form"]').submit();
        }

    </script>
@endpush
