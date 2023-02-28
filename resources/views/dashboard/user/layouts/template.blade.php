<!DOCTYPE html>
<html lang="en">
    <head>
      @include('dashboard.user.layouts.head')
    </head>
<body class="app sidebar-mini ltr dark-mode">

<div class="page">
    <div class="page-main">

    @include('dashboard.user.layouts.header')

{{--    <div class="">--}}

        @include('dashboard.user.layouts.sidebar')
        @yield('content')

{{--    </div>--}}

{{--</div>--}}

@include('dashboard.user.layouts.footer')

</body>
</html>


