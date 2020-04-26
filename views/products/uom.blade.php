@extends('Makhzun::products.layout')

@php
    $tableName = 'uom-list-table';
    $criteria = ['Name' => 'option', 'Order' => 'order', 'Status' => 'status'];
    $tableActions = ['javascript:showUpdateUOMModal(--id--)' => 'Update'];
    $modalActions = ['text' => 'Submit', 'action' => 'SubmitForm()'];
    $statusOptions = config('makhzun.FORM_STATUS_OPTIONS')
@endphp

@section('content-header')
    <button type="button" class="btn btn-primary float-right" name="main-button" onclick="addNewUOM()"><i class="fas fa-fw mr-2 fa-plus"></i>Add new UOM</button>
    <h4>Unit of Measurements</h4>
@stop

@section('modal')
    <x-makhzun-modal title="Add new UOM" :close="false" :actions="$modalActions">
        <form method="post" name="uom-manage-form">@csrf
            <x-makhzun-input name="option" type="text" label="Name" horizontal></x-makhzun-input>
            <x-makhzun-input name="order" type="number" label="Order" horizontal></x-makhzun-input>
            <x-makhzun-input name="status" type="select" label="Status" :options="$statusOptions" horizontal></x-makhzun-input>

            <x-makhzun-input name="_record_id" type="hidden" value=""></x-makhzun-input>
        </form>
    </x-makhzun-modal>
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <x-makhzun-table :records="[]" :criteria="$criteria" :actions="$tableActions" iteration sm :name="$tableName"></x-makhzun-table>
        </div>
    </div>

@stop

@push('js')
    <script type="text/javascript">
        let uoms = @json($records), critera = @json($criteria);
        $(function(){
            let $table = $('table[name="{{ $tableName }}"] tbody').empty();
            _.forEach(uoms,function(uom,iteration){
                let records = _.concat([iteration+1],_.map(critera,(key) => _.get(uom,key,'')));
                let tds = _.map(records,(record,i) => $('<td>',{ 'data-record-sequence':i }).text(record)).concat($('<td>').html(getUOMListBtn(uom)));
                $table.append($('<tr>',{ 'data-record-id':uom.id }).html(tds))
            })
        });
        function addNewUOM(){
            $('[name="_record_id"]').val('');$('[name="option"]').val('');$('[name="order"]').val(uoms.length+1);$('[name="status"]').val('Active').trigger('change');
            $('.modal-title').text('Add new UOM'); $('.modal-footer button').text('Submit');
            MODAL.modal('show');
        }
        function getUOMListBtn(uom) {
            return $('<button>',{ type:'button',class:'btn btn-xs btn-outline-primary' }).text('Update').bind('click',uom,function (event) {
                let { option,order,status,id } = event.data;
                $('[name="_record_id"]').val(id);$('[name="option"]').val(option);$('[name="order"]').val(order);$('[name="status"]').val(status).trigger('change');
                $('.modal-title').text('Update UOM'); $('.modal-footer button').text('Update');
                MODAL.modal('show');
            })
        }
        function SubmitForm() {
            $('form[name="uom-manage-form"]').submit();
        }
    </script>
@endpush
