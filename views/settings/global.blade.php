@extends('Makhzun::settings.layout')

@section('content')
    <form method="post"> @csrf
        <x-makhzun-card title="Global App Settings" color="light">
            @foreach($settings as $setting)
                <div class="mb-4">
                    <div class="form-text text-muted offset-3 pl-2">{{ $setting->description }}</div>
                    @if($setting->type === 'yes/no')
                        <x-makhzun-input :name="$setting->id" :value="$setting->value" :label="$setting->label" type="select" :options="config('makhzun.FORM_YESNO_OPTIONS')" horizontal="3"></x-makhzun-input>
                    @else
                        <x-makhzun-input :name="$setting->id" :value="$setting->value" :label="$setting->label" :type="$setting->type" horizontal="3"></x-makhzun-input>
                    @endif
                </div>
            @endforeach
            <x-slot name="footer">
                <input type="submit" value="Update" name="_form_type" class="btn btn-success float-right">
            </x-slot>
        </x-makhzun-card>
    </form>
@stop
