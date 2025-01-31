{{------------ Row ------------}}
<div class="row">
    {{------------ Tracks ------------}}
    <div class="col-lg-6">
        {{------------ Panel ------------}}
        <div class="panel">
            {{------------ Head ------------}}
            <div class="panel-head">
                <span>اخر 5 مسارات</span>
                <i class="fa fa-plus fa-fw"></i>
            </div> {{-- Head --}}
            {{------------ Body ------------}}
            <ul class="panel-body">
                @foreach (DB::table('tracks')->take(5)->get() as $track)
                    <li>
                        <span>{{$track->name}}</span>
                        <a href="{{route('admins.tracks.edit', $track->id)}}">
                            <i class="fa fa-edit fa-fw"></i>
                        </a>
                    </li>
                @endforeach
            </ul> {{-- Body --}}
        </div> {{-- Panel --}}
    </div> {{-- Tracks --}}
    {{------------ Courses ------------}}
    <div class="col-lg-6">
        {{------------ Panel ------------}}
        <div class="panel">
            {{------------ Head ------------}}
            <div class="panel-head">
                <span>اخر 5 الكورسات</span>
                <i class="fa fa-plus fa-fw"></i>
            </div> {{-- Head --}}
            {{------------ Body ------------}}
            <ul class="panel-body">
                @foreach (DB::table('courses')->take(5)->get() as $course)
                    <li>
                        <span>{{$course->name}}</span>
                        <a href="{{route('admins.courses.edit', $course->id)}}">
                            <i class="fa fa-edit fa-fw"></i>
                        </a>
                    </li>
                @endforeach
            </ul> {{-- Body --}}
        </div> {{-- Panel --}}
    </div> {{-- Courses --}}
    {{------------ Lessons ------------}}
    <div class="col-lg-6">
        {{------------ Panel ------------}}
        <div class="panel">
            {{------------ Head ------------}}
            <div class="panel-head">
                <span>اخر 5 الدروس</span>
                <i class="fa fa-plus fa-fw"></i>
            </div> {{-- Head --}}
            {{------------ Body ------------}}
            <ul class="panel-body">
                @foreach (DB::table('lessons')->take(5)->get() as $lesson)
                    <li>
                        <span>{{$lesson->name}}</span>
                        <a href="{{route('admins.lessons.edit', $lesson->id)}}">
                            <i class="fa fa-edit fa-fw"></i>
                        </a>
                    </li>
                @endforeach
            </ul> {{-- Body --}}
        </div> {{-- Panel --}}
    </div> {{-- Lessons --}}
    {{------------ Users ------------}}
    <div class="col-lg-6">
        {{------------ Panel ------------}}
        <div class="panel">
            {{------------ Head ------------}}
            <div class="panel-head">
                <span>اخر 5 مستخدمين</span>
                <i class="fa fa-plus fa-fw"></i>
            </div> {{-- Head --}}
            {{------------ Body ------------}}
            <ul class="panel-body">
                @foreach (DB::table('users')->take(5)->get() as $user)
                    <li>
                        <span>{{$user->full_name}}</span>
                        <a href="{{route('admins.users.edit', $user->id)}}">
                            <i class="fa fa-edit fa-fw"></i>
                        </a>
                    </li>
                @endforeach
            </ul> {{-- Body --}}
        </div> {{-- Panel --}}
    </div> {{-- Users --}}
</div> {{-- Row --}}