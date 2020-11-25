<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function create()
    {
        return view('post.create');
    }

    public function show(Request $request) {
        $post = Post::where('id', $request->route()->parameter('id'))->first();

        if(is_null($post)) {
            abort(404);
        }
        $comments = Comment::where('post', $post->id)->get();

        $author_post = User::where('id', $post->author)->select('name')->first();
        $author_post = $author_post->name;

        $authors_comments = [];
        foreach ($comments as $comment) {
            if(!isset($authors_comments[$comment->author])) {
                $author = User::where('id', $comment->author)->first();
                $authors_comments[$author->id] = $author;
            }
        }


        return view('post.show', ['post' => $post, 'comments' => $comments, 'author_post' => $author_post, 'authors_comments' => $authors_comments]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'categories' => 'string',
            'image' => 'image|mimes:jpeg,jpg,png,gif|max:10000',
        ]);

        if(!empty($request->file('image'))) {
            $path = $request->file('image')->store('/');
        } else {
            $path = null;
        }

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->author = Auth::user()->id;
        $post->categories = $request->categories;
        $post->image = $path;
        $post->save();

        if($post) {
            return redirect()->to('/');
        }
        return redirect()->back();
    }

    public function edit(Int $id)
    {
        $post = Post::where('id', $id)->first();

        return view('post.edit', ['post' => $post]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:10000',
        ]);

        $image_exist = Post::where('id', $id)->select('image')->first();

        if(!empty($request->file('image'))) {
            $path = $request->file('image')->store('/');
            Storage::delete($image_exist->image);
        } elseif(isset($request->delete_img)) {
            $path = null;
            Storage::delete($image_exist->image);
        } else {
            $path = $image_exist->image;
        }

        Post::where('id', $id)->update([
            'title' => $request->title,
            'content' => $request->content,
            'categories' => $request->categories,
            'image' => $path,
        ]);

        return redirect('/posts/'.$id);
    }

    public function destroy($id)
    {
        Post::where('id', $id)->delete();
        Comment::where('post', $id)->delete();

        return redirect('/');
    }
}
