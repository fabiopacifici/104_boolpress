@extends('layouts.admin')


@section('content')

@if (session('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <strong>Message: </strong> {{session('message')}}
</div>


@endif

<h1>All Posts here</h1>


<div class="table-responsive-sm">
    <table class="table table-striped
    table-hover
    table-borderless
    table-light
    align-middle">
        <thead class="table-light">
            <caption>Posts</caption>
            <tr>
                <th>ID</th>
                <th>Cover Image</th>
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">

            @forelse ($posts as $post)
            <tr class="table-primary">
                <td scope="row">{{$post->id}}</td>
                <td>


                    @if ($post->cover_image)
                    <img width="100" src="{{asset('storage/' . $post->cover_image)}}" alt="{{$post->title}} image">
                    @else
                    N/A
                    @endif

                </td>
                <td>{{$post->title}}</td>
                <td>View/Edit/Delete</td>
            </tr>
            @empty
            <tr class="table-primary">
                <td scope="row">No posts here! 🙀</td>

            </tr>
            @endforelse

            {{$posts->links('pagination::bootstrap-5')}}



        </tbody>
        <tfoot>

        </tfoot>
    </table>
</div>




@endsection