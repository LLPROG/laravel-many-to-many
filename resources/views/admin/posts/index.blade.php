@extends('layouts.admin')

@section('title', 'Index')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col py-3">
                <a class="btn btn-primary" href="{{ route('admin.posts.create') }}">
                    Create a new post
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <a class="btn btn-primary" href="{{ route('admin.posts.index') }}">
                    All Post
                </a>

                <a class="btn btn-primary" href="{{ route('admin.posts.myindex') }}">
                    My Post
                </a>
            </div>
        </div>

        {{-- CATEGORY FORM --}}
        <form action="" method="get" class="row g-3 my-3">
            <div class="col-md-8">
                <select class="form-select" aria-label="Default select example" name="category" id="category">
                    <option value="" selected>Select a category</option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if($category->id == $request->category) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 d-block">
                <button class="btn btn-primary">Applica filtri</button>
            </div>
        </form>

        @if (session('deleted'))
            <div class="alert alert-warning">{{ session('deleted') }}</div>
        @endif
        <div class="row">
            <div class="col">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                        <th class="text-center" scope="col">#</th>
                        <th class="text-center" scope="col">Title</th>
                        <th class="text-center" scope="col">Content</th>
                        <th class="text-center" scope="col">Slug</th>
                        <th class="text-center" scope="col">Category</th>
                        <th class="text-center" scope="col">Tags</th>
                        <th class="text-center" scope="col">Created At</th>
                        <th class="text-center" scope="col">Updated At</th>
                        <th class="text-center" scope="col" colspan="3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr data-id="{{ $post->slug }}">
                                <th class="text-center" scope="row">{{ $post->id }}</th>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->content }}</td>
                                <td>{{ $post->slug }}</td>
                                <td>{{ $post->category_id }}</td>
                                <td>{{ $post->tags->pluck('name')->join(', ') }}</td>
                                <td>{{ date('d/m/Y', strtotime($post->created_at)) }}</td>
                                <td>{{ date('d/m/Y', strtotime($post->updated_at)) }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('admin.posts.show', $post->slug) }}">View</a>
                                </td>
                                <td>
                                    @if (Auth::user()->id === $post->user_id)
                                        <a class="btn btn-primary" href="{{ route('admin.posts.edit', $post->slug) }}">Edit</a>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if (Auth::user()->id === $post->user_id)
                                        <button class="btn btn-danger btn-delete">Delete</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- link for panination --}}
        {{ $posts->links() }}

        {{-- confirmation-overlay set with javascrip --}}
        <section id="confirmation-overlay" class="overlay d-none">
            <div class="popup">
                <h1>Sei sicuro di voler eliminare?</h1>
                <div class="d-flex justify-content-center">
                    <button id="btn-no" class="btn btn-primary me-3">NO</button>
                    <form method="POST" data-base="{{ route('admin.posts.destroy', '*****') }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">SI</button>
                    </form>
                </div>
            </div>
        </section>

    </div>
@endsection
