@props(['course'])
{{------------ Column ------------}}
<div class="col-lg-4 col-md-6">
    <div class="course">
        <img src="{{asset('public/images/courses/'.$course->image)}}" alt="{{$course->name}}">
        <div>
            <a href="{{route('courses.show', $course->id)}}" class="course-title">
                {{$course->name}}
            </h3>
            <a href="{{route('tracks.show', $course->track_id)}}" class="course-track">
                {{DB::table('tracks')->find($course->track_id)->name}}
            </a>
        </div>
    </div>
</div>