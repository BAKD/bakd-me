<template>
	<nav class="panel has-shadow" v-show="hasClaims">
		<div class="panel-block is-size-4">
			<fa icon="list" class="is-size-6" />&nbsp;<span class="is-size-5 is-bold">My Claims</span>
		</div>
		<div class="panel-block">
		    <b-table
		    	class="is-fullwidth is-100"
		        :data="claimsData"
		        :opened-detailed="defaultOpenedId"
		        detailed
				hoverable				
		        detail-key="id">
				<template slot-scope="props">
		            <b-table-column field="id" label="ID" width="40" numeric sortable centered>
						{{ props.row.id }}
		            </b-table-column>
		            <b-table-column field="bounty.name" label="Bounty" sortable>
						{{ bounty.name }}
		            </b-table-column>
		            <b-table-column label="Reward" class="is-bold" centered>
		            	<template v-if="parseInt(props.row.confirmed, 10) === 1">
			            	{{ isStakesBounty ? props.row.stakes_received : bounty.reward }}<i v-if="!isStakesBounty" class="has-bakd-coins" /><span v-else>&nbsp;(Stakes)</span>
						</template>
						<template v-else>
			            	- <i class="has-bakd-coins" />
						</template>
		            </b-table-column>
		            <b-table-column field="bounty.bounty_reward_type.name" label="Reward Type" sortable centered>
		              {{ bounty.bounty_reward_type.name }}
		            </b-table-column>
		            <b-table-column field="created_at" label="Claimed" sortable centered>
		              {{ props.row.created_at | fromNow }}
		            </b-table-column>
		            <b-table-column field="confirmed" label="Claim Status" sortable centered>
						<span :class="'tag is-small ' + claimBadgeClass(props.row)">{{ claimStatus(props.row) }}</span>
		            </b-table-column>
		            <b-table-column label="Actions" centered>
		            	<template v-if="parseInt(props.row.confirmed, 10) === 0">
							<router-link :to="{ name: 'bounty.claim.edit', params: { id: bounty.id, claim_id: props.row.id } }">
								<i class="la la-edit" /> Edit
							</router-link>
							&nbsp;&nbsp;
							<a @click.prevent="cancelClaim($event, props.row.id, bounty.id)">
								<i class="la la-trash" /> Cancel
							</a>
		    			</template>
						
		            	<template v-if="parseInt(props.row.confirmed, 10) === 1">
							<router-link :to="{ name: 'bounty.claim.edit', params: { id: bounty.id, claim_id: props.row.id } }">
								<i class="la la-eye" /> View
							</router-link>
						</template>

		            	<template v-if="parseInt(props.row.confirmed, 10) === 2">
							<router-link :to="{ name: 'bounty.claim.edit', params: { id: bounty.id, claim_id: props.row.id } }">
								<i class="la la-cogs" /> Fix
							</router-link>
							&nbsp;&nbsp;
							<a @click.prevent="cancelClaim($event, props.row.id, bounty.id)">
								<i class="la la-trash" /> Cancel
							</a>
						</template>
		            </b-table-column>
		        </template>
		        <template slot="detail" slot-scope="props">
		            <article class="media">
		                <figure class="media-left">
		                    <p class="image is-64x64">
								<img :src="'/storage/' + bounty.image" style="max-width: 64px; width: 100%; height: auto;" />
		                    </p>
		                </figure>
		                <div class="media-content">
		                    <div class="content">
		                        <p>
		                            <strong>Claim Updates</strong>
		                            <small>
		                            	<!-- <i class="la la-clock-o"/>  -->
		                            	{{ props.row.updated_at | fromNow }}
		                            </small>
		                            <br>
									{{ props.row.reason || 'Check back soon for more information about your claim!' }}
		                        </p>
		                    </div>
		                </div>
		            </article>
		        </template>
		    </b-table>
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
			claims: {
				type: Array,
				required: true
			}
		},

		data() {
			return {
				claimsData: [],
				defaultOpenedId: [this.$props.claims[0].id]
			}
		},

		computed: {
			hasClaims: function () {
				return this.claimsData.length
			},

			reward: function () {
		      if (this.isStakesBounty) {
		        return this.$props.bounty.reward_total.toLocaleString()
		      }

		      return this.$props.bounty.reward.toLocaleString()
		    },

		    isStakesBounty: function () {
		    	if (this.$props.bounty.bounty_reward_type.name.toLowerCase() === 'stakes') {
		    		return true
		    	}

		    	return false;
		    }
		},

		mounted () {
			this.claimsData = this.$props.claims
			this.$watch('claims', claim => {
				this.refreshClaims(this.$route.params.id)
			}, {
				immediate: true
			})
		},

		methods: {
			cancelClaim: async function (event, claimId, bountyId) {
				var self = this;

				this.$dialog.confirm({
					title: 'Delete this Claim?',
					message: 'Are you sure you want to cancel this Bounty Claim? This action cannot be undone!',
					confirmText: 'Delete Claim',
					type: 'is-danger',
					hasIcon: true,
					onConfirm: () => this.handleClaimCancel(claimId, function (data) {
						self.$toast.open({ title: data.message, type: 'success' });
						self.refreshClaims(bountyId)
						// self.$router.push({ name: 'bounty.dashboard' })
					}, function (data) {
						self.$toast.open({ title: data.message, type: 'error' })	
					})
				})
			},

			handleClaimCancel: async function(claimId, success) {
				var self = this;
				try {
					var { data } = await axios.delete(`/api/bounty/claim/${claimId}/cancel?resource=${encodeURIComponent('Bounty Claim')}`,)
					if (data.status === 'error') {
						self.$toast.open({ title: err.message, type: 'is-danger' });
						return
					}
					success(data)
				} catch (err) {
					self.$toast.open({ title: err.message, type: 'is-danger' });
				}
			},

			refreshClaims: async function(bountyId) {
				var { data } = await axios.get(`/api/bounty/${bountyId}/claims`)
				if (data.status !== 'error') {
					this.claimsData = data.data.claims
				} else {
					this.$toast.open({ text: 'Error loading new claim data', type: 'error' })
				}
			},

			claimStatus: function (claim) {
				if (claim.confirmed === 0) {
					return 'PENDING'
				} else if (claim.confirmed === 1) {
					return 'APPROVED'
				} else if (claim.confirmed === 2) {
					return 'REJECTED'
				}
			},

			claimBadgeClass: function (claim) {
				if (claim.confirmed === 0) {
					return 'is-warning'
				} else if (claim.confirmed === 1) {
					return 'is-success'
				} else if (claim.confirmed === 2) {
					return 'is-danger'
				}	
			}
		}
	}
</script>