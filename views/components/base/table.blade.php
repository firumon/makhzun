<div class="table-responsive">
    <table {{ $attributes->merge(['class' => 'table ' . $class]) }}>
        <thead><tr>@foreach($headings as $heading) <th>{{ $heading }}</th> @endforeach @if($actions) <th>&nbsp;</th> @endif</tr></thead>
        <tbody>
        @forelse($records as $id => $record)
            <tr data-record-id="{{ $id }}">
            @foreach($record as $seq => $data)
                <td data-record-sequence="{{ $seq }}">{{ is_array($data) ? implode(",",$data) : $data }}</td>
            @endforeach
            @if($actions)
                <td>
                    @foreach($actions as $route_name => $display)
                        <a href="{{ (\Illuminate\Support\Facades\Route::has($route_name)) ? route($route_name,$id) : \Illuminate\Support\Str::of($route_name)->replace('--id--',$id)->__toString() }}" class="btn btn-sm btn-outline-primary">{{ $display }}</a>
                    @endforeach
                </td>
            @endif
            </tr>
        @empty
            <tr>
                <th colspan="{{ count($headings) }}">{{ $empty }}</th>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

