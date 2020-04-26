@extends('Makhzun::products.layout')

@php
$items = [];
$records = \Firumon\Makhzun\Model\Group::where('master',$master)->get()
->each(function($item)use(&$items){
    $parent = $item->parent ?? null; $level = $parent ? $items[$parent]['level']+1 : 0;
    $name = $item->name; $order = $item->order; $id = $item->id; $status = $item->status;
    $items[$id] = compact('name','parent','level','order','status');
});
$modalActions = [['text' => 'Add', 'action' => 'SubmitForm()', 'color' => 'info']];
$statusOptions = mConfig('FORM_STATUS_OPTIONS');
//dd($items,$records);
$level_class = ['indigo','maroon','lime','orange','pink','navy']
@endphp

@section('content-header')
    <button type="button" class="btn btn-primary btn-xs px-2 float-right" name="main-button" onclick=""><i class="fas fa-fw mr-2 fa-plus"></i>Add new {{ $item }}</button>
    <h1>{{ $item }}</h1>
@stop

@section('modal')
    <x-makhzun-modal :title="'Add Sub ' . $item" :close="false" :actions="$modalActions">
        <form method="post" name="group-manage-form" action="{{ route('page.product.group.form') }}">@csrf
            <x-makhzun-input name="name" type="text" label="Name" horizontal></x-makhzun-input>
            <x-makhzun-input name="order" type="number" label="Order" horizontal></x-makhzun-input>
            <x-makhzun-input name="status" type="select" label="Status" :options="$statusOptions" horizontal></x-makhzun-input>

            <x-makhzun-input name="master" type="hidden" :value="$master"></x-makhzun-input>
            <x-makhzun-input name="parent" type="hidden" ></x-makhzun-input>
            <x-makhzun-input name="_record_id" type="hidden" value=""></x-makhzun-input>
        </form>
    </x-makhzun-modal>
@stop

@section('content')
    <div class="row">
        <div class="col-12 groups"></div>
    </div>
@stop

@section('plugins.BSCard',true)

@push('js')
    <script type="text/javascript">
        let level_class = @json($level_class); items = @json($items);
        $(function(){
            let cCount = childCount();
            $('[name="main-button"]').on('click',function(){ showAddSubGroupModal(null,cCount[0]+1); });
            _.forEach(items,function({ name,parent,level,order,status },id){
                let card = getCreateBSCard({ title:order + '. ' + name,attrs:{ id:'GRP'+id },color:level_class[level],collapse:true,outline:true });
                let location = (parent) ? $('#GRP' + parent + ' .card-body:first') : $('.groups');
                $('.card-header',card).append(subGroupBtn(id,_.toSafeInteger(cCount[id])+1,status,name,parent,order));
                location.append(card);
            });
        });
        function subGroupBtn(id,next,status,name,parent,order){
            return [
                $('<a>',{ href:'javascript:showAddSubGroupModal("'+id+'","'+next+'")',class:'float-right btn btn-xs btn-light mx-2 px-2' }).html(
                    [$('<i>',{ class:'fas fa-fw fa-plus mr-1' }), 'Add Sub {{ $item }}']
                ),
                $('<a>',{ href:'javascript:showEditDetailModal("'+id+'","'+order+'","'+status+'","'+name+'",'+parent+')',class:'float-right btn btn-xs btn-light mx-2 px-2' }).html(
                    [$('<i>',{ class:'fas fa-fw fa-edit mr-1' }), 'Edit {{ $item }}']
                )
            ]
        }
        function showAddSubGroupModal(parent,order){
            $('[name="_record_id"]').val('');
            $('[name="name"]').val('');
            $('[name="order"]').val(order || 1);
            $('[name="parent"]').val(parent || null);
            $('[name="status"]').val('Active').trigger('change');
            $('.modal-footer button').text('Add');
            $('.modal-title').text('Add {{ $item }}');
            MODAL.modal('show');
        }
        function showEditDetailModal(id,order,status,name,parent){
            $('[name="_record_id"]').val(id);
            $('[name="name"]').val(name);
            $('[name="order"]').val(order || 1);
            $('[name="status"]').val(status).trigger('change');
            $('[name="parent"]').val(parent || null);
            $('.modal-footer button').text('Update');
            $('.modal-title').text('Update {{ $item }}');
            MODAL.modal('show');
        }
        function childCount(){ return _.countBy(items,({parent}) => _.toSafeInteger(parent)); }
        function SubmitForm(){
            $('form[name="group-manage-form"]').submit()
        }
    </script>
@endpush
