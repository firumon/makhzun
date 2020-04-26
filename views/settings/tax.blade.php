@extends('Makhzun::settings.layout')

@php
    $modalActions = ['text' => 'Submit', 'action' => 'SubmitForm()'];
    $formName = 'tax-add-form';
@endphp

@section('content-header')
    <button type="button" class="btn btn-primary btn-sm float-right" onclick="addNewTaxItem()"><i class="fas fa-fw mr-2 fa-plus"></i>Add Tax Item</button>
    <button type="button" class="btn btn-primary btn-sm float-right mr-2" onclick="addNewTax()"><i class="fas fa-fw mr-2 fa-plus"></i>Add Tax Group</button>
    <h4 class="mt-1">Taxes</h4>
@stop

@section('modal')
    <x-makhzun-modal title="Add TAX Group" :close="false" :actions="$modalActions" name="taxModal">
        <form method="post" name="{{ $formName }}">@csrf
            <x-makhzun-input name="group" type="hidden" horizontal="3"></x-makhzun-input>
            <x-makhzun-input name="_record_id" type="hidden" horizontal="3"></x-makhzun-input>
            <p class="text-muted form-text offset-3 mb-0 pl-2">The code should be UPPERCASE, unique and start with TAX, and not more than 12 characters.</p>
            <x-makhzun-input name="code" type="text" label="Code" horizontal="3"></x-makhzun-input>
            <x-makhzun-input name="name" type="text" label="Name" horizontal="3"></x-makhzun-input>
            <x-makhzun-input name="formula" type="textarea" label="Formula" horizontal="3"></x-makhzun-input>
            <x-makhzun-input name="status" type="select" label="Status" :options="mConfig('FORM_STATUS_OPTIONS')" horizontal="3"></x-makhzun-input>
        </form>
    </x-makhzun-modal>
@endsection

@section('content')
    <div class="row">
        <div class="col-9">
            @forelse($taxes as $code => $tax)
                @continue(!$tax->group)
                <form method="post"> @csrf
                    <x-makhzun-card :title="$tax->name" color="primary" outline collapse>
                        <input type="hidden" name="_record_id[]" value="{{ $tax->id }}">
                        <div class="row mb-3">
                            <div class="col-4"><x-makhzun-input type="text" :name="$tax->id . '[name]'" :value="$tax->name" label="Name"></x-makhzun-input></div>
                            <div class="col-4"><x-makhzun-input type="text" :name="$tax->id . '[code]'" :value="$tax->code" label="Code"></x-makhzun-input></div>
                            <div class="col-4"><x-makhzun-input type="select" :name="$tax->id . '[status]'" :value="$tax->status" label="Status" :options="mConfig('FORM_STATUS_OPTIONS')"></x-makhzun-input></div>
                            <div class="col-12"><x-makhzun-input type="textarea" :name="$tax->id . '[formula]'" :value="$tax->formula" label="Formula"></x-makhzun-input></div>
                        </div>

                        @php preg_match_all('/\[([^\]]+)\]/',$tax->formula,$matches); $matches = array_unique($matches[1]) @endphp
                        @if($matches)
                            <div class="row">
                                @foreach($matches as $idx => $match)
                                    @continue(!$taxes->has($match))
                                    <div class="col"><kbd>{{$taxes[$match]->code}}</kbd><br><code>{{ $taxes[$match]->formula }}</code></div>
                                @endforeach
                            </div>
                        @endif
                        <x-slot name="footer">
                            <input type="submit" name="_form_type" value="Update" class="btn btn-primary float-right">
                        </x-slot>
                    </x-makhzun-card>
                </form>
            @empty
                <h5>No taxes defined. Start from adding!</h5>
            @endforelse
        </div>
        <div class="col-3">
            <div class="card card-light">
                <div class="card-header">Available Tax Items</div>
                <ul class="list-group list-group-flush">
                    @forelse($taxes as $code => $tax)
                        @continue($tax->group)
                        <li class="list-group-item"><a style="line-height: 1" class="d-block" href="javascript:updateTaxItem({{ $tax->id }},'{{ $tax->code }}','{{ $tax->name }}','{{ $tax->formula }}','{{ $tax->status }}')"><code @unless($tax->status === 'Active') class="text-muted" @endunless>{{ $code }}</code></a><code class="m-0 p-0">{{ $tax->formula }}</code></li>
                    @empty
                        <li class="list-group-item">No tax items exists.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script type="text/javascript">
        function addNewTax(){ modalTitle('Add TAX Group'); FR(); FV('group',1); show(); }
        function addNewTaxItem(){ modalTitle('Add TAX Item'); FR(); FV('group',0); show(); }
        function SubmitForm() { $('form[name="tax-add-form"]').submit(); }
        function modalTitle(title) { $('.modal-title').text(title); }
        function updateTaxItem(id,code,name,formula,status) { modalTitle('Update TAX Item'); formValues('{{ $formName }}',{ group:0,code,_record_id:id,name,formula,status });/*FV('group',0);FV('_record_id',id);FV('code',code);FV('name',name);FV('formula',formula);FV('status',status);*/ show() }
        function FV(name,val){ $('[name="'+name+'"]').val(val).trigger('change'); }
        // function FR() { FV('group',1);FV('_record_id','');FV('code','');FV('name','');FV('formula','');FV('status','Active'); }
        function FR() { formValues('{{ $formName }}',{ group:1,_record_id:'',code:'',name:'',formula:'',status:'Active' }) }
        function show() { MODAL.modal('show') }
    </script>
@endpush
