@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="text-align: center">List of Roles</div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Role</th>
                            </thead>
                            <tbody>
                                @foreach($data as $d)
                                    <tr>
                                        <td> {{ $d->first_name }} </td>
                                        <td> {{ $d->last_name }} </td>
                                        <td> {{ $d->email }} </td>
                                        <td> {{ $d->mobile }} </td>
                                        <td> {{ $d->role }} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection