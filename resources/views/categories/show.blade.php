@extends('categories.main')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Show Category Detail
                            <a href="{{ url('categories') }}" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label>Name</label>
                            <p>
                                {{ $category->name }}
                            </p>
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <p>
                                {!! $category->description !!}
                            </p>
                        </div>
                        <p>
                            {{ $category->slug }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection