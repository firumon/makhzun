
<div class="form-group{{ $horizontal ? ' form-horizontal row' : '' }}">
    @php $ID = $name . '-' . intval(microtime(true)*1000000) @endphp
    @if($tag === 'input')
        @if(in_array($type,$inputTypes))
            @if($type === 'file')
                @section('plugins.Bscustomfileinput', true)
                <label for="{{ $ID }}" @if($horizontal) class="col-form-label col-sm-{{ $horizontal }}" @endif>{{ $label }}</label>
                <div class="custom-file{{ $horizontal ? (' col-sm-'.(12-$horizontal)) : '' }}">
                    <input type="file" class="custom-file-input" id="{{ $ID }}" name="{{ $name }}">
                    <label class="custom-file-label" for="{{ $ID }}">Browse</label>
                    @if($value)
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="{{ $ID }}_OLD" name="{{ $name }}_OLD" value="{{ $value }}">
                            <label for="{{ $ID }}_OLD" class="custom-control-label">Check to remove {{ $value }}</label>
                        </div>
                    @endif
                </div>
                @push('js')
                    <script type="text/javascript">
                        $(function(){ bsCustomFileInput.init(); });
                    </script>
                @endpush
            @else
                @if($label) <label for="{{ $ID }}" @if($horizontal) class="col-form-label col-sm-{{ $horizontal }}" @endif>{{ $label }}</label> @endif
                <div class="options{{ $horizontal ? (' mt-2 col-sm-'.(12-$horizontal)) : '' }} {{ $name }}_options" data-options-type="{{ $type }}">
                    @forelse($options as $oValue => $option)
                        <div class="custom-control custom-{{ $type }}">
                            <input class="custom-control-input" type="{{ $type }}" id="{{ $name }}_{{ $oValue }}" name="{{ $name . ($type === 'checkbox' ? '[]' : '') }}" value="{{ $oValue }}" @if($oValue == $value) checked @endif onclick="$(document).trigger('{{ $name }}:change',{ id:'{{ $name }}_{{ $oValue }}',name:'{{ $name }}' })">
                            <label for="{{ $name }}_{{ $oValue }}" class="custom-control-label">{{ $option }}</label>
                        </div>
                    @empty
                        @isset($fetch[0]) <x-makhzun-options :name="$name" :type="$fetch[0]" :d0="$fetch[1]" :d1="$fetch[2]" :value="$value"></x-makhzun-options> @endisset
                    @endforelse
                </div>
            @endif
        @else
            @if($label) <label for="{{ $name }}" @if($horizontal) class="col-form-label col-sm-{{ $horizontal }}" @endif>{{ $label }}</label> @endif
            @if($horizontal) <div class="col-sm-{{ 12 - $horizontal }}"> @endif
                <input type="{{ ($mask || $picker) ? 'text' : $type }}" class="form-control" id="{{ $ID }}" name="{{ $name }}" value="{{ $value }}" onchange="$(document).trigger('{{ $name }}:change',{ id:'{{ $ID }}',name:'{{ $name }}' })">
            @if($horizontal) </div> @endif
            @if($mask)
                @section('plugins.Inputmask', true) @push('js') <script type="text/javascript"> $(function(){ $('input[name="{{ $name }}"]').inputmask(@json($mask)); }) </script> @endpush
            @elseif($picker)
                @section('plugins.Daterangepicker', true) @push('js') <script type="text/javascript"> $(function(){ $('input[name="{{ $name }}"]').daterangepicker(@json($picker)) }){!! ($type === 'time') ? '.on("show.daterangepicker",function(ev, picker){ picker.container.find(".calendar-table").hide() })' : '' !!} </script> @endpush
                @if($type === 'time') @push('js') <script type="text/javascript"> $(function(){ }) </script> @endpush @endif
            @endif
        @endif
    @elseif($tag === 'textarea')
        @if($label) <label for="{{ $name }}" @if($horizontal) class="col-form-label col-sm-{{ $horizontal }}" @endif>{{ $label }}</label> @endif
        @if($horizontal) <div class="col-sm-{{ 12 - $horizontal }}"> @endif
            <textarea class="form-control" rows="3" name="{{ $name }}" id="{{ $ID }}" onchange="$(document).trigger('{{ $name }}:change',{ id:'{{ $ID }}',name:'{{ $name }}' })">{{ $value }}</textarea>
        @if($horizontal) </div> @endif
    @elseif($tag === 'select')
        @if($label) <label for="{{ $name }}" @if($horizontal) class="col-form-label col-sm-{{ $horizontal }}" @endif>{{ $label }}</label> @endif
        @if($horizontal) <div class="col-sm-{{ 12 - $horizontal }}"> @endif
        <select class="form-control select2" name="{{ $name }}" id="{{ $ID }}" style="width: 100%;" {{ $multiple ? 'multiple' : '' }} onchange="$(document).trigger('{{ $name }}:change',{ id:'{{ $ID }}',name:'{{ $name }}' })">
            @forelse($options as $oValue => $option)
                <option value="{{ $oValue }}" @if($oValue == $value) selected @endif>{{ $option }}</option>
            @empty
                @if(in_array($fetch[0],$locationTypes) && $fetch[1])
                    @push('js') <script type="text/javascript">
                        $(function(){
                            $(document).on('{{ $fetch[1] }}:change',function(){
                                fetchOptions('{{ $name }}','{{ $fetch[0] }}',$('[name="{{ $fetch[1] }}"]').val(),'','');
                            })
                        })
                    </script> @endpush
                @else
                    <option value="" selected>-</option>
                    <x-makhzun-options :name="$name" :type="$fetch[0]" :d0="$fetch[1]" :d1="$fetch[2]" :value="$value"></x-makhzun-options>
                @endif
            @endforelse
            @push('js') <script type="text/javascript"> $(function(){ $('select[name="{{ $name }}"]').select2() }) </script> @endpush
        </select>
        @if($horizontal) </div> @endif
        @section('plugins.Select2', true)
    @endif
</div>
