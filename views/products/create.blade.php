@extends('Makhzun::products.layout')

@section('content')
    @foreach($headers as $header)
        <x-makhzun-input  :name="$header->code" :type="$header->type" :d0="$header->d0" :d1="$header->d1" ></x-makhzun-input>
    @endforeach
@stop
