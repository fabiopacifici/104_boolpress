@extends('layouts.admin')

@section('content')


<h1 class="py-3 text-muted text-uppercase fs-4">Edit Post: {{$post->title}}</h1>


@if ($errors->any())
<div class="alert alert-danger" role="alert">
    <ul>

        @foreach ($errors->all() as $error )
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>

@endif


<div class="card shadow">
    <div class="card-body">
        <form action="{{route('admin.posts.update', $post)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control  @error('title') is-invalid  @enderror" placeholder="Type the psot title here" aria-describedby="helperTitle" value="{{old('title', $post->title)}}">
                <small id="helperTitle" class="text-muted">Type your post title max: 50 characters</small>
            </div>
            @error('title')
            <div class="text-danger">{{$message}}</div>
            @enderror

            <div class="mb-3">
                <label for="cover_image" class="form-label">Choose file</label>
                <input type="file" class="form-control" name="cover_image" id="cover_image" placeholder="Chose a file" aria-describedby="fileHelp">
                <div id="fileHelp" class="form-text">Add an image max 500kb</div>
            </div>
            @error('cover_image')
            <div class="text-danger">{{$message}}</div>
            @enderror


            <div class="mb-3">
                <label for="category_id" class="form-label">Categories</label>
                <select class="form-select @error('category_id') is-invalid  @enderror" name="category_id" id="category_id">
                    <option selected disabled>Select a category</option>
                    <option value="">Uncategorized</option>

                    @forelse ($categories as $category)
                    <option value="{{$category->id}}" {{ $category->id == old('category_id', $post->category_id) ? 'selected' : '' }}>{{$category->name}}</option>
                    @empty

                    @endforelse


                </select>
            </div>
            @error('category_id')
            <div class="text-danger">{{$message}}</div>
            @enderror



            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control  @error('content') is-invalid  @enderror" name="content" id="content" rows="3">{{old('content', $post->content)}}</textarea>
            </div>
            @error('content')
            <div class="text-danger">{{$message}}</div>
            @enderror

            <button class="btn btn-primary" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                    <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z" />
                </svg>
                Update
            </button>


        </form>
    </div>
</div>

@endsection
