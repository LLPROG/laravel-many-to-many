@extends('layouts.admin')

@section('title', 'Create')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">

            {{-- collect errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- form for create a new post - route ti store --}}
            <form method="POST" action="{{ route('admin.posts.store') }}">

                {{-- token for authorization --}}
                @csrf

                {{-- CATEGORY --}}
                <div class="mb-3">
                    {{-- __() => funzione per rendere traducibili la parta visibile --}}
                    <select class="form-select" aria-label="Default select exemple" name="category_id" id="category">
                        <option value="" selected>Select a category</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>


                {{-- TITLE --}}
                <div class="mb-3">
                    {{-- __() => funzione per rendere traducibili la parta visibile --}}
                    <label for="title" class="form-label">{{__('Title')}}</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{  old('title') }}">
                </div>


                {{-- SLUG --}}
                <div class="mb-3">
                    <label for="slug" class="form-label">{{__('Slug')}}</label>
                    <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}">
                </div>
                {{-- slugger button --}}
                <input type="button" value="Generate slug" id="btn-slugger" class=" btn btn-primary">


                {{-- TAGS --}}
                <fieldset>
                    <legend>Tags</legend>
                    @foreach ($tags as $tag)
                        <input type="checkbox" name="tags[]" id="tag-{{ $tag->id }}" value="{{ $tag->id }}"
                            @if (in_array($tag->id, old('tags', []))) checked @endif>
                        <label for="tag-{{ $tag->id }}">{{ $tag->name }}</label>
                    @endforeach
                </fieldset>


                {{-- CONTENT --}}
                <div class="mb-3">
                    <label for="content" class="form-label">{{__('Content')}}</label>
                    <textarea type="text" class="form-control" id="content" name="content">{{ old('content') }}</textarea>
                </div>

                {{-- button create --}}
                <button type="submit" class="btn btn-primary">Create</button>

            </form>

            {{-- link for go to the preview page --}}
            <div class="row">
                <div class="col">
                    <a href="{{  url()->previous() }}">Back</a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
