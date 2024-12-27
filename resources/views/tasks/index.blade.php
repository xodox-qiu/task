@extends('tasks.main')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">

            @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3>Tasks</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User Name</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th>Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                            <tr>
                                <td>{{ $task->user_id }}</td>
                                <td>{{ $task->user->name }}</td>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->description }}</td>
                                <td>{{ $task->due_date }}</td>
                                <td>{{ $task->status }}</td>
                                <td>{{ $task->category->name }}</td>
                                <td>
                                    <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-info btn-sm">
                                        Lihat
                                    </a>
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-success btn-sm">
                                        Edit
                                    </a>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
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
