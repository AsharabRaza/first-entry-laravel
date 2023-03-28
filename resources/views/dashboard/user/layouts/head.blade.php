<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}" />
{{ HTML::favicon('superAdmin/images/favicon.ico') }}
<title>Dashboard - First Entry</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.3/font/bootstrap-icons.min.css"  />
{{--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">--}}

{{ Html::style('assets/plugin/bootstrap/css/bootstrap.min.css') }}




<!-- STYLE CSS -->
{{ Html::style('assets/css/style.css') }}
{{ Html::style('assets/css/dark-style.css') }}
{{ Html::style('assets/css/skin-modes.css') }}
{{ Html::style('assets/css/transparent-style.css') }}
{{ Html::style('assets/css/color2.css?t='.rand(0,1000)) }}


{{ Html::script('assets/js/jquery.min.js') }}

<!-- BOOTSTRAP JS -->
{{ Html::script('assets/plugin/bootstrap/js/popper.min.js',array('media'=>'all','rel'=>'stylesheet')) }}
{{ Html::script('assets/plugin/bootstrap/js/bootstrap.min.js') }}

{{--<style>

    @if(auth()->user()->user_type == 1)
        @if(auth()->user()->in_review == 1 || auth()->user()->review_approves == 0)
            .side-menu li:not(.not_hide) {
                display: none !important;
            }
        @endif
    @endif

</style>--}}
<!--- FONT-ICONS CSS -->
<!--<link href="../assets/css/icons.css" rel="stylesheet" />-->

<!-- COLOR SKIN CSS -->
<link id="theme" rel="stylesheet" type="text/css" media="all" href="{{ url('assets/colors/color1.css') }}" />

<style>
    .pagination {
        display: flex;
        justify-content: end;
        align-items: center;
        margin-top : 3px;
    }
    .dataTables_paginate {
        display: none;
    }
    .dataTables_info {
        display: none;
    }
</style>


@stack('css')
