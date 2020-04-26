@extends('adminlte::page')

@section('content_header')
    @yield('modal')
    @yield('content-header')
@stop

@if(session('toastr'))
    @section('plugins.Toastr', true)
    @push('js') <script type="text/javascript"> $(function(){ @foreach(session('toastr') as $type => $message) toastr.{{ $type }}('{{ $message }}'); @endforeach })</script> @endpush
    @php session()->forget('toastr'); @endphp
@endif

@section('css')
    <link rel="stylesheet" href="{{ asset('css/makhzun.css') }}">
@stop

@section('footer')
    <div class="float-right d-none d-sm-block">
        <b>MAKHZUN</b> 1.0
    </div>
    <strong>Copyright &copy; 2020 - {{ date('Y') }} <a href="http://firumon.com">firumon.com</a>.</strong> All rights reserved.
@stop

@section('js')
    <script type="text/javascript">
        const ASSET_PATH = '{!! asset('/') !!}', ASSET_PATH_JS = '{!! asset('js') !!}', API_ROOT = '{!! route('api_path') !!}/', API_OPTIONS_FETCH = '{!! route('api_options_fetch',['--type--','--d0--','--d1--']) !!}';
        function loadApiFile($code,$file){ return setTimeout(loadApiFile,500,$code,$file); }
        @if(request('search_text')) $(function(){ $('[name="search_text"]').val('{{ request('search_text') }}').focus(); }); @endif
    </script>
    <script type="text/javascript" src="{{ asset('js/makhzun.js') }}"></script>

@stop
