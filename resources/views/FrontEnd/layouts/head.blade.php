<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">

<title>{{ config('app.name') }}</title>
<meta content="" name="description">
<meta content="" name="keywords">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- Favicons -->
<link href="{{ url('user/images/favicon.png')  }}" rel="icon">
{{--<link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">--}}

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

<!-- Vendor CSS Files -->
{{ Html::style('FrontEnd/vendor/aos/aos.css') }}
{{ Html::style('FrontEnd/vendor/bootstrap/css/bootstrap.min.css') }}
{{ Html::style('FrontEnd/vendor/bootstrap-icons/bootstrap-icons.css') }}
{{ Html::style('FrontEnd/vendor/glightbox/css/glightbox.min.css') }}
{{ Html::style('FrontEnd/vendor/boxicons/css/boxicons.min.css') }}
{{ Html::style('FrontEnd/vendor/swiper/swiper-bundle.min.css') }}

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

<!-- Template Main CSS File -->
{{ Html::style('FrontEnd/css/public_style.css') }}
