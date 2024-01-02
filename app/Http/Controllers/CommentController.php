<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $tweet)
    {
        Comment::create([
            'tweet_id' => $tweet,
            'user_id' => auth()->id(),
            'message' => $request->message,
        ]);

        session()->flash('success', 'Berhasil menambahkan komentar');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($tweet, $comment)
    {
        return view('comments.edit', [
            'comment' => Comment::find($comment),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $tweet, $comment)
    {
        $comment = Comment::find($comment);

        $comment->update([
            'message' => $request->message,
        ]);

        session()->flash('success', 'Berhasil memperbarui komentar');
        return to_route('tweets.show', $tweet);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($tweet, $comment)
    {
        $comment = Comment::find($comment);

        $comment->delete();

        session()->flash('danger', 'Berhasil menghapus komentar');
        return to_route('tweets.show', $tweet);
    }
}
