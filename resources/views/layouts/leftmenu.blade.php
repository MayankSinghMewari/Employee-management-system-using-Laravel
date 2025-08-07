<div class="card">
    <div class="card-header"><menu>Content</menu></div>
    <ul class="d-flex flex-column flex-shrink-0 p-3 bg-light">

        @if(auth()->check() && auth()->user()->is_superuser)
         <!-- <li class="list-group-item"><a href="{{ route('index') }}">employees</a></li> -->

        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a class="nav-link custom-hover {{ request()->routeIs('index') ? 'active' : '' }}" href="{{ route('index') }}" >
                    <i class="bi bi-people-fill me-2"></i> Employees
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link custom-hover {{ request()->routeIs('departments.index') ? 'active' : '' }}" href="{{ route('departments.index') }}">
                    <i class="bi bi-diagram-3-fill me-2"></i> Department
                </a>
            </li>
        </ul>

        @endif
        @if(auth()->check() && !auth()->user()->is_superuser)
            <li class="list-group-item"><a href="{{ route('profile') }}">profile</a></li>
        @endif
    </ul>
</div>
