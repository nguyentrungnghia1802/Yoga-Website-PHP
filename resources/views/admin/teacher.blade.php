@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="mb-4">Manage Teachers</h2>
        <a href="{{ route('admin.teacher.create') }}" class="btn btn-success mb-3">Add New Teacher</a>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Bio</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($teachers as $teacher)
                <tr>
                    <td>{{ $teacher->name }}</td>
                    <td>{{ $teacher->bio }}</td>
                    <td>
                        <a href="{{ route('admin.teacher.edit', $teacher->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.teacher.destroy', $teacher->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
