<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Employee Management')</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <script src="/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    
    @include('layouts.header')

    <div class="container-fluid">
        <div class="row">
            <!-- Left Menu -->  
    
            <aside class="col-md-3">
                @include('layouts.leftmenu')
            </aside>

            <!-- Main Content -->
            <main class="col-md-9">
                @yield('content')

            </main>



        </div>
    </div>


    @include('layouts.footer')

</body>
</html>
