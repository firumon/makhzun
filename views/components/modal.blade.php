
@php
    $bg = '';
    if(!\Illuminate\Support\Arr::hasAny($attributes,$bgs)) $bg = 'primary';
    if(!$bg) foreach ($bgs as $bg1) if(!$bg && $attributes[$bg1]) $bg = $bg1;
    $bg = 'bg-' . $bg;

    $size = '';
    if(\Illuminate\Support\Arr::hasAny($attributes,['xl','lg','sm'])) $size = 'modal-';
    if($size) foreach (['xl','lg','sm'] as $sz) if($attributes[$sz]) $size .= $sz;
@endphp
<div {{ $attributes->merge(["class" => "modal fade", "tabindex" => "-1", "role" => "dialog", "id" => $id, "data-backdrop" => "static"]) }}>
    <div class="modal-dialog {{ $size }} @if($scrollable) modal-dialog-scrollable @endif @if($centered) modal-dialog-centered @endif" role="document">
        <div class="modal-content">
            <div class="modal-header {{ $bg }}">
                <h5 class="modal-title">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer">
                @if($close) <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> @endif
                @forelse($actions as $action)
                    <button type="button" class="btn btn-{{ $action['color'] ?? 'primary' }}" onclick="{{ $action['action'] }}">{{ $action['text'] }}</button>
                @empty
                    &nbsp;
                @endforelse
            </div>
        </div>
    </div>
</div>
@push('js')
    <script type="text/javascript">const MODAL = $('#{{ $id }}')</script>
@endpush
