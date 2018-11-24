<?php

namespace BAKD\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Show all items available for this resource
     *
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $limit = request()->get('limit', 16);
        $offset = request()->get('offset', 0);
        $page = request()->get('page', 1);
        $order = request()->get('order', 'desc');
        $data = \BAKD\User::orderBy('id', $order)->paginate($limit);
        return response()->json($data);
    }

    /**
     * Show random list of users
     *
     * @return \Illuminate\Http\Response
     */
    public function random(Request $request)
    {
        $limit = request()->get('limit', 5);
        $data = \BAKD\User::inRandomOrder()->limit($limit)->get();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // ...
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // ...
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = \BAKD\User::findOrFail($id);
        $data = array_merge($data, ['organization' => [
            'id' => 1,
            'name' => 'Test Organization',
        ]]);
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function posts($id)
    {
        $data = \BAKD\Post::with('user')->where('user_id', $id)->orderBy('id', 'desc')->paginate(20);
        return response()->json($data);
    }

    /**
     * Return the currently logged in user.
     *
     */
    public function current()
    {
        return response()->json(array_merge(request()->user()->toArray(), ['organization' => [
            'id' => 1,
            'name' => 'Test Organization',
        ]]));
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
