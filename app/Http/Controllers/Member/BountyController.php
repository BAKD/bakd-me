<?php

namespace BAKD\Http\Controllers\Member;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BountyController extends MemberController
{
    /**
     * Display the member's bounty dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        // $view['allClaims'] = \BAKD\BountyClaim::where('user_id', \Auth::user()->id)->orderBy('id', 'DESC')->get();
        $view['approvedClaims'] = \BAKD\BountyClaim::where('user_id', \Auth::user()->id)->where('confirmed', 1)->orderBy('id', 'DESC')->get();
        $view['rejectedClaims'] = \BAKD\BountyClaim::where('user_id', \Auth::user()->id)->where('confirmed', 2)->orderBy('id', 'DESC')->get();
        $view['pendingClaims'] = \BAKD\BountyClaim::where('user_id', \Auth::user()->id)->where('confirmed', 0)->orderBy('id', 'DESC')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully fetched bounty data.',
            'data' => $view
        ]);
    }

    public function stats($id)
    {
        $bounty = \BAKD\Bounty::findOrFail($id);

        $data = [
            'my_stakes'         => $bounty->totalUserStakes($id),
            'total_stakes'      => $bounty->totalStakesDistributed($id),
            'pending_reward'    => $bounty->pendingStakeReward($id),
            'reward_percentage' => $bounty->pendingStakeRewardPercentage($id)
        ];

        return response()->json($data);
    }

    /**
     * Display the member's bounty dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function random()
    {
        $limit = request()->get('limit', 1);
        $data = \BAKD\Bounty::with('type', 'bountyRewardType')->limit($limit)->inRandomOrder()->get();
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bounty = \BAKD\Bounty::with('type', 'bountyRewardType')->findOrFail($id);

        $bountyClaims = [];
        if ($bounty && $bounty->claims()) {
            $bountyClaims = $bounty->claims()->where('user_id', \Auth::user()->id)->orderBy('id', 'desc')->get();
        }

        $data = [
            'bounty' => $bounty,
            'claims' => $bountyClaims
        ];

        return response()->json($data);
    }
}
