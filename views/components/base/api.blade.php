@push('js')
    <script type="text/javascript" src="{{ asset('js/API/' . $file) }}"></script>
    @if($fetch) <script type="text/javascript"> $(function(){ fetchApi('{{ $code }}'); }); </script> @endif
@endpush
