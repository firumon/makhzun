    @if($form)
        <form {{ $attributes->merge(['action' => \Illuminate\Support\Facades\Route::has($action) ? route($action) : $action,'method' => $method,'data-code' => $code,'name' => $name ?? $code, 'enctype' => 'multipart/form-data']) }}>
            @csrf <input type="hidden" name="_record_id" value="">
            @if($code) <input type="hidden" name="_form_code" value="{{ $code }}"> @endif
    @endif
    @if($card)
        <x-makhzun-card :title="$title" :color="$color">
            <div class="row">
                @foreach($form_fields as $idx => $fieldName)
                    <div class="col-12 col-md-{{ $layout[$idx] }}">
                        @php $field = $fields[$fieldName] @endphp
                        <x-makhzun-input :name="$field->code" :label="$field->label" :type="$field->type" :d0="$field->d0" :d1="$field->d1" :horizontal="$horizontal ?? false"></x-makhzun-input>
                    </div>
                @endforeach
            </div>
            <x-slot name="footer">
                <input type="submit" name="_record_submit" value="SUBMIT" class="btn btn-{{ $color }} float-right">
            </x-slot>
        </x-makhzun-card>
    @else
        @foreach($form_fields as $idx => $fieldName)
            @php $field = $fields[$fieldName] @endphp
            <x-makhzun-input :name="$field->code" :label="$field->label" :type="$field->type" :d0="$field->d0" :d1="$field->d1" :horizontal="$horizontal ?? false"></x-makhzun-input>
        @endforeach
    @endif
@if($form) </form> @endif
