<template>
	<nav class="panel has-shadow">
		<div class="panel-block is-size-4">
			<fa icon="list" class="is-size-6" />&nbsp;<span class="is-size-5 is-bold">Bounty Details</span>
		</div>
		<div class="panel-block">
		    <table class="table is-fullwidth is-size-7" v-if="isReady">
				<tr>
					<td style="width: 27.5%; text-align: right; padding: 10px;"><span class="is-uppercase is-bold">Total Reward Pool</span></td>
					<td class="has-text-centered">
						{{ reward }}<i class="has-bakd-coins" />
					</td>
				</tr>
				<tr>
					<td style="width: 27.5%; text-align: right; padding: 10px;"><span class="is-uppercase is-bold">Reward Type</span></td>
					<td class="has-text-centered">
						{{ bounty.bounty_reward_type.name }}
					</td>
				</tr>
				<tr>
					<td style="width: 27.5%; text-align: right; padding: 10px;"><span class="is-uppercase is-bold">Category</span></td>
					<td class="has-text-centered">
						{{ bounty.type.name }}
					</td>
				</tr>
				<tr>
					<td style="width: 27.5%; text-align: right; padding: 10px;"><span class="is-uppercase is-bold">Start Date</span></td>
					<td class="has-text-centered">
						{{ bounty.start_date | formatDate }}
					</td>
				</tr>
				<tr>
					<td style="border-bottom: none !important; width: 27.5%; text-align: right; padding: 10px;"><span class="is-uppercase is-bold">End Date</span></td>
					<td class="has-text-centered" style="border-bottom: none !important;">
						{{ bounty.end_date | formatDate }}
					</td>
				</tr>
			</table>
		</div>
	</nav>
</template>

<script>
	export default {
		props: {
			bounty: {
				type: Object,
				required: true
			},
			reward: {
				type: String,
				default: '0',
				required: false
			},
			isReady: {
				type: Boolean,
				required: true
			}
		}
	}
</script>