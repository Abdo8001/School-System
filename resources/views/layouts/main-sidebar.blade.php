<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            @if (auth('web')->check())
                @include('layouts.sidebar-all.admin-sidebar')
            @endif
                @if (auth('student')->check())
                    @include('layouts.sidebar-all.student-sidebar')
                @endif

                @if (auth('teacher')->check())
                    @include('layouts.sidebar-all.teacher-sidebar')
                @endif

                @if (auth('parent')->check())
                    @include('layouts.sidebar-all.parents-sidebar')
                @endif

        </div>

        <!-- Left Sidebar End-->

        <!--=================================
