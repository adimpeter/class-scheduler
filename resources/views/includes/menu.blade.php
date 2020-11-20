<div id="menu">
    <div class="menu-item">
        <a href="{{ route('schedule.dashboard') }}">Dashboard</a>
    </div>
    <div class="menu-item">
        <a href="#">Schedules</a>
        <div class="dropdown">
            <a href="{{ route('schedule.create') }}">Create</a>
            <a href="{{ route('schedule.showlist') }}">Show</a>
        </div>
    </div>

    <div class="menu-item">
        <a href="#">Hall</a>
        <div class="dropdown">
            <a href="{{ route('hall.create') }}">Create</a>
            <a href="{{ route('hall.showlist') }}">Show</a>
        </div>
    </div>

    <div class="menu-item">
        <a href="#">Course</a>
        <div class="dropdown">
            <a href="{{ route('course.create') }}">Create</a>
            <a href="{{ route('course.showlist') }}">Show</a>
        </div>
    </div>

    <div class="menu-item">
        <a href="#">Lecturer</a>
        <div class="dropdown">
            <a href="{{ route('lecturer.create') }}">Create</a>
            <a href="{{ route('lecturer.showlist') }}">Show</a>
        </div>
    </div>
</div>