@extends('layouts.admin')

@section('content')

<h1>{{$post->title}}</h1>
<img src="{{asset('storage/' . $post->cover_image)}}" alt="{{$post->title}} image">
<div class="content">
    <p>
        {{$post->content}}
    </p>


    <div>
        <span>Category: </span>
        <span class="badge bg-primary">
            {{$post->category ? $post->category->name : 'Uncategorized' }}
        </span>
    </div>


    <div class="d-flex gap-2">
        <span>Tags: </span>
        <ul class="d-flex gap-1 list-unstyled">
            @forelse ($post->tags as $tag)
            <li class="badge bg-secondary">
                <i class="fas fa-tag fa-xs fa-fw"></i>
                {{$tag->name}}
            </li>
            @empty
            <li class="badge bg-secondary">Untagged</li>
            @endforelse
        </ul>
    </div>


</div>
@endsection