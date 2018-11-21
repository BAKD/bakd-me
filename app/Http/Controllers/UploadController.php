<?php

namespace BAKD\Http\Controllers;

use Illuminate\Http\Request;
use BAKD\Http\Controllers\Controller;

class UploadController extends Controller
{

	const UPLOAD_DIR = '/uploads';

    /**
     * Handle user profile avatar uploads.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function avatar(Request $request)
    {
		if (request()->hasFile('avatar') && request()->file('avatar')->isValid()) {
			$user = request()->user();

			request()->validate([
				'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			]);

			// Handle file
			$filename = time() . '.' . request()->avatar->getClientOriginalExtension();
			$uploadPath = self::UPLOAD_DIR . '/avatars/' . $user->id;
			$fullPath = request()->avatar->move(public_path($uploadPath), $filename);

			// Update user
			$user->avatar_url = $uploadPath . '/' . $filename;
			$user->save();

			return response()->json([
				'status' => 'success',
				'message' => 'User avatar successfully uploaded and saved.',
				'data' => $filename
			]);
		} else {
			return response()->json([
				'status' => 'error',
				'message' => 'Unable to upload avatar. Please try again.'
			], 422);
		}
    }

    /**
     * Handle user profile cover photo uploads.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function cover(Request $request)
    {
		if (request()->hasFile('cover') && request()->file('cover')->isValid()) {
			$user = request()->user();

			request()->validate([
				'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			]);

			// Handle file
			$filename = time() . '.' . request()->cover->getClientOriginalExtension();
			$uploadPath = self::UPLOAD_DIR . '/covers/' . $user->id;
			$fullPath = request()->cover->move(public_path($uploadPath), $filename);

			// Update user
			$user->cover_url = $uploadPath . '/' . $filename;
			$user->save();

			return response()->json([
				'status' => 'success',
				'message' => 'User cover successfully uploaded and saved.',
				'data' => $filename
			]);
		} else {
			return response()->json([
				'status' => 'error',
				'message' => 'Unable to upload cover. Please try again.'
			], 422);
		}
    }
}