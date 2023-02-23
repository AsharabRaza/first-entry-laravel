<!DOCTYPE html>
<html lang="en">
    <head>
      @include('dashboard.admin.layouts.head')
    </head>
<body class="app sidebar-mini ltr dark-mode mode-color2">

<!-- PAGE -->
<div class="page">
    <div class="page-main">
    @if(Auth::check())
        @include('dashboard.admin.layouts.header')
        @include('dashboard.admin.layouts.sidebar')
    @endif

    @yield('content')

{{--    </div>--}}

{{--</div>--}}

@include('dashboard.admin.layouts.footer')

</body>
</html>


