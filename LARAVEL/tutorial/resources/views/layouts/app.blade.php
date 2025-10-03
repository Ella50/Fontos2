@include('includes.head')
@include('includes.nav')
    <main role="main" class="container"> <!--ez változik a sablonban-->
        @yield('content')
    </main>
@include('includes.foot')