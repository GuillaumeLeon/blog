<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function create(Request $request) {

        $request->validate([
            'content' => 'required|string|max:255',
            'post' => 'required|integer'
        ]);
        $comment = new Comment();
        $comment->author = Auth::user()->id;
        $comment->content = $request->content;
        $comment->post = $request->post;
        $comment->save();

        return redirect('/posts/'.$request->post);
    }

    public function update(Request $request) {
        $request->validate([
           'content' => 'required|string|max:255',
            'id' => 'required|integer'
        ]);

        $id = Comment::where('id', $request->id)->first();

        Comment::where('id', $request->id)->update([
           'content' => $request->content,
        ]);

        return redirect('/posts/'.$id->post);
    }

    public function destroy(Request $request, $id) {

        Comment::where('id', $id)->delete();

        return redirect('/posts/'.  $request->post);
    }
}
