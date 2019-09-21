<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Redirect, Response;
use Validator;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Alert::success('ini adalah alert pertama', 'Judul Alert disni');
        return view('post.index');
        // if(request()->ajax()) {
        //         return datatables()->of(Post::select('*'))
        //         ->addColumn('action', 'action_button')
        //         ->rawColumns(['action'])
        //         ->addIndexColumn()
        //         ->make(true);
        //     }
        //     return view('list');
    }


    public function getPost()
    {
        return view('post.index');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request)
    {
        if ($request->ajax()) {
            $rules = array(
                'title.*' => 'required',
                'body.*'  =>  'required'
            );
            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {
                return response()->json([
                    'error' => $error->errors()->all()
                ]);
            }
            $title = $request->title;
            $body = $request->body;
            for ($count = 0; $count < count($title); $count++) {
                $data = array(
                    'title' =>  $title[$count],
                    'body'  =>  $body[$count]
                );
                $insert_data[] = $data;
            }

            Post::insert($insert_data);
            return response()->json([
                'success' => 'Data Added successfully'
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = $request->user_id;
        $user   =   Post::updateOrCreate(
            ['id' => $userId],
            ['name' => $request->name, 'email' => $request->email]
        );
        return Response::json($user);
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
        $where = array('id' => $id);
        $user  = Post::where($where)->first();

        return Response::json($user);
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
        $user = Post::where('id', $id)->delete();

        return Response::json($user);
    }
}
