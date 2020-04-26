@extends('Makhzun::products.layout')

@php
$criteria = ['ID' => 'id', 'Name' => 'option', 'Order' => 'order', 'Status' => 'status'];
$actions = ['javascript:updateCategory("--id--")' => 'Update']
@endphp

@section('content')
    <div class="row">
        <div class="col-12 col-md-4">
            <form method="post">@csrf
                <x-makhzun-card title="Add new category" color="primary">
                    <x-makhzun-input name="code" type="hidden" value="OPTPRDCATGRY"></x-makhzun-input>
                    <x-makhzun-input name="option" label="Name" ></x-makhzun-input>
                    <x-makhzun-input name="order" label="Order" type="number" value="" ></x-makhzun-input>
                    <x-slot name="footer">
                        <input type="submit" name="submit" value="Save" class="btn btn-primary float-right">
                    </x-slot>
                </x-makhzun-card>
            </form>
        </div>
        <div class="col-12 col-md-8">
            <x-makhzun-card title="Product Categories" color="primary">
                <x-makhzun-table :records="$categories" :criteria="$criteria" :actions="$actions" sm></x-makhzun-table>
            </x-makhzun-card>
            <x-makhzun-api code="CATEGORYMANAGE"></x-makhzun-api>
        </div>
    </div>
    <hr>
@stop

@section('content_header')
    <x-makhzun-modal title="Update Category" id="update_option_modal" :actions="['text' => 'Update','action' => 'doUpdateCategory()']" :close="false">
        <form method="post" name="update-category-form">@csrf
            <x-makhzun-input name="_record_id" type="hidden" value=""></x-makhzun-input>
            <x-makhzun-input name="option" label="Name" value="" horizontal></x-makhzun-input>
            <x-makhzun-input name="order" label="Order" type="number" value="" horizontal></x-makhzun-input>
            <x-makhzun-input name="status" label="Status" type="option" :options="config('makhzun.FORM_STATUS_OPTIONS')" value="" horizontal></x-makhzun-input>
        </form>
    </x-makhzun-modal>
@stop

