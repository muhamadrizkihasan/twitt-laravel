<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'tweets' => Tweet::latest()->get(),
        ]);
    }

    public function show($tweet)
    {
        // $orders = Order::with('user')->simplePaginate(5);
        // $tweet = Tweet::with('tweets')->get();

        return view('tweets.show', [
            'tweet' => Tweet::find($tweet),
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => ['required'],
        ]);

        Tweet::create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        session()->flash('success', 'Berhasil membuat tweet');
        return to_route('dashboard');
    }

    public function edit($tweets)
    {
        return view('tweets.edit', [
            'tweet' => Tweet::find($tweets),
        ]);
    }

    public function update(Request $request, $tweets)
    {
        $this->validate($request, [
            'content' => ['required'],
        ]);

        $tweet = Tweet::find($tweets);

        $tweet->update([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        session()->flash('success', 'Berhasil mengedit tweet');
        return to_route('dashboard');
    }

    public function destroy($tweets)
    {
        $tweet = Tweet::find($tweets);

        $tweet->delete();

        session()->flash('danger', 'Berhasil menghapus tweet');
        return to_route('dashboard');
    }
}
