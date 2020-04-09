
@php
$bg = '';
if(!\Illuminate\Support\Arr::hasAny($attributes,$bgs)) $bg = 'primary';
if(!$bg) foreach ($bgs as $bg1) if(!$bg && $attributes[$bg1]) $bg = $bg1;
$bg = 'bg-' . $bg;
@endphp
@if($link)
    <div {{ $attributes->merge(['class' => 'small-box ' . $bg]) }}>
        <div class="inner">
            <h3 class="number">{{ $number }}</h3>
            <p class="text">{{ $text }}</p>
        </div>
        <div class="icon"><i class="fas fa-{{ $icon }}"></i></div>
        <a href="{{ $link }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
@else
    <div {{ $attributes->merge(['class' => "info-box " . ($progress ? $bg : '')]) }}>
        <span class="info-box-icon {{ $progress ? '' : $bg }}"><i class="fas fa-{{ $icon }}"></i></span>
        <div class="info-box-content">
            <span class="info-box-text text">{{ $text }}</span>
            <span class="info-box-number number">{{ $number }}</span>
        @if($progress)
            <div class="progress"><div class="progress-bar" style="width: {{ intval($progress) }}%"></div></div>
            <span class="progress-description">{{ $detail }}</span>
        @endif
        </div>
    </div>
@endif


