
<header class="bg-light p-3">
        <div class="row">
      
            <div class="d-flex align-items-center">
            <div>EMS</div>
    
            <div class="ms-auto">
            @auth
                <span class="me-2">Welcome, <strong>{{ auth()->user()->name }}</strong></span>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            @endauth
            </div>
            </div>
        </div>
</header>