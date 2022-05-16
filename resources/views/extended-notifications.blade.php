@extends('layouts.master')

@section('title') @lang('translation.Notifications') @endsection

@section('css')

    <!-- alertifyjs Css -->
    <link href="{{ URL::asset('/assets/libs/alertifyjs/alertifyjs.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- alertifyjs default themes  Css -->
    {{-- <link href="{{ URL::asset('/assets/libs/alertifyjs/build/css/themes/default.min.css') }}" rel="stylesheet"
        type="text/css" /> --}}

@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Extended @endslot
        @slot('title') Notifications @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">AlertifyJs</h4>
                    <p class="card-title-desc">Notifications examples of using AlertifyJS.</p>
                </div>
                <div class="card-body">

                    <h4 class="card-title mb-4">Default Dialogs</h4>

                    <div class="row text-center">
                        <div class="col-sm-4">
                            <div class="my-4">
                                <h5 class="mb-4">Alert</h5>

                                <a href="javascript: void(0);"  id="alert" class="btn btn-primary waves-effect waves-light">Click me</a>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="my-4">
                                <h5 class="mb-4">Confirm</h5>

                                <a href="javascript: void(0);"  id="alert-confirm" class="btn btn-primary waves-effect waves-light">Click me</a>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="my-4">
                                <h5 class="mb-4">Prompt</h5>

                                <a href="javascript: void(0);"  id="alert-prompt" class="btn btn-primary waves-effect waves-light">Click me</a>
                            </div>
                        </div>
                    </div>


                    <h4 class="card-title mt-5 mb-3">Default Notifications</h4>

                    <div class="table-responsive">
                        <table class="table mb-0">

                            <tbody>
                                <tr>
                                    <td>Default alert</td>
                                    <td><a href="javascript: void(0);"  id="alert-message" class="btn btn-primary btn-sm waves-effect waves-light">Click me</a></td>
                                </tr>
                                <tr>
                                    <td>Success alert</td>
                                    <td><a href="javascript: void(0);"  id="alert-success" class="btn btn-primary btn-sm waves-effect waves-light">Click me</a></td>
                                </tr>
                                <tr>
                                    <td>Error alert</td>
                                    <td><a href="javascript: void(0);"  id="alert-error" class="btn btn-primary btn-sm waves-effect waves-light">Click me</a></td>
                                </tr>
                                <tr>
                                    <td>Warning alert</td>
                                    <td><a href="javascript: void(0);"  id="alert-warning" class="btn btn-primary btn-sm waves-effect waves-light">Click me</a></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

@endsection

@section('script')

    <script src="{{ URL::asset('/assets/libs/alertifyjs/alertifyjs.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/pages/notification.init.js') }}"></script>

@endsection
