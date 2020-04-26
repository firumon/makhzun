@extends('Makhzun::contacts.layout')

@php
$itemTitle = \Illuminate\Support\Str::of(MRN('contact'))->pluralStudly()->__toString();
$supplierTitle = \Illuminate\Support\Str::of(MRN('supplier'))->pluralStudly()->__toString();
$customerTitle = \Illuminate\Support\Str::of(MRN('customer'))->pluralStudly()->__toString();
$listCriteria = ['Name' => 'CONTNAME','Type' => 'CONTNATURE','Phone' => 'CONTPHONE','Email' => 'CONTEMAIL','City' => 'CONTCITY','Status' => 'CONTSTATUS'];
$listActions = ['javascript:updateContact("--id--")' => 'Update'];
$modalActions = ['text' => 'Update', 'action' => 'doUpdateContact()'];
$formName = 'update-contact-form';
@endphp

@section('content-header')
    <h4>{{ $itemTitle }}</h4>
@stop

@section('modal')
    <x-makhzun-modal :title="'Update ' . MRN('contact')" :actions="$modalActions" :close="false">
        <x-makhzun-form code="ADDNEWCONTACT" :card="false" horizontal :name="$formName"></x-makhzun-form>
    </x-makhzun-modal>
@stop

@section('content')

    <div class="row">
        @unless(request()->filled('search_text'))
        <div class="col-12 col-md-6">
            <x-makhzun-form code="QUICKADDCONTACT" color="primary" horizontal></x-makhzun-form>
        </div>
        <div class="col-6 col-md-3">
            <x-makhzun-box :text="$itemTitle" number="" id="contact_count_box"></x-makhzun-box><x-makhzun-api code="CONTCOUNT"></x-makhzun-api>
            <x-makhzun-box :text="$supplierTitle" number="" id="supplier_count_box"></x-makhzun-box><x-makhzun-api code="CONTSUPPLIERS"></x-makhzun-api>
            <x-makhzun-box :text="$customerTitle" number="" id="customer_count_box"></x-makhzun-box><x-makhzun-api code="CONTCUSTOMERS"></x-makhzun-api>
        </div>
        <div class="col-6 col-md-3">
            <x-makhzun-box :text="'New ' . $itemTitle" number="" id="new_contact_count_box"></x-makhzun-box><x-makhzun-api code="CONTNEWCOUNT"></x-makhzun-api>
            <x-makhzun-box :text="'Recent Active ' . $supplierTitle" number="" id="recent_supplier_count_box"></x-makhzun-box><x-makhzun-api code="CONTRECENTSUPP"></x-makhzun-api>
            <x-makhzun-box :text="'Recent Active ' . $customerTitle" number="" id="recent_customer_count_box"></x-makhzun-box><x-makhzun-api code="CONTRECENTCUST"></x-makhzun-api>
        </div>

        <hr>

        @endunless

        <div class="col-12">
            <x-makhzun-card>
                <x-makhzun-table :records="$contacts" :criteria="$listCriteria" :actions="$listActions"></x-makhzun-table>
                <x-slot name="footer">
                    <div class="row"><div class="offset-4 col-4">{!! $links !!}</div></div>
                </x-slot>
            </x-makhzun-card>
        </div>
    </div>
@stop

@push('js')
    <script type="text/javascript">
        function doUpdateContact(){
            $('form[name="{{ $formName }}"]').submit();
        }
        function updateContact(id){
            fetchModel('Contact',id,(r) => MODAL.modal('show',formValues('{{ $formName }}',r)));
        }
    </script>
@endpush
