<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\User;
use App\Models\Post;

class HomeController extends Controller
{

    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $posts = Post::orderBy('id', 'desc')->paginate(5);

        $authors = [];
        foreach ($posts as $post) {
            if(!isset($authors[$post->author])) {
                $author = User::where('id', $post->author)->first();
                $authors[$author->id] = $author->name;
            }
        }

        return view('home', ['posts' => $posts, 'request' => $request, 'authors' => $authors]);
    }

    public function displayImage($filename) {
        $path = Storage::path($filename);

        if (empty($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function displayAvatar($filename) {
        $path = Storage::disk('avatar')->path($filename);

        if (empty($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }
}
