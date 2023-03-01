<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
{{ Html::style('assets/css/color2.css') }}


{{--<link href="../assets/css/color2.css?t=<?php echo rand(0, 10000);?>" rel="stylesheet" />--}}

<!--- FONT-ICONS CSS -->
<!--<link href="../assets/css/icons.css" rel="stylesheet" />-->

<!-- COLOR SKIN CSS -->
<link id="theme" rel="stylesheet" type="text/css" media="all" href="{{ url('assets/colors/color1.css') }}" />

{{--
<style>
    <?php
        if($user_type == 1){
            if($in_review == 1 || $review_approves == 0){
                ?>
                .side-menu li:not(.not_hide) {
        display: none !important;
    }
    <?php
    }
    }

    ?>

</style>--}}


@stack('css')
