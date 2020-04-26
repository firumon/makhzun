@extends('Makhzun::products.layout')

@php
    $tableName = 'group-tax-list-table';
    $criteria = ['Name' => 'name', 'Tax - Sales' => 'tax_sales', 'Tax - Purchase' => 'tax_purchase'];
@endphp

@section('content')

    <form method="post">@csrf
        <x-makhzun-card :title="'Tax on ' . Str::plural($on)">
            <x-makhzun-table :records="[]" :criteria="$criteria" iteration sm :name="$tableName"></x-makhzun-table>
            <x-slot name="footer">
                <input type="submit" name="action" value="Update" class="btn btn-warning float-right">
            </x-slot>
        </x-makhzun-card>
    </form>
@stop

@push('js')
    <script type="text/javascript">
        let taxes = @json($taxes), groups = @json($groups), tbody = $('tbody','table[name="{{ $tableName }}"]');
        let options = [];
        $(function(){
            tbody.empty(); _.forEach(groups,addRow)
        })
        function addRow({ id,name,tax_sales,tax_purchase },idx) {
            tbody.append(tblRow([
                tblCol(idx+1),
                tblCol(name),
                tblCol(txSel(id,'tax_sales',tax_sales)),
                tblCol(txSel(id,'tax_purchase',tax_purchase)),
            ]))
        }
        function tblRow(html){ return $('<tr>').html(html); }
        function tblCol(html){ return $('<td>').html(html); }
        function txSel(id,part,selected){
            let name = `tax[${id}][${part}]`, classes = 'form-control-sm form-control';
            return $('<select>').attr({ name,class:classes }).html(getOptions(selected));
        }
        function getOptions(selected){ return _([{ id:null,name:null }]).concat(taxes).map(({ id,name }) => $('<option>').attr({ value:id,selected:(id == selected) }).text(name)).value(); }
    </script>
@endpush
