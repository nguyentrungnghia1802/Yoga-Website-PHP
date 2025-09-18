@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="mb-4">Manage Registrations</h2>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Class</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($registrations as $registration)
                <tr>
                    <td>{{ $registration->customer->name }}</td>
                    <td>{{ $registration->customer->email }}</td>
                    <td>{{ $registration->class->name }}</td>
                    <td>{{ $registration->status }}</td>
                    <td>
                        <!-- Edit/Delete actions removed: routes not defined in web.php -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
