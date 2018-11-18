<template>
	<!-- START STAKES CARDS -->
	<div class="columns has-text-centered" v-if="isReady" v-waypoint="{ active: true, callback: onBountyViewStatsWaypoint }">
		<div class="column is-one-quarter">
			<div class="box is-v-centered">
				<h2 class="is-bold is-size-1">
					<span class="my-stakes-odometer" :data-my-stakes="stats.my_stakes" v-text="stats.my_stakes"></span>
				</h2>
				<hr style="margin-top: 8px;" />
				<i class="la la-user is-size-5"/> <span class="is-bold">MY STAKES</span> <b-tooltip multilined label="The amount of stakes you have been awarded for this bounty only. You may claim stake bounties multiple times." type="is-dark"><i class="la la-question-circle has-text-danger is-size-5"/></b-tooltip>
			</div>
		</div>
		<div class="column is-one-quarter">
			<div class="box is-v-centered">
				<h2 class="is-bold is-size-1">
					<span class="distributed-stakes-odometer" :data-distributed-stakes="stats.total_stakes" v-text="stats.total_stakes"></span>
				</h2>
				<hr style="margin-top: 8px;" />
				<i class="la la-users is-size-5"/> <span class="is-bold">DISTRIBUTED STAKES</span> <b-tooltip multilined label="Total amount of stakes distributed to all members who participated in this bounty." type="is-dark"><i class="la la-question-circle has-text-danger is-size-5"/></b-tooltip>
			</div>
		</div>
		<div class="column is-one-quarter">
			<div class="box is-v-centered">
				<h2 class="is-bold is-size-1">
					<span class="pending-reward-odometer" :data-pending-reward="stats.pending_reward" v-text="stats.pending_reward"></span>
				</h2>
				<hr style="margin-top: 8px;" />
				<i class="la la-trophy is-size-5"/> <span class="is-bold">PENDING REWARD</span> <b-tooltip multilined label="Rewards for Stake Bounty's are not awarded until the bounty itself is over. This value may go up and down depending on the number of stakes you accumulate, as well as the number of overall stakes distributed." type="is-dark"><i class="la la-question-circle has-text-danger is-size-5"/></b-tooltip>
			</div>
		</div>
		<div class="column is-one-quarter">
			<div class="box is-v-centered">
				<h2 class="is-bold is-size-1">
					<span class="prize-share-odometer" :data-prize-share="stats.reward_percentage" v-text="stats.reward_percentage"></span>%
				</h2>
				<hr style="margin-top: 8px;" />
				<i class="la la-pie-chart is-size-5"/> <span class="is-bold">PRIZE POOL SHARE</span> <b-tooltip multilined label="The percentage of the total prize pool that you are currently entitled to if the bounty were to end right now." type="is-dark"><i class="la la-question-circle has-text-danger is-size-5"/></b-tooltip>
			</div>
		</div>
	</div>
	<!-- END STAKES STATS -->
</template>

<script>
import axios from 'axios'
import swal from 'sweetalert2'

export default {

	props: {
		bounty: {
			type: Object,
			required: true
		}
	},

	data() {
		return {
			bounty_id: 0,
			isReady: false,
			isLoading: true,
			stats: []
		}
	},

	mounted() {
		this.bounty_id = this.$route.params.id
		this.fetchStats()
	},

	methods: {
		fetchStats: function () {
			var self = this;
			axios.get('/api/bounty/' + self.bounty_id + '/stats')
				.then(function (response) {
					console.log(response)
					self.isLoading = false
					self.stats = response.data
					self.isReady = true
				})
		},

		onBountyViewStatsWaypoint ({ going, direction }) {
			if (going === this.$waypointMap.GOING_IN) {
			    var $myStakesOdometer = $('.my-stakes-odometer');
			    var $distributedStakesOdometer = $('.distributed-stakes-odometer');
			    var $pendingRewardOdometer = $('.pending-reward-odometer');
			    var $prizeShareOdometer = $('.prize-share-odometer');

			    var myStakesOd = new Odometer({
			      el: $myStakesOdometer.get(0),
			    });
			    
			    var distributedStakesOd = new Odometer({
			      el: $distributedStakesOdometer.get(0),
			    });

			    var pendingRewardOd = new Odometer({
			      el: $pendingRewardOdometer.get(0),
			    });

			    var prizeShareOd = new Odometer({
			      el: $prizeShareOdometer.get(0),
			    });

			    // TODO: Fix these
			    myStakesOd.update($myStakesOdometer.data('my-stakes'))
			    distributedStakesOd.update($distributedStakesOdometer.data('distributed-stakes'))
			    pendingRewardOd.update($pendingRewardOdometer.data('pending-reward'))
			    prizeShareOd.update($prizeShareOdometer.data('prize-share'))
		  	}
		}
	},
}
</script>