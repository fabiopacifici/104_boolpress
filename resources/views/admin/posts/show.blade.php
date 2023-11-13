@extends('layouts.admin')

@section('content')

<h1>{{$post->title}}</h1>
<img src="{{asset('storage/' . $post->cover_image)}}" alt="{{$post->title}} image">
<div class="content">
    <p>
        {{$post->content}}
    </p>


    <span class="badge bg-primary">
        {{$post->category ? $post->category->name : 'Uncategorized' }}
    </span>


</div>
@endsection
