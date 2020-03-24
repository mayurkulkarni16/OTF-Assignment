@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                        <img src="\images\{{ $data->profile }}" class="rounded mx-auto d-block" alt="...">
                        <table class="table table-bordered table-striped" style="text-align: center">
                            <thead>
                            <th>Field</th>
                            <th>Value</th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>First Name</td>
                                <td> {{ $data->first_name }} </td>
                            </tr>
                            <tr>
                                <td>Last Name</td>
                                <td> {{ $data->last_name }} </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td> {{ $data->email }} </td>
                            </tr>
                            <tr>
                                <td>Mobile</td>
                                <td> {{ $data->mobile }} </td>
                            </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-success" style="margin-left: 40%" data-toggle="modal" data-target="#exampleModalCenter">{{ __('Update Info') }}</button>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <form method="post" action="{{ route('user.update', $data->id) }}">
{{--                    @method('patch')--}}
                        {{ method_field("patch") }}
{{--                    @csrf--}}
                        {{ csrf_field() }}
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered table-striped" style="text-align: center">
                                <thead>
                                <th>Field</th>
                                <th>Value</th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>First Name</td>
                                    <td> <input type="text" value="{{ $data->first_name }}", class="form-control"> </td>
                                </tr>
                                <tr>
                                    <td>Last Name</td>
                                    <td> <input type="text" value="{{ $data->last_name }}", class="form-control"> </td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td> <input type="email" value="{{ $data->email }}", class="form-control"> </td>
                                </tr>
                                <tr>
                                    <td>Mobile</td>
                                    <td> <input type="text" value="{{ $data->mobile }}", class="form-control"> </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <div class="col text-center">
                                <button type="submit" class="btn btn-primary text-center">{{ __('Save') }}</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
