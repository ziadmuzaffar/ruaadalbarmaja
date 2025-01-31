{{------------ Row ------------}}
<div class="row">
    {{------------ Boards ------------}}
    <div class="col-lg-3 col-md-4 col-sm-6">
        {{------------ Board ------------}}
        <div class="board">
            {{------------ Icon ------------}}
            <i class="fa fa-chart-gantt fa-fw"></i>
            {{------------ Actions ------------}}
            <div>
                <p>اجمالي المسارات</p>
                <span>{{DB::table('tracks')->count()}}</span>
            </div> {{-- Actions --}}
        </div> {{-- Board --}}
    </div> {{-- Boards --}}
    {{------------ Boards ------------}}
    <div class="col-lg-3 col-md-4 col-sm-6">
        {{------------ Board ------------}}
        <div class="board">
            {{------------ Icon ------------}}
            <i class="fa fa-video fa-fw"></i>
            {{------------ Actions ------------}}
            <div>
                <p>اجمالي الكورسات</p>
                <span>{{DB::table('courses')->count()}}</span>
            </div> {{-- Actions --}}
        </div> {{-- Board --}}
    </div> {{-- Boards --}}
    {{------------ Boards ------------}}
    <div class="col-lg-3 col-md-4 col-sm-6">
        {{------------ Board ------------}}
        <div class="board">
            {{------------ Icon ------------}}
            <i class="fa fa-clipboard fa-fw"></i>
            {{------------ Actions ------------}}
            <div>
                <p>اجمالي الدروس</p>
                <span>{{DB::table('lessons')->count()}}</span>
            </div> {{-- Actions --}}
        </div> {{-- Board --}}
    </div> {{-- Boards --}}
    {{------------ Boards ------------}}
    <div class="col-lg-3 col-md-4 col-sm-6">
        {{------------ Board ------------}}
        <div class="board">
            {{------------ Icon ------------}}
            <i class="fa fa-users fa-fw"></i>
            {{------------ Actions ------------}}
            <div>
                <p>اجمالي المستخدمين</p>
                <span>{{DB::table('users')->count()}}</span>
                <span>{{DB::table('users')->count()}}</span>
            </div> {{-- Actions --}}
        </div> {{-- Board --}}
    </div> {{-- Boards --}}
</div> {{-- Row --}}