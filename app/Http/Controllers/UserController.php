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
        $user = request()->user();

        if (! $user) {
            $data = \BAKD\User::inRandomOrder()->limit($limit)->get();
        } else {
            // Get random users that are not the logged in user, and who are not 
            // already being followed by the logged in user
            $data = \BAKD\User::where('id', '!=', $user->id)
                ->whereNotExists(function ($query) use ($user) {
                    $query->select('*')
                    ->from('user_follower')
                    ->whereRaw('`user_follower`.`user_id` = `user`.`id`')
                    ->where('user_follower.follower_user_id', '=', $user->id);
                })->inRandomOrder()->limit($limit)->get();
        }

        return response()->json($data);
    }

    /**
     * Get dropdown list of possible user types
     *
     * @return \Illuminate\Http\Response
     */
    public function types(Request $request)
    {
        // TODO: Add these to database, create model, etc
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully fetched user types.',
            'data' => [
                [
                    'id' => 1,
                    'name' => 'INVESTOR',
                ],
                [ 
                    'id' => 2,
                    'name' => 'ADVISOR',
                ],
                [
                    'id' => 3,
                    'name' => 'MENTOR',
                ],
                [
                    'id' => 4,
                    'name' => 'DEVELOPER',
                ],
                [
                    'id' => 5,
                    'name' => 'MARKETER',
                ],
                [
                    'id' => 6,
                    'name' => 'DESIGNER',
                ],
                [
                    'id' => 7,
                    'name' => 'LAWYER',
                ],
                [
                    'id' => 8,
                    'name' => 'MANAGEMENT',
                ],
                [
                    'id' => 9,
                    'name' => 'SOCIAL_MEDIA',
                ],
                [
                    'id' => 10,
                    'name' => 'CUSTOMER_SUPPORT'
                ]
            ]
        ]);
    }


    // /**
    //  * Show featured list of users
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function featured(Request $request)
    // {
    //     $limit = request()->get('limit', 3);
    //     $user = request()->user();

    //     // Get featured users list that are not the logged in user, and who are not 
    //     // already being followed by the logged in user
    //     $data = \BAKD\User::where('id', '!=', $user->id)
    //         ->whereNotExists(function ($query) use ($user) {
    //             $query->select('*')
    //             ->from('user_follower')
    //             ->whereRaw('`user_follower`.`user_id` = `user`.`id`')
    //             ->where('user_follower.follower_user_id', '=', $user->id);
    //         })->inRandomOrder()->limit($limit)->get();

    //     return response()->json($data);
    // }


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
     * Get authd users followers
     *
     * @return \Illuminate\Http\Response
     */
    public function followers(Request $request, $usernameOrId = null)
    {
        $user = request()->user();

        $limit = request()->get('limit', 10);
        $offset = request()->get('offset', 0);
        
        // If we have a user id to work with, find the user,
        // otherwise just use the currently auth'd user
        if (! is_null($usernameOrId)) {
            $user = \BAKD\User::getUser($usernameOrId);
            // $user = \BAKD\User::find($usernameOrId);
        }

        if ($user) {
            $data = $user->getFollowers(false, $limit, $offset);

            return response()->json([
                'status' => 'success',
                'message' => 'Successfully fetched users followers.',
                'data' => $data
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Unable to find users followers.',
        ]);
    }

    /**
     * Get authd users follows
     *
     * @return \Illuminate\Http\Response
     */
    public function following(Request $request, $usernameOrId = null)
    {
        $user = request()->user();

        $limit = request()->get('limit', 10);
        $offset = request()->get('offset', 0);

        // If we have a user id to work with, find the user,
        // otherwise just use the currently auth'd user
        if (! is_null($usernameOrId)) {
            $user = \BAKD\User::getUser($usernameOrId);
            // $user = \BAKD\User::find($usernameOrId);
        }

        if ($user) {
            $data = $user->getFollowing(false, $limit, $offset);

            return response()->json([
                'status' => 'success',
                'message' => 'Successfully fetched users follows.',
                'data' => $data
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Unable to find users follows.',
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
        $isFollowing = false;

        $user = \BAKD\User::getUser($id);
        // $user = \BAKD\User::findOrFail($id);

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
     * Display posts specific to a user
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function posts($id)
    {
        $limit = request()->get('limit', 10);
        $offset = request()->get('offset', 0);
        $order = request()->get('order', 'desc');
        $data = \BAKD\Post::with('user')
            ->where('user_id', $id)
            ->orderBy('created_at', 'desc')
            ->skip($offset)
            ->take($limit)
            ->get();

        // $data = \BAKD\Post::with('user')->where('user_id', $id)->orderBy('id', 'desc')->paginate(20);
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
