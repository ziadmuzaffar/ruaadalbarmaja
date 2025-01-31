<div class="alerts">
    @if (session('success'))
        <div class="alert alert-success d-flex justify-content-between align-items-center">
            <span>{{session('success')}}</span>
            <i class="fa fa-xmark fa-fw" style="cursor: pointer;"></i>
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger d-flex justify-content-between align-items-center">
            <span>{{session('error')}}</span>
            <i class="fa fa-xmark fa-fw" style="cursor: pointer;"></i>
        </div>
    @elseif (session('warning'))
        <div class="alert alert-warning d-flex justify-content-between align-items-center">
            <span>{{session('warning')}}</span>
            <i class="fa fa-xmark fa-fw" style="cursor: pointer;"></i>
        </div>
    @endif
</div>