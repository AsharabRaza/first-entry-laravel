
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
                                            <th class="wd-25p border-bottom-0">Action</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @php
                                            $tooltip_status = 1;
                                            $tooltip_primary = 'data-bs-toggle="tooltip-primary"';
                                            $view_tooltip = $tooltip_primary.' title="view your online form" ';
                                            $edit_tooltip = $tooltip_primary.' title="edit your event/lottery" ';
                                            $duplicate_tooltip = $tooltip_primary.' title="Duplicate your event/lottery" ';
                                            $erase_tooltip = $tooltip_primary.' title="Erase your event/lottery" ';
                                        @endphp
                                        @if(count($data['events']) > 0)
                                            @foreach($data['events'] as $event)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{ $event->name }}</td>
                                                    <td>{{ $event->date }}</td>
                                                    <td>{{ $event->time }}</td>
                                                    <td>{{ $event->location }}</td>
                                                    <td>{{ route('user.event-landing',['event'=>$event->slug]) }} <button class="btn btn-sm btn-primary copy-event-link" data-url="{{ route('user.event-landing',['event'=>$event->slug]) }}"><i class="bi bi-clipboard"></i> copy</button></td>
                                                    <td class="text-center align-middle">
                                                        <div class="btn-group align-top">
                                                            <a {!! ($tooltip_status)?$view_tooltip:'' !!}  class="btn btn-sm btn-primary badge" data-target="#user-form-modal" data-bs-toggle="" href="{{ route('user.event-landing',['event'=>$event->slug]) }}" target="_blank"><i class="bi bi-eye-fill"></i></a>

                                                            <a {!! ($tooltip_status)?$edit_tooltip:'' !!} class="btn btn-sm btn-primary badge" data-target="#user-form-modal" data-bs-toggle="" href="{{ route('user.edit-event',['id'=>$event->id]) }}"><i class="bi bi-pencil-square"></i></a>
                                                            <a {!! ($tooltip_status)?$duplicate_tooltip:'' !!} class="btn btn-sm btn-primary badge" data-target="#user-form-modal" data-bs-toggle="" href="{{ route('user.add-event',['duplicate_id'=>base64_encode($event->id)]) }}"><i class="bi bi-clipboard-plus"></i></a>

{{--                                                            <button {!! ($tooltip_status)?$erase_tooltip:'' !!} class="btn btn-sm btn-primary badge delete_lotteries" type="button" id="delete_lotteries"  data-id="{{ '' }}"><i class="bi bi-trash-fill"></i><div class="spinner-border spinner-border-sm" style="display: none;place-content: center;align-items: center;width: 10px;height: 10px;" role="status"></div></button>--}}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr><td colspan="9" class="text-center">No data available.</td></tr>
                                        @endif

                                        </tbody>
                                    </table>
                                    <div class="pagination">
                                        {{ $data['events']->links() }}
                                    </div>
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
