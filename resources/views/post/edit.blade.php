@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row flex-column justify-content-center">

            <div class="col-md-12">
                <div class="row">
                    <h1 class="my-4">
                        Edit a blog post
                    </h1>
                </div>
                <div class="row">
                    <form action="/posts/{{ $post->id }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="title">
                                <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" placeholder="Your title" value="{{ $post->title }}">
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="categories">
                                <input class="form-control" type="text" name="categories" id="categories" placeholder="categories" value="{{ $post->categories }}">
                                <small>e.g: "tag1, tag2, tag3,"</small>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="content">
                                <textarea class="form-control @error('content') is-invalid @enderror" type="text" name="content" id="content" placeholder="Your post"> {!! $post->content !!}</textarea>
                                @error('content')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </label>
                        </div>

                        <div class="form-group d-flex">
                            <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm border">
                                <input id="upload" type="file" class="form-control border-0" name="image">
                                <label id="upload-label" for="upload" class="font-weight-light text-muted">{{ isset($post->image) ? $post->image : 'Choose file' }}</label>
                                <div class="input-group-append">
                                    <label for="upload" class="btn btn-light m-0 rounded-pill px-4">
                                        <i class="gg-software-upload text-muted"></i>
                                    </label>
                                </div>
                            </div>
                            <i class="gg-trash text-muted mt-4 ml-4" onclick="clear()"></i>

                        </div>
                        <button type="submit" class="btn btn-primary">Modify</button>
                </form>
            </div>
            </div>
        </div>
    </div>

@endsection
