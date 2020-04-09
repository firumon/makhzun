@extends('Makhzun::products.layout')
@php
$lists = [
    [
        'records' => $products,
        'criteria' => ['Name' => 'PRDNAME','Code' => 'PRDCODE','UOM' => 'PRDUOM'],
        'actions' => ['page.product.details00{ID}' => 'ABC'],
    ],

];

@endphp

@section('content')
    <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
            <x-makhzun-box text="Total Products" number="" id="prdcount"></x-makhzun-box>
            <x-makhzun-api code="PRDCOUNT"></x-makhzun-api>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <x-makhzun-box text="Total Stock Value" number="" id="prdstockvalue"></x-makhzun-box>
            <x-makhzun-api code="PRDSTOCKVALUE"></x-makhzun-api>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
            <x-makhzun-box text="Non Stock Products" number="" id="prdnonstockcount"></x-makhzun-box>
            <x-makhzun-api code="PRDNONSTOCKCOUNT"></x-makhzun-api>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-12 col-md-4 col-xl-3">
            <x-makhzun-form code="QUICKADDPRODUCT" color="primary"></x-makhzun-form>
        </div>
        <div class="col-12 col-md-8 col-xl-9">
            <x-makhzun-card color="primary" title="Available Products">
                <x-makhzun-table :records="$lists[0]['records']" :criteria="$lists[0]['criteria']" :actions="$lists[0]['actions']" iteration sm></x-makhzun-table>
            </x-makhzun-card>
        </div>
    </div>
@stop

@section('right-sidebar')
    <div class="p-3 control-sidebar-content">
        <x-makhzun-input name="PRDPRICE" label="Product Price" type="number" value="234.8929"></x-makhzun-input>
        <x-makhzun-input name="CONTACTMAIL" label="Contact Email" type="email" value="i@fr.in"></x-makhzun-input>
        <x-makhzun-input name="CPODATE" label="Customer PO Date" type="date" :value="date('Y-m-d')"></x-makhzun-input>
        <x-makhzun-input name="SLSDATE" label="Sales Date" type="datetime" :value="date('Y-m-d H:i:s')"></x-makhzun-input>
        <x-makhzun-input name="SLSTIME" label="Sales Time" type="time" :value="date('H:i:s')"></x-makhzun-input>
        <x-makhzun-input name="PRD" label="Select Product" type="select" :options="Firumon\Makhzun\Model\Product::all()"></x-makhzun-input>
    </div>
@stop
