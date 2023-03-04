
@extends('dashboard.user.layouts.template')

@section('content')
    @php
    //dd($data['events']);
    @endphp
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">All Landing Pages</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">All Landing Pages</a></li>
                            <li class="breadcrumb-item active" aria-current="page">All Landing Pages</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- Row -->
                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header" style="place-content: space-between;">
                                <div>
                                    <h3 class="card-title">All Landing Pages</h3>
                                    <small>All times are in <strong>{{ 'selected timezone' }}</strong></small>
                                </div>
                                <div>
                                    <a href="{{ route('user.add-event') }}" class="btn btn-primary">Create event</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-entries" style="display: none;"></div>
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom w-100" id="responsive-datatable">
                                        <thead>
                                        <tr>
                                            <th class="wd-15p border-bottom-0">SN</th>
                                            <th class="wd-20p border-bottom-0">Name</th>
                                            <th class="wd-20p border-bottom-0">Date</th>
                                            <th class="wd-15p border-bottom-0">Time</th>
                                            <th class="wd-25p border-bottom-0">Location</th>
                                            <th class="wd-25p border-bottom-0">Url</th>
                                            <!-- <th class="wd-25p border-bottom-0">Copy url</th> -->
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @if(count($data['events']) > 0)
                                            @foreach($data['events'] as $event)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{ $event->name }}</td>
                                                    <td>{{ $event->date }}</td>
                                                    <td>{{ $event->time }}</td>
                                                    <td>{{ $event->location }}</td>
                                                    <td>{{ route('user.event-landing',['event'=>$event->slug]) }}</td>
{{--                                                <!-- <td><button class="btn btn-sm btn-primary copy-event-link" data-url="<?php echo $slug ?>">copy</button></td> -->--}}
                                                </tr>
                                            @endforeach
                                        @else
                                            {{ '<tr><td colspan="9" class="text-center">No data available.</td></tr>' }}
                                        @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Row -->

            </div>
            <!-- CONTAINER END -->
        </div>
    </div>
    <!--app-content end-->
@endsection
@push('css')

    {{ Html::style('assets/css/welcome.css') }}


    <style>
        a.badge {
            color: #fff !important;
        }
    </style>
@endpush
@push('js')
    {{ Html::script('user/js/event.js?t='.rand(0,10000)) }}
    {{ Html::script('assets/plugin/sweet-alert/sweetalert.min.js') }}

    <script>
        $(function(e) {
            $('#responsive-datatable').DataTable({
                scrollX: "100%",
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                }
            });
        });
    </script>

@endpush
