<template>
	<nav class="panel has-shadow">
		<div class="panel-block is-size-4">
			<i class="la la-question-circle is-size-5" />&nbsp;<span class="is-size-5 is-bold">Reward Types</span>
		</div>
		<div class="panel-block" style="padding: 35px;">
			<ul class="reward-types" style="margin-top: 0px; padding-top: 0px;">
            <li>
                <div><i class="fa fa-chevron-right"></i> <strong>Fixed Coin Reward (e.g. Signature Bounty)</strong></div>
                <p style="padding-top: 5px; margin-bottom: 20px;">
                    If you participate in these kind of bounties you will receive a fixed amount of BAKD Coins as your reward. In order to receive your BAKD Coins, your claim must be completed and approved before that particular bounty's reward supply is exceeded.
                </p>
            </li>
            <li>
                <div><i class="fa fa-chevron-right"></i> <strong>Stakes (e.g. Article Bounty)</strong></div>
                <p style="padding-top: 5px;">
                    If you participate in these kind of bounties you will receive what are called "stakes" upon completing a bounty. These stakes represent a dynamic share in the prize pool of coins for a particular bounty. While the end reward will be paid in BAKD Coins, it ultimately depends on the following factors:
                    <ul style="font-size: 14px; margin: 20px;">
                        <li style="padding: 10px;">
                            1.) The total number of stakes you accumulate for a particular bounty.
                        </li>
                        <li style="padding: 10px;">
                            2.) The total number of stakes accumulated for a particular bounty, by all members involved.
                        </li>
                        <li style="padding: 10px;">
                            3.) The size of the BAKD Coins Prize Pool for a particular bounty.
                        </li>
                    </ul>
                    <p>
                        Example: You have 5 stakes of a specific bounty, at the end of the bounty there are a total of 100 stakes distributed, you then receive 5% of the <strong>total</strong> reward pool for this specific bounty!
                    </p>
                    <div class="has-text-centered" style="padding: 20px; font-size: 14px; font-style: italic;">
                        (Your Total Bounty Shares Accumulated / The Total Overall Shares Distributed) * The Total Reward Pool
                    </div>
                </p>
            </li>
        </ul>
        </div>
	</nav>
</template>