<?php

namespace BAKD\Http\Controllers\Member;

use Illuminate\Http\Request;

class BountyClaimController extends MemberController
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $view = [];
        $bountyId = $request->id;
        $view['bounty'] = \BAKD\Bounty::find($bountyId);
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully fetched bounty data.',
            'data' => $view
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bountyId = $request->id;
        $claimDescription = $request->input('description');

        $request->validate([
            'description' => 'bail|required|min:10|max:5000',
        ]);
        
        // TODO: Validation
        // $bounty = \BAKD\Bounty::findOrFail($bountyId);
        $bounty = \BAKD\Bounty::find($bountyId);
        $user = \Auth::user();

        // Check if user already has an approved claim
        // TODO: Do we want to allow multiple claims though? We may want to for stakes bounties...
        // Especially when we upgrade the variable reward system...
        // if (!\BAKD\BountyClaim::where('user_id', $user->id)->where('bounty_id', $bounty->id)->where('confirmed', '1')->get()->isEmpty()) {
        //     \MemberHelper::error('You already have a claim waiting to be processed!');
        //     return redirect()->route('member.bounty.home');
        // }

        // TODO: File attachments

        $bountyClaim = new \BAKD\BountyClaim;
        $bountyClaim->user_id = $user->id;
        $bountyClaim->bounty_id = $bountyId;
        $bountyClaim->description = $claimDescription;
        $bountyClaim->reason = ''; // Reset just in case this is a re-submission
        $bountyClaim->confirmed_by_id = $user->id;
        $bountyClaim->confirmed = 0; // Pending Status

        if ($bountyClaim->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'You successfully submitted a claim for this bounty!',
                'data' => $bountyClaim,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Unable to submit a claim for this bounty!',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $view = [];
        $view['claim'] = \BAKD\BountyClaim::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully fetched bounty claim data.',
            'data' => $view
        ]);
    }

    /**
     * Display the auth'd users bounty claim stats
     *
     * @return \Illuminate\Http\Response
     */
    public function stats()
    {
        $user = auth()->user();
        $view = [];
        $view['stats'] = [
            'earned' => $user->totalCoinsEarned(),
            'stakes' => $user->totalStakesEarned(),
            'claims' => $user->totalClaimsApproved(),
        ];

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully fetched users bounty claim statistics data.',
            'data' => $view
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pending()
    {
        $view = [];
        $view['claims'] = \BAKD\BountyClaim::with(['bounty', 'bounty.bountyRewardType'])->where('user_id', \Auth::user()->id)->where('confirmed', 0)->orderBy('id', 'DESC')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully fetched pending bounty claim data.',
            'data' => $view
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function approved()
    {
        $view = [];
        $view['claims'] = \BAKD\BountyClaim::with(['bounty', 'bounty.bountyRewardType'])->where('user_id', \Auth::user()->id)->where('confirmed', 1)->orderBy('id', 'DESC')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully fetched approved bounty claim data.',
            'data' => $view
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rejected()
    {
        $view = [];
        $view['claims'] = \BAKD\BountyClaim::with(['bounty', 'bounty.bountyRewardType'])->where('user_id', \Auth::user()->id)->where('confirmed', 2)->orderBy('id', 'DESC')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully fetched rejected bounty claim data.',
            'data' => $view
        ]);
    }

    /**
     * Display all claims for a single bounty
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bounty($id)
    {
        $view = [];
        $data['claims'] = \BAKD\BountyClaim::where('bounty_id', $id)->where('user_id', request()->user()->id)->orderBy('id', 'desc')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully fetched bounty claims.',
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $view = [];
        $view['claim'] = \BAKD\BountyClaim::findOrFail($id);
        $view['bounty'] = $view['claim']->bounty;
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully fetched bounty claim data.',
            'data' => $view
        ]);
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
        $rejectUpdated = false;
        $claimId = $request->id;
        $claimDescription = $request->input('description');
        
        $request->validate([
            'description' => 'bail|required|max:5000',
        ]);

        $bountyClaim = \BAKD\BountyClaim::findOrFail($claimId);
        $user = \Auth::user();

        // Check if user trying to edit claim, is the original creator of said claim
        if ($user->id !== $bountyClaim->user_id) {
            return response()->json([
                'status' => 'error',
                'errors' => [
                    'description' => [ 'You cannot edit a claim that does not belong to you.' ]
                ]
            ], 422);
        }

        // Check if this claim was already approved. We don't want to allow people to edit already approved claims.
        if ($bountyClaim->isApproved()) {
            return response()->json([
                'status' => 'error',
                'data' => $bountyClaim,
                'errors' => [
                    'description' => [ 'Your bounty claim was already approved.' ]
                ]
            ], 422);
        }

        // Set the new model values
        $bountyClaim->description = $claimDescription;
        $bountyClaim->confirmed_by_id = $user->id;
        // If updating a claim that was originally rejected, change it back to 0 to denote
        // a "Pending" status.
        if ($bountyClaim->isRejected()) {
            $rejectUpdated = true;
            $bountyClaim->confirmed = 0;
        }

        // Try to save/update the claim
        if ($bountyClaim->update()) {
            if ($rejectUpdated) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Your bounty claim was successfully updated and changed from Rejected to Pending status.',
                    'data' => $bountyClaim,
                ]);
            } else {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Your bounty claim was successfully updated and is currently Pending.',
                    'data' => $bountyClaim,
                ]);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'errors' => [
                    'description' => [ 
                        'There was an error saving your updated bounty to the database. Please try again or contact an administrator.'  
                    ]
                ]
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $claim = \BAKD\BountyClaim::findOrFail($id);
        $resourceTitle = $request->query('resource') ?: 'resource';

        if ($claim->user_id !== \Auth::user()->id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unable to delete items that do not belong to you. Please contact an administrator if the problem persists and you believe it is an error.',
            ]);
        }

        // Check if it exists, may have already been deleted, never existed, malicious, etc.
        if (!$claim) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unable to locate ' . ucwords($resourceTitle) . '.',
            ]);
        }

        // Try to delete the resource.
        if ($claim->delete()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully deleted this ' . ucwords($resourceTitle) . '.',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'The ' . ucwords($resourceTitle) . ' has already deleted or does not exist.',
            ]);
        }
    }
}
