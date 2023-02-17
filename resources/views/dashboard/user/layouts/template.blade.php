<!DOCTYPE html>
<html lang="en">
    <head>
      @include('dashboard.user.layouts.head')
    </head>
<body>
{{--<div class="">--}}

    @include('dashboard.user.layouts.header')

{{--    <div class="">--}}

        @include('dashboard.user.layouts.sidebar')
        @yield('content')

{{--    </div>--}}

{{--</div>--}}

@include('dashboard.user.layouts.footer')

</body>
</html>


