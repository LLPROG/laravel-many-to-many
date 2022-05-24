@extends('layouts.admin')

@section('title', 'edit')

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

            <form method="POST" action="{{ route('admin.posts.update', $post->slug) }}">

                @csrf
                @method('PUT')

                {{-- TITLE --}}
                <div class="mb-3">
                    {{-- __() => funzione per rendere traducibili la parta visibile --}}
                    <label for="title" class="form-label">{{__('Title')}}</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{  old('title', $post->title) }}">
                </div>


                {{-- SLUG --}}
                <div class="mb-3">
                    <label for="slug" class="form-label">{{__('Slug')}}</label>
                    <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $post->slug) }}">
                </div>
                {{-- slugger button --}}
                <input type="button" value="Generate slug" id="btn-slugger">


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

                {{-- TAGS --}}
                <fieldset>
                    <legend>Tags</legend>
                    @foreach ($tags as $tag)
                        <input type="checkbox" name="tags[]" id="tag-{{ $tag->id }}" value="{{ $tag->id }}"
                            @if (in_array($tag->id, old('tags', $post->tags->pluck('id')->all()))) checked @endif>
                        <label for="tag-{{ $tag->id }}">{{ $tag->name }}</label>
                    @endforeach
                </fieldset>


                {{-- CONTENT --}}
                <div class="mb-3">
                    <label for="content" class="form-label">{{__('Content')}}</label>
                    <textarea type="text" class="form-control" id="content" name="content">{{ old('content', $post->content) }}</textarea>
                </div>

                {{-- button create --}}
                <button type="submit" class="btn btn-primary">Update</button>
            </form>

            <div class="row">
                <div class="col">
                    <a href="{{  url()->previous() }}">Back</a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
