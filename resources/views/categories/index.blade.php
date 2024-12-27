@extends('categories.main')

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

                <div class="card-body">
                    <div class="row">
                        @foreach ($categories as $category)
                        <div class="col-md-3 mb-8">
                        <div class="card shadow-sm custom-card">
                                <div class="card-body">
                                    <p class="card-text">{{ $category->name }}</p>
                                    <p class="card-text">{{ $category->description }}</p>
                                    <p class="card-text">{{ $category->slug }}</p>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('categories.show', $category->id) }}" class="btn btn-info">
                                            Lihat
                                        </a>
                                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-success">
                                            Edit
                                        </a>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
