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
                        <h1 class="page-title">Add agent</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Managemnet</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Agents</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add agent</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header" style="place-content: space-between;">
                                <h3 class="card-title">Add agent</h3>
                                <small>All times are in <strong>{{ 'selected timezone' }}</strong></small>
                            </div>
                            <form id="add_agent_form" onsubmit="return false" method="POST" style="display: inline-grid;">
                                <div class="card-body">
                                    <div class="alert add_agent_alert" style="display: none;"></div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card no-shadow">
                                                <div class="card-header">
                                                    <h3 class="card-title">Agent information</h3>
                                                </div>
                                                <div class="card-body">

                                                    <div class="form-group row d-flex">
                                                        <label class="col-md-3 col-form-label" for="startDate">Agent name</label>
                                                        <div class="col-md-9">
                                                            <input type="text" name="agent_name" id="agent_name" value="" placeholder="Enter agent name" class="form-control" required="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row d-flex">
                                                        <label class="col-md-3 col-form-label" for="startDate">Last name</label>
                                                        <div class="col-md-9">
                                                            <input type="text" name="agent_last_name" id="agent_last_name" value="" placeholder="Enter last name" class="form-control" required="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row d-flex">
                                                        <label class="col-md-3 col-form-label" for="startDate">Email</label>
                                                        <div class="col-md-9">
                                                            <input type="text" name="agent_email" id="agent_email" value="" placeholder="Enter email" class="form-control" required="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row d-flex">
                                                        <label class="col-md-3 col-form-label" for="startDate">Password</label>
                                                        <div class="col-md-9">
                                                            <input type="password" name="agent_password" id="agent_password" value="" placeholder="Enter password" class="form-control" required="">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card no-shadow">
                                                <div class="card-header">
                                                    <h3 class="card-title">Agent permissions</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group row d-flex">
                                                        <label class="col-md-3 col-form-label" for="startDate">Actions</label>
                                                        <div class="col-md-9">
                                                            <select name="agent_permissions_actions[]" id="agent_permissions_actions" class="form-control select2" multiple required>
                                                                @if(count($data['agentsPermissions']) !== 0)
                                                                    @foreach($data['agentsPermissions'] as $permission)
                                                                        <option value="{{ $permission->id }}">{{ $permission->permissions_nicename }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row d-flex">
                                                        <label class="col-md-3 col-form-label" for="startDate">Expire</label>
                                                        <div class="col-md-9" style="align-items: center;display: flex;">
                                                            <label for="" class="m-0"><i>Coming soon</i></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="card-footer text-end">
                                    <button class="btn btn-primary" type="submit" id="add_btn" style="float: right;position: relative;">
                                        <span style="-webkit-transition: all 0.2s;transition: all 0.2s;">Add</span>
                                        <span style="-webkit-transition: all 0.2s;transition: all 0.2s;"><div class="spinner-border spinner-border-sm" style="display: none;place-content: center;align-items: center;" role="status"></div></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- COL END -->
                </div>
                <!-- ROW-1 END -->

            </div>
            <!-- CONTAINER END -->
        </div>
    </div>
    <!--app-content end-->

@endsection
@push('css')
    <style>
        .sweet-alert button.cancel {
            color: #fff !important;
            background: #dd2540 !important;
            border-color: #df2540 !important;
        }

        @media (max-width: 576px) {
            .input-icon {
                display: none;
            }
            .input-icon + .form-control {
                border-radius: 7px !important;
            }
        }
    </style>
@endpush
@push('js')

    <script>
        var add_agent = '{{ route('user.add-agent') }}';
    </script>
    <!-- FORMEDITOR JS -->
    {{ Html::script('assets/plugin/sweet-alert/sweetalert.min.js') }}

    {{ Html::script('user/js/agent.js?t='.rand(0,10000)) }}


@endpush
