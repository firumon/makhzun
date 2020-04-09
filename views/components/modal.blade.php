
@php
    $bg = '';
    if(!\Illuminate\Support\Arr::hasAny($attributes,$bgs)) $bg = 'default';
    if(!$bg) foreach ($bgs as $bg1) if(!$bg && $attributes[$bg1]) $bg = $bg1;
    $bg = 'bg-' . $bg;
@endphp
<div {{ $attributes->merge(["class" => "modal fade", "tabindex" => "-1", "role" => "dialog", "id" => $id]) }}>
    <div class="modal-dialog modal-dialog-scrollable @if($centered) modal-dialog-centered @endif" role="document">
        <div class="modal-content {{ $bg }}">
            <div class="modal-header">
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
