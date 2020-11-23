@extends('layouts.app')

@section('content')
    <style>
        .avatar-small {
            width: 50px;
        }
    </style>
    <div class="container">

        <div class="row">

            <div class="col-lg-8">
                <ol class="breadcrumb">
                    <li><a href="/">Home&nbsp;</a>/</li>
                    <li class="active">&nbsp;post</li>
                </ol>
                <h1 class="mt-4 d-flex justify-content-between">
                    <span>{{ $post->title }}</span>
                    @if(isset(Auth::user()->id) && Auth::user()->id == $post->author)
                        <span class="d-flex flex-row">
                           <img src="{{ asset('images/pen.svg') }}" class="ml-1 mr-1" alt="edit" data-toggle="tooltip" data-placement="top" title="Edit" onclick="window.location.href='/posts/{{ $post->id }}/edit'" style="cursor: pointer">

                        <form id="delete-form" action="/posts/{{ $post->id }}" method="post">
                            @csrf
                            @method('DELETE')
                        </form>
                            <img src="{{ asset('images/remove.svg') }}" class="ml-1 mr-1" alt="delete" data-toggle="tooltip" data-placement="top" title="Delete"
                                 onclick="event.preventDefault(); document.getElementById('delete-form').submit()"
                                 style="cursor:pointer;">
                        @endif
                            </span>
                </h1>

                <p class="lead">
                    by
                    <a href="#">{{ $author_post }}</a>
                </p>
                <hr>
                <p>Posted on {{ \Carbon\Carbon::parse($post->created_at)->isoFormat('MMMM D, Y ') }} at {{ \Carbon\Carbon::parse($post->created_at)->isoFormat('HH:mm A') }}</p>
                <hr>

                @if(!empty($post->image))
                    <img class="img-fluid rounded" src="{{ route('image.displayImage',$post->image) }}" alt="">
                @endif
                <hr>
                <p class="lead">{!! $post->content !!}</p>
                <hr>

                <div class="card my-4">
                    <h5 class="card-header">Leave a Comment:</h5>
                    <div class="card-body">
                        <form method="post" action="/comments/new">
                            @csrf
                            <input type="hidden" value="{{ $post->id }}" name="post">
                            <div class="form-group">
                                <textarea class="form-control @error('content') is-invalid @enderror" name="content" rows="3" required></textarea>
                                @error('content')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

                @foreach($comments as $comment)
                    <div class="media mb-4" id="comment-{{ $comment->id }}">
                        @if(isset($authors_comments[$comment->author]->avatar))
                            <img class="d-flex mr-3 rounded-circle avatar-small" src="{{ route('image.displayAvatar', $authors_comments[$comment->author]->avatar )}}" alt="">
                        @else
                            <img class="d-flex mr-3 rounded-circle avatar-small" src="{{ route('image.displayAvatar', 'no_profile.jpg') }}" alt="">
                        @endif
                        <div class="media-body">
                            <div class="d-flex justify-content-between">
                                <span><h5 class="mt-0">{{ $authors_comments[$comment->author]->name }}</h5></span>
                                @if(isset(Auth::user()->id) && Auth::user()->id == $comment->author)
                                    <span class="d-flex flex-row">
                                <img src="{{ asset('images/pen.svg') }}" class="ml-1 mr-1" id="{{ $comment->id }}" alt="edit" data-toggle="tooltip" data-placement="top" title="Edit"
                                     onclick="modify(this.id);" style="cursor: pointer;">
                                    <form method="post" id="delete-form-comment" action="/comments/{{ $comment->id }}">
                                        <input type="hidden" name="post" value="{{ $post->id }}">
                                        @csrf
                                        @method('DELETE')
                                        </form>
                                <img src="{{ asset('images/remove.svg') }}" class="ml-1 mr-1" alt="delete" data-toggle="tooltip" data-placement="top" title="Delete"
                                     onclick="event.preventDefault(); document.getElementById('delete-form-comment').submit()" style="cursor: pointer;">
                            </span>
                                @endif
                            </div>
                            <p>{{ $comment->content }}</p>
                        </div>
                    </div>
                @endforeach
{{--                <div class="media mb-4">
                    <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                    <div class="media-body">
                        <h5 class="mt-0">Commenter Name</h5>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.

                        <div class="media mt-4">
                            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                            <div class="media-body">
                                <h5 class="mt-0">Commenter Name</h5>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>

                        <div class="media mt-4">
                            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                            <div class="media-body">
                                <h5 class="mt-0">Commenter Name</h5>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>

                    </div>
                </div>--}}
            </div>

            <div class="col-md-4">

                <div class="card my-4">
                    <h5 class="card-header">Search</h5>
                    <div class="card-body">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="input-group-append">
                <button class="btn btn-secondary" type="button">Go!</button>
              </span>
                        </div>
                    </div>
                </div>

                <!-- Categories Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Categories</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <a href="#">Web Design</a>
                                    </li>
                                    <li>
                                        <a href="#">HTML</a>
                                    </li>
                                    <li>
                                        <a href="#">Freebies</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <a href="#">JavaScript</a>
                                    </li>
                                    <li>
                                        <a href="#">CSS</a>
                                    </li>
                                    <li>
                                        <a href="#">Tutorials</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection

@section('js')
    <script>
    </script>
@endsection
