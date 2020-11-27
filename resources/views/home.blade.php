@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1 class="my-4">Blog perso
                </h1>
                @foreach($posts as $post)
                    <div class="card mb-4">
                        @if(!empty($post->image))
                            <img class="card-img-top" src="{{ route('image.displayImage', $post->image) }}" alt="Card image cap">
                        @endif
                        <div class="card-body">
                            <h2 class="card-title">{{ $post->title }}</h2>
                            <hr>
                            <p> {{ substr(strip_tags($post->content), 0, 60). ' ... ' }}</p>
                            <a href="/posts/{{ $post->id }}" class="btn btn-primary">Read article &rarr;</a>
                        </div>
                        <div class="card-footer text-muted">
                            Posted on {{ \Carbon\Carbon::parse($post->created_at)->isoFormat('dddd D, Y') }} by
                            <a href="#" id="{{ $post->author }}">{{ $authors[$post->author] }}</a>
                        </div>
                    </div>
                @endforeach
                {{ $posts->links() }}

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

