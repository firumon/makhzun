<form action="{{ \Illuminate\Support\Facades\Route::has($action) ? route($action) : $action }}" method="{{ $method }}">
    @csrf @if($id) <input type="hidden" name="_record_id" value="{{ $id }}"> @endif
    <x-makhzun-card :title="$title" :color="$color">
        <div class="row">
            @foreach($form_fields as $idx => $fieldName)
                <div class="col-12 col-md-{{ $layout[$idx] }}">
                    @php $field = $fields[$fieldName] @endphp
                    <x-makhzun-input :name="$field->code" :label="$field->label" :type="$field->type" :d0="$field->d0" :d1="$field->d1"></x-makhzun-input>
                </div>
            @endforeach
        </div>
        <x-slot name="footer">
            <input type="submit" name="_record_submit" value="{{ $id ? 'UPDATE' : 'SAVE' }}" class="btn btn-{{ $color }} float-right">
        </x-slot>
    </x-makhzun-card>
</form>
