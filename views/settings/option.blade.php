@extends('Makhzun::settings.layout')

@php
    $tableName = 'option-list-table'; $formName = 'option-manage-form';
    $criteria = ['Name' => 'option', 'Order' => 'order', 'Status' => 'status'];
    $tableActions = ['javascript:showUpdateOptionModal(--id--)' => 'Update'];
    $modalActions = ['text' => 'Submit', 'action' => 'SubmitForm()'];
    $statusOptions = config('makhzun.FORM_STATUS_OPTIONS')
@endphp

@section('content-header')
    <button type="button" class="btn btn-primary float-right" name="main-button" onclick="addNewOption()"><i class="fas fa-fw mr-2 fa-plus"></i>Add Option</button>
    <h4>{{ $option_detail['label'] }} - <small><i>({{ ucfirst($option_detail['table']) }})</i></small></h4>
@stop

@section('modal')
    <x-makhzun-modal title="Option" :close="false" :actions="$modalActions">
        <form method="post" name="{{ $formName }}" action="{{ route('page.settings.options.form') }}">@csrf
            <x-makhzun-input name="option" type="text" label="Name" horizontal></x-makhzun-input>
            <x-makhzun-input name="order" type="number" label="Order" horizontal></x-makhzun-input>
            <x-makhzun-input name="status" type="select" label="Status" :options="$statusOptions" horizontal></x-makhzun-input>

            <x-makhzun-input name="_record_id" type="hidden" value=""></x-makhzun-input>
        </form>
    </x-makhzun-modal>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <x-makhzun-table :records="[]" :criteria="$criteria" :actions="$tableActions" iteration :name="$tableName" sm></x-makhzun-table>
        </div>
    </div>
@stop

@push('js')
    <script type="text/javascript">
        let options = @json($options), critera = @json($criteria);
        $(function(){
            let $table = $('table[name="{{ $tableName }}"] tbody').empty();
            _.forEach(options,function(option,iteration){
                let records = _.concat([iteration+1],_.map(critera,(key) => _.get(option,key,'')));
                let tds = _.map(records,(record,i) => $('<td>',{ 'data-record-sequence':i }).text(record)).concat($('<td>').html(getOptionListBtn(option)));
                $table.append($('<tr>',{ 'data-record-id':option.id }).html(tds))
            })
        });
        function addNewOption(){
            $('[name="_record_id"]').val('');$('[name="option"]').val('');$('[name="order"]').val(options.length+1);$('[name="status"]').val('Active').trigger('change');
            $('.modal-title').text('Add Option'); $('.modal-footer button').text('Submit');
            MODAL.modal('show');
        }
        function getOptionListBtn(option) {
            return $('<button>',{ type:'button',class:'btn btn-xs btn-outline-primary' }).text('Update').bind('click',option,function (event) {
                let { option,order,status,id } = event.data;
                $('[name="_record_id"]').val(id);$('[name="option"]').val(option);$('[name="order"]').val(order);$('[name="status"]').val(status).trigger('change');
                $('.modal-title').text('Update Option'); $('.modal-footer button').text('Update');
                MODAL.modal('show');
            })
        }
        function SubmitForm() {
            $('form[name="{{ $formName }}"]').submit();
        }
    </script>
@endpush
