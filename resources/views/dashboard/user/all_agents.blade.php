@extends('dashboard.user.layouts.template')

@section('content')

    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">All agents</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Management</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Agents</a></li>
                            <li class="breadcrumb-item active" aria-current="page">All agents</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- Row -->
                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header" style="place-content: space-between;">
                                <h3 class="card-title">All users</h3>
                                <small>All times are in <strong>{{ 'selected timezone' }}</strong></small>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-users" style="display: none;"></div>
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom w-100" id="responsive-datatable">
                                        <thead>
                                        <tr>
                                            <th class="wd-15p border-bottom-0">ID</th>
                                            <th class="wd-20p border-bottom-0">First name</th>
                                            <th class="wd-20p border-bottom-0">Last name</th>
                                            <th class="wd-20p border-bottom-0">Email</th>
                                            <th class="wd-20p border-bottom-0">About projects</th>
                                            <th class="wd-20p border-bottom-0">Date joined</th>
                                            <th class="wd-25p border-bottom-0">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @if(count($data['agents']) > 0)
                                            @foreach($data['agents'] as $user)
                                                <tr>
                                                    <td class="align-middle text-center">{{$user->id}}</td>
                                                    <td class="align-middle">{{$user->first_name}}</td>
                                                    <td class="align-middle">{{$user->last_name}}</td>
                                                    <td class="align-middle">{{$user->email}}@if($user->email_confirm == 1)<span class="badge bg-success mx-1" style="background: #198754 !important;">Verified</span>@elseif($user->email_confirm == 0)<span class="badge bg-danger mx-1">Not verified</span>@endif</td>
                                                    <td class="align-middle">@if($user->about_projects != ''){{$user->about_projects}}@else<span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">NO DATA</span>@endif</td>
                                                    <td class="align-middle">{{$user->date_joined}}</td>
                                                    <td class="text-center align-middle">
                                                        @if($user->in_review == 1)
                                                            <div class="btn-group align-top mb-2">
                                                                <a class="btn btn-sm btn-info badge" href="#" data-bs-placement="left" data-bs-toggle="tooltip-info" title="Approve" id="approve_request" data-id="{{$user->id}}" data-email="{{$user->email}}" data-fullname="{{$user->first_name . ' ' . $user->last_name}}"><i class="bi bi-check-lg"></i><div class="spinner-border spinner-border-sm" style="display: none;place-content: center;align-items: center;width: 10px;height: 10px;" role="status"></div></a>
                                                                <a class="btn btn-sm btn-info badge" href="#" data-bs-placement="top" data-bs-toggle="tooltip-info" title="Decline" id="decline_request" data-id="{{$user->id}}" data-email="{{$user->email}}" data-fullname="{{$user->first_name . ' ' . $user->last_name}}"><i class="bi bi-x-lg"></i><div class="spinner-border spinner-border-sm" style="display: none;place-content: center;align-items: center;width: 10px;height: 10px;" role="status"></div></a>
                                                            </div>
                                                            <br>
                                                        @endif
                                                        <div class="btn-group align-top">
                                                            {{--<a class="btn btn-sm btn-primary badge" href="javascript:void(0);" --}}{{--target="_blank"--}}{{--><i class="bi bi-eye-fill"></i></a>--}}
                                                            <a class="btn btn-sm btn-primary badge" href="{{ route('user.edit-agent',['id'=>$user->id]) }}"><i class="bi bi-pencil-square"></i></a>
                                                            <button class="btn btn-sm btn-primary badge delete_agents" id="delete_agents" data-id="{{$user->id}}" type="button"><i class="bi bi-trash-fill"></i><div class="spinner-border spinner-border-sm" style="display: none;place-content: center;align-items: center;width: 10px;height: 10px;" role="status"></div></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            {{ '<tr><td colspan="18" class="text-center">No data available.</td></tr>' }}
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
    <style>
        .in_review_main {
            display: none !important;
        }
        a.badge {
            color: #fff !important;
        }
        .badge-big {
            font-size: 12px !important;
        }
    </style>
@endpush
@push('js')

    <!-- FORMEDITOR JS -->
    {{ Html::script('assets/plugin/sweet-alert/sweetalert.min.js') }}

    {{ Html::script('user/js/agent.js?t='.rand(0,10000)) }}

    <script>

        var delete_agent = '{{ route('user.delete-agent') }}';

        $(function(e) {
            $('#responsive-datatable').DataTable({
                "iDisplayLength": 50,
                scrollX: "100%",
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                }
            });

            var tooltip_primary = $('[data-bs-toggle="tooltip-primary"]');
            for (let index = 0; index < tooltip_primary.length; index++) {
                var tooltip = new bootstrap.Tooltip(tooltip_primary[index], {
                    template: '<div class="tooltip tooltip-primary" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
                });
            }
            var tooltip_info = $('[data-bs-toggle="tooltip-info"]');
            for (let index = 0; index < tooltip_info.length; index++) {
                var tooltip = new bootstrap.Tooltip(tooltip_info[index], {
                    template: '<div class="tooltip tooltip-info" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
                });
            }
            var tooltip_danger = $('[data-bs-toggle="tooltip-danger"]');
            for (let index = 0; index < tooltip_danger.length; index++) {
                var tooltip = new bootstrap.Tooltip(tooltip_danger[index], {
                    template: '<div class="tooltip tooltip-danger" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
                });
            }
        });
    </script>

@endpush
