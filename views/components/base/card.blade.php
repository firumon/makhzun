<div {{ $attributes->merge(['class' => 'card ' . $class]) }}>
    @if($title || count($tools))
    <div class="card-header">
        @if($title)<h4 class="card-title">{{ $title }}</h4>@endif
        @if($tools)
        <div class="card-tools">
            @foreach($tools as $tool => $icon)
            <button type="button" class="btn btn-tool" data-card-widget="{{ $tool }}"><i class="fas fa-{{ $icon }}"></i></button>
            @endforeach
        </div>
        @endif
    </div>
    @endif
    <div class="card-body">
        {{ $slot }}
    </div>
    @if($footer)
    <div class="card-footer">{{ $footer }}</div>
    @endif
</div>
