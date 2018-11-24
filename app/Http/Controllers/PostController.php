<?php

namespace BAKD\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('all');
    }

    /**
     * Show all items available for this resource
     *
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $limit = request()->get('limit', 10);
        $offset = request()->get('offset', 0);
        // $page = request()->get('page', 1);
        $order = request()->get('order', 'desc');
        // $data = \BAKD\Post::with('user')->orderBy('id', $order)->paginate($limit);

        $data = \BAKD\Post::with('user')->orderBy('created_at', 'desc')->skip($offset)->take($limit)->get();
        return response()->json($data);
    }

    /**
     * Ping the following post id's to update stats/timestamps 
     *
     * @return \Illuminate\Http\Response
     */
    public function ping(Request $request)
    {
        $ids = request()->get('ids');
        $data = \BAKD\Post::with('user')->orderBy('created_at', 'desc')->whereIn('id', $ids)->get();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = request()->user();
        $post = \BAKD\Post::create([
            'user_id' => $user->id,
            'message' => request()->message,
            'ip' => \Request::ip()
        ]); 

        // broadcast(new \BAKD\Events\PostCreatedEvent($post, $user))->toOthers();
        event(new \BAKD\Events\PostCreatedEvent($post, $user));
        return response()->json(['post' => $post, 'user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post;
        $message = $request->get('message');
        $user_id = request()->user()->id;
        $post->message = $message;
        $post->ip = \Request::ip();
        $post->save();
        return response()->json($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $data = \BAKD\User::findOrFail($id);
        // return response()->json($data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // ...
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
        // ...
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // ...
    }
}
