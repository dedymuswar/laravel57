<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\User;

use App\Notifications\KomentarPostingan;
use App\Notifications\RepliedToThread;
use Illuminate\Support\Facades\Notification;
use App\Thread;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     //
    // }

    public function index()
    {
        return view('comment.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Thread $thread)
    {
        $this->validate($request, array(
            'komentar'  =>  'required|max:10000'
        ));
        $thread = Thread::find(2);
        $komen = new Comment();
        $komen->users_id    =   auth()->user()->id;
        // $komen->nama        =   $request->input('nama');
        $komen->komentar    =   $request->input('komentar');
        $komen->save();
        // $thread->addComment($request->input('komentar'));
        $thread->user->notify(new RepliedToThread()); //menginput notify ke tabel notification

        return redirect()->route('dataComment')->with('success', 'Berhasil menambahkan komentar!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
