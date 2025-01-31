@props(['track'])
{{------------ Column ------------}}
{{------------ Column ------------}}
<div class="col-lg-4 col-md-6">
    {{------------ Track ------------}}
    <div class="track">
        <i class="fa fa-{{$track->icon}} fa-fw"></i>
        <a href="{{route('tracks.show', $track->id)}}">
            {{$track->name}}
        </a>
    </div> {{-- Track --}}
</div> {{-- Column --}}