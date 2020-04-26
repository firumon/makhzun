<div {{ $attributes->merge(['class' => 'card ' . $class]) }}>
    @if($title || count($tools))
    <div class="card-header">
        @if($title)<h4 class="card-title">@if($collapse) <a data-toggle="collapse" href="#{{ $collapse_href = \Illuminate\Support\Str::random(8) }}">{{ $title }}</a> @else {!! $title !!} @endif</h4>@endif
        @if($tools)
        <div class="card-tools">
            @foreach($tools as $tool => $icon)
            <button type="button" class="btn btn-tool" data-card-widget="{{ $tool }}"><i class="fas fa-{{ $icon }}"></i></button>
            @endforeach
        </div>
        @endif
    </div>
    @endif
    @if($collapse) <div id="{{ $collapse_href }}" class="panel-collapse collapse"> @endif
        <div class="card-body">
            {{ $slot }}
        </div>
    @if($collapse) </div> @endif
    @if($footer)
    <div class="card-footer">{{ $footer }}</div>
    @endif
</div>
