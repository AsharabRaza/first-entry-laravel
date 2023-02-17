<!DOCTYPE html>
<html lang="en">
    <head>
      @include('dashboard.user.layouts.head')
    </head>
<body class="app sidebar-mini ltr dark-mode mode-color2">

<!-- PAGE -->
<div class="page">
    <div class="page-main">
    @if(Auth::check())
        @include('dashboard.user.layouts.header')
        @include('dashboard.user.layouts.sidebar')
    @endif

    @yield('content')

{{--    </div>--}}

{{--</div>--}}

@include('dashboard.user.layouts.footer')

</body>
</html>


