@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-2 col-sm-12">
                <div class="photo mb-5">
                    <form action="/profile/avatar" method="post" id="avatar_change" enctype="multipart/form-data">
                        @csrf
                        @if(!empty($user->avatar))
                            <label for="avatar">
                                <img class="rounded-circle avatar" src="{{ route('image.displayAvatar', $user->avatar) }}" alt="profile picture" width="150" height="150">
                            </label>

                            <input type="file" class="d-none" id="avatar" name="avatar">
                        @else
                            <label for="avatar">
                                <img class="rounded-circle avatar" src="{{ route('image.displayAvatar', 'no_profile.jpg') }}" alt="profile picture" width="150" height="150">
                            </label>

                            <input type="file" class="d-none" id="avatar" name="avatar">
                        @endif
                        <p class="ml-5 text" id="">Change</p>
                    </form>
                </div>
                @if($user->admin === 1)
                    <div class="secondary w-50">
                        <ul class="list-group">
                            <li class="list-group-item flex-row d-flex justify-content-between"><span>Admin</span>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="admin" name="admin" @if($user->admin === 1) checked @endif>
                                    <label class="custom-control-label" for="admin"></label>
                                </div>
                            </li>
                            <li class="list-group-item flex-row d-flex justify-content-between"><span>publisher</span>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="publisher" name="publisher" @if($user->publisher === 1) checked @endif>
                                    <label class="custom-control-label" for="publisher"></label>
                                </div>
                            </li>
                        </ul>
                    </div>
                @endif
            </div>

            <div class="col-md-6 col-sm-6" id="data-profile">
                <div class="container">
                    <div class="card-body">

                        <div class="form-group">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" value="{{ $user->name }}" disabled>
                        </div>
                        <div class="form-group">
                            <label class="form-label">E-mail</label>
                            <input type="text" class="form-control mb-1" value="{{ $user->email }}" disabled>
                        </div>
                        <div class="form-group">
                            <label class="form-label">description</label>
                            <textarea class="form-control" disabled>{{ $user->description }}</textarea>
                        </div>
                    </div>
                    <a href="/profile/edit" class="btn btn-secondary float-right">Edit the profile</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        document.getElementById("avatar").onchange = function() {
            document.getElementById("avatar_change").submit();
        };
    </script>
@endsection

