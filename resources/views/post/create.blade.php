@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row flex-column justify-content-center">

            <div class="col-md-12">
                <div class="row">
                    <h1 class="my-4">
                        Create a blog post
                    </h1>
                </div>
                <div class="row">
                    <form action="/posts/new" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="title">
                                <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" placeholder="Your title">
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </label>

                        </div>
                        <div class="form-group">
                            <label for="categories">
                                <input class="form-control" type="text" name="categories" id="categories" placeholder="categories">
                                <small>e.g: "tag1, tag2, tag3,"</small>

                            </label>
                        </div>
                        <div class="form-group">
                            <label for="content">
                                <textarea class="form-control pell @error('content') is-invalid @enderror" type="text" name="content" id="content" placeholder="Your post"></textarea>
                                @error('content')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </label>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm border">
                                <input id="upload" type="file" class="form-control border-0" name="image">
                                <label id="upload-label" for="upload" class="font-weight-light text-muted">Choose file</label>
                                <div class="input-group-append">
                                    <label for="upload" class="btn btn-light m-0 rounded-pill px-4">
                                        <i class="gg-software-upload text-muted"></i>
                                    </label>

                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
