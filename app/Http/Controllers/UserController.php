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
     * Auth'd user follow
     *
     * @return \Illuminate\Http\Response
     */
    public function follow(Request $request)
    {
        $user = request()->user();
        $followId = request()->get('follow_id');

        // Check if user id maps to a valid user
        $followUser = \BAKD\User::find($followId);

        if (!$followUser) {
            return response()->json([
                'status' => 'error',
                'message' => 'User does not exist!'
            ]);
        }

        if ($user->isFollowing($followId)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Already following ' . $followUser->name
            ]);
        }

        // TODO: Add check for if user is blocked/etc

        // TODO: Broadcast pusher event

        // TODO: Log action

        // TODO: Add notification

        $user->follow($followId);
        $user->increaseFollowingCount();
        $followUser->increaseFollowerCount();
        
        return response()->json([
            'status' => 'success',
            'message' => 'You\'ve successfully followed ' . $followUser->name,
            'data' => [
                'followers' => $followUser->follower_count,
                'following' => $followUser->following_count
            ]
        ]);
    }


    /**
     * Auth'd user unfollow
     *
     * @return \Illuminate\Http\Response
     */
    public function unfollow(Request $request)
    {
        $user = request()->user();
        $unfollowId = request()->get('unfollow_id');

        // Check if user id maps to a valid user
        $unfollowUser = \BAKD\User::find($unfollowId);

        if (!$unfollowUser) {
            return response()->json([
                'status' => 'error',
                'message' => 'User does not exist!'
            ]);
        }

        if (! $user->isFollowing($unfollowId)) {
            return response()->json([
                'status' => 'error',
                'message' => 'You aren\'t following ' . $unfollowUser->name
            ]);
        }

        $user->unfollow($unfollowId);
        $user->decreaseFollowingCount();
        $unfollowUser->decreaseFollowerCount();

        // TODO: Broadcast pusher event

        // TODO: Log action

        // TODO: Add notification

        return response()->json([
            'status' => 'success',
            'message' => 'You\'ve successfully unfollowed ' . $unfollowUser->name,
            'data' => [
                'followers' => $unfollowUser->follower_count,
                'following' => $unfollowUser->following_count
            ]
        ]);
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
        $authdUser = request()->user();
        $user = \BAKD\User::findOrFail($id);
        $isFollowing = false;

        if ($authdUser->id !== $user->id) {
            $isFollowing = $authdUser->isFollowing($user->id);
        }

        $payload = array_merge($user, [
            'isFollowing' => $isfollowing,
            'organization' => [
                'id' => 1,
                'name' => 'Test Organization',
            ]
        ]);

        return response()->json($payload);
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
