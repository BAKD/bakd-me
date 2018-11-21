<template>
	<!-- START STAKES CARDS -->
	<div class="columns has-text-centered" v-if="isReady" v-waypoint="{ active: true, callback: onBountyClaimStatsWaypoint }">
		<div class="column is-one-third is-fullwidth-mobile">
			<div class="box is-v-centered">
				<h2 class="is-bold is-size-1">
					<span class="earned-odometer" :data-earned="stats.earned">-</span>
				</h2>
				<hr style="margin-top: 8px;" />
				<i class="la la-bitcoin is-size-5"/> <span class="is-bold">BAKD COINS EARNED</span>
			</div>
		</div>
		<div class="column is-one-third is-fullwidth-mobile">
			<div class="box is-v-centered">
				<h2 class="is-bold is-size-1">
					<span class="total-odometer" :data-total="stats.total">-</span>
				</h2>
				<hr style="margin-top: 8px;" />
				<i class="la la-users is-size-5"/> <span class="is-bold">STAKES COLLECTED</span>
			</div>
		</div>
		<div class="column is-one-third is-fullwidth-mobile">
			<div class="box is-v-centered">
				<h2 class="is-bold is-size-1">
					<span class="approved-odometer" :data-approved="stats.approved">-</span>
				</h2>
				<hr style="margin-top: 8px;" />
				<i class="la la-thumbs-up is-size-5"/> <span class="is-bold">CLAIMS APPROVED</span>
			</div>
		</div>
	</div>
	<!-- END STAKES STATS -->
</template>

<script>
import axios from 'axios'
import swal from 'sweetalert2'

export default {

	data() {
		return {
			isReady: false,
			isLoading: true,
			stats: []
		}
	},

	mounted() {
		this.fetchStats()
	},

	methods: {
		fetchStats: function () {
			var self = this;
			axios.get('/api/bounty/claims/stats')
				.then(function (response) {
					self.isLoading = false
					self.stats = response.data.data.stats
					self.isReady = true
				})
		},

		onBountyClaimStatsWaypoint ({ going, direction }) {
			// if (going === this.$waypointMap.GOING_IN) {
			    var $earnedOd = $('.earned-odometer');
			    var $stakesOd = $('.total-odometer');
			    var $approvedOd = $('.approved-odometer');

			    var earned = new Odometer({
			      el: $earnedOd.get(0),
			    });
			    
			    var stakes = new Odometer({
			      el: $stakesOd.get(0),
			    });

			    var approved = new Odometer({
			      el: $approvedOd.get(0),
			    });

			    // TODO: Fix these
			    earned.update($earnedOd.data('earned'))
			    stakes.update($stakesOd.data('total'))
			    approved.update($approvedOd.data('approved'))
		  	// }
		}
	},
}
</script>