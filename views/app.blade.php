@php
if(request('submit')){
$CodeInsert = [];
$HeaderInsert = [];
foreach (request('fields') as $field){
 $insert = ['table' => request('table'),'field' => $field,'created_at' => now()->toDateTimeString(),'updated_at' => now()->toDateTimeString()];
 foreach (request($field) as $key => $value){
  $insert[$key] = $value;
  if($key === 'code') $CodeInsert[] = ['code' => $value,'item' => request('table'),'created_at' => now()->toDateTimeString(),'updated_at' => now()->toDateTimeString()];
 }
 $HeaderInsert[] = $insert;
 }
 dd($CodeInsert,$HeaderInsert);
}
@endphp<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>MAKHZUN :: Developer</title>
    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
{{--    <link href="https://getbootstrap.com/docs/4.0/examples/checkout/form-validation.css" rel="stylesheet">--}}
</head>

<body class="bg-light">

<div class="container">
    <div class="py-5">
        <img class="d-block float-left" src="images/makhzun-logo.png" alt="" width="72" height="72">
        <h2 class="clearfix mt-2">HEADER DATA</h2>
        <p class="lead">Every fields in database tables are identified with a code. The data retrieved from database are stored into corresponding code name. Also when submitting data through form, database fields are mapped from this table. While creating through form every data should submit having field name this code</p>
    </div>

    <div class="row">
        <div class="col-md-2 order-md-1 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Tables</span>
            </h4>
            <ul class="list-group mb-3" style="overflow: hidden">
                @foreach(\Firumon\Makhzun\Table::tables() as $table)
                <li class="list-group-item d-flex justify-content-between lh-condensed"><a href="?table={{ $table }}" class="btn btn-sm @if($table === request('table','products')) btn-success disabled @else btn-info @endif">{{ $table }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-10 order-md-2">
            <h4 class="mb-3">Data</h4>
            <form method="post">
                @csrf <input type="hidden" name="table" value="{{ request('table','products') }}">
                @php
                $data = \Firumon\Makhzun\Model\Header::where('table',request('table','products'))->get()->keyBy->field;
                $fields = ['code','label','type','d0','d1','d2','d3','d4'];
                $tDets = \Firumon\Makhzun\Table::$tables[request('table','products')];
                @endphp
                @if($tDets[0] === 'master' || (isset($tDets[3]) && $tDets[3] === true))
                @php $field = 'name'; @endphp
                <div class="form-row">
                    <div class="col my-2">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="fields[]" value="{{ $field }}" @if(\Illuminate\Support\Arr::has($data,$field)) checked @endif>
                            <label class="custom-control-label">{{ $field }}</label>
                        </div>
                    </div>
                    @foreach($fields as $dField)
                        <div class="col mb-3"><input type="text" class="form-control form-control-sm" id="{{ $dField . '_' . $dField }}" placeholder="{{ $dField }}" name="{{ $field }}[{{ $dField }}]" value="{{ \Illuminate\Support\Arr::get($data,join('.',[$field,$dField])) }}"></div>
                    @endforeach
                </div>
                @endif
                @foreach(\Firumon\Makhzun\Table::details_fields(\Firumon\Makhzun\Table::$tables[request('table','products')][1]) as $field)
                <div class="form-row">
                    <div class="col my-2">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="{{ $field }}" name="fields[]" value="{{ $field }}" @if(\Illuminate\Support\Arr::has($data,$field)) checked @endif>
                            <label class="custom-control-label" for="{{ $field }}">{{ $field }}</label>
                        </div>
                    </div>
                    @foreach($fields as $dField)
                    <div class="col mb-3"><input type="text" class="form-control form-control-sm" id="{{ $dField . '_' . $dField }}" placeholder="{{ $dField }}" name="{{ $field }}[{{ $dField }}]" value="{{ \Illuminate\Support\Arr::get($data,join('.',[$field,$dField])) }}"></div>
                    @endforeach
                </div>
                @endforeach
                <input type="submit" class="btn btn-info" name="submit" value="submit">
            </form>
        </div>
    </div>

</div>
<footer class="mt-5 pt-5 text-muted text-center text-small">
    <p class=" text-muted">Firose Hussain</p>
</footer>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js"></script>
<script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>
<script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/holder.min.js"></script>
</body>
</html>
