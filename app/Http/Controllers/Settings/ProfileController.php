<?php

namespace BAKD\Http\Controllers\Settings;

use Illuminate\Http\Request;
use BAKD\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:user,email,' . $user->id,
            'title' => 'max:255',
            'bio' => 'max:300',
            'wallet' => 'max: 255',
            'website' => 'url',
            'username' => 'max:18|regex:/^[a-zA-Z]/i|required|alpha_num|unique:user,username,' . $user->id,
        ]);

        $data = tap($user)->update($request->only('name', 'email', 'title', 'bio', 'wallet', 'website', 'username'));
        
        return response()->json([
            'status' => 'success',
            'message' => 'You successfully updated your profile details',
            'data' => $data
        ]); 
    }
}
