@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">Products</div>
            <div class="card-tools">
                <!-- This will cause the card to maximize when clicked -->
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                <!-- This will cause the card to collapse when clicked -->
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <!-- This will cause the card to be removed when clicked -->
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead><tr>
                        <th>No</th><th>Name</th><th>Base</th><th>UUID</th><th>IP V6</th>
                    </tr></thead>
                    <tbody>
                    @forelse(Firumon\Makhzun\Model\Product::paginate(51) as $product)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->index0 }}</td>
                            <td>{{ $product->index1 }}</td>
                            <td>{{ $product->string0 }}</td>
                        </tr>
                    @empty
                        <tr>
                            <th colspan="5">NOT DATA</th>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">{!! Firumon\Makhzun\Model\Product::paginate(2)->links() !!}</div>
    </div>
@stop
