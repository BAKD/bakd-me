<template>
	<nav class="panel has-shadow">
		<div class="panel-block is-size-4">
			<fa icon="list" class="is-size-6" />&nbsp;<span class="is-size-5 is-bold">Approved Claims</span>
		</div>
		<div class="panel-block">
		    <b-table
		    	class="is-fullwidth is-100"
		        :data="claims"
		        detailed
				hoverable				
		        detail-key="id">
		        <template slot="empty">
	                <section class="section">
	                    <div class="content has-text-grey has-text-centered">
	                        <p>
	                            <i class="la la-exclamation-triangle is-size-1 has-text-danger"></i>
	                        </p>
	                        <p>You have no approved bounty claims</p>
	                    </div>
	                </section>
	            </template>
				<template slot-scope="props">
		            <b-table-column field="id" label="ID" width="40" numeric sortable centered>
						{{ props.row.id }}
		            </b-table-column>
		            <b-table-column field="bounty.name" sortable label="Bounty">
						{{ props.row.bounty.name }}
		            </b-table-column>
		            <b-table-column :field="isStakesBounty(props.row.bounty) ? 'stakes_received' : 'bounty.reward'" label="Reward" class="is-bold" centered>
		            	<template v-if="parseInt(props.row.confirmed, 10) === 1">
			            	{{ reward(props.row, props.row.bounty) }}<i v-if="!isStakesBounty(props.row.bounty)" class="has-bakd-coins" /><span v-else>&nbsp;(Stakes)</span>
						</template>
						<template v-else>
			            	- <i class="has-bakd-coins" />
						</template>
		            </b-table-column>
		            <b-table-column field="bounty.bounty_reward_type.name" label="Reward Type" sortable centered>
		              {{ props.row.bounty.bounty_reward_type.name }}
		            </b-table-column>
		            <b-table-column field="updated_at" label="Updated" sortable centered>
		              {{ props.row.updated_at | fromNow }}
		            </b-table-column>
		            <b-table-column label="Claim Status" centered>
						<span :class="'tag is-small ' + claimBadgeClass(props.row)">{{ claimStatus(props.row) }}</span>
		            </b-table-column>
		            <b-table-column label="Actions" centered>
		            	<template v-if="parseInt(props.row.confirmed, 10) === 0">
							<router-link :to="{ name: 'bounty.claim.edit', params: { id: props.row.bounty.id, claim_id: props.row.id } }">
								<i class="la la-edit" /> Edit
							</router-link>
							&nbsp;&nbsp;
							<a @click.prevent="cancelClaim($event, props.row.id, props.row.bounty.id)">
								<i class="la la-trash" /> Cancel
							</a>
		    			</template>
						
		            	<template v-if="parseInt(props.row.confirmed, 10) === 1">
							<router-link :to="{ name: 'bounty.claim.edit', params: { id: props.row.bounty.id, claim_id: props.row.id } }">
								<i class="la la-eye" /> View
							</router-link>
						</template>

		            	<template v-if="parseInt(props.row.confirmed, 10) === 2">
							<router-link :to="{ name: 'bounty.claim.edit', params: { id: props.row.bounty.id, claim_id: props.row.id } }">
								<i class="la la-cogs" /> Fix
							</router-link>
							&nbsp;&nbsp;
							<a @click.prevent="cancelClaim($event, props.row.id, props.row.bounty.id)">
								<i class="la la-trash" /> Cancel
							</a>
						</template>
		            </b-table-column>
		        </template>
		        <template slot="detail" slot-scope="props">
		            <article class="media">
		                <figure class="media-left">
		                    <p class="image is-64x64">
								<img :src="'/storage/' + props.row.bounty.image" style="max-width: 64px; width: 100%; height: auto;" />
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
		data() {
			return {
				isLoading: true,
				claims: [],
				defaultOpenedId: []
			}
		},

		computed: {
			hasClaims: function () {
				return this.claimsData.length
			},
		},

		mounted () {
			this.fetchClaims()
		},

		methods: {

			reward: function (claim, bounty) {
		      if (this.isStakesBounty(bounty)) {
		        return claim.stakes_received.toLocaleString()
		      }

		      return bounty.reward.toLocaleString()
		    },

		    isStakesBounty: function (bounty) {
		    	if (bounty.bounty_reward_type.name.toLowerCase() === 'stakes') {
		    		return true
		    	}

		    	return false;
		    },

			cancelClaim: async function (event, claimId) {
				var self = this;

				this.$dialog.confirm({
					title: 'Delete this Claim?',
					message: 'Are you sure you want to cancel this Bounty Claim? This action cannot be undone!',
					confirmText: 'Delete Claim',
					type: 'is-danger',
					hasIcon: true,
					onConfirm: () => this.handleClaimCancel(claimId, function (data) {
						self.$toast.open({ title: data.message, type: 'success' });
						self.fetchClaims()
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

			fetchClaims: async function(bountyId) {
				var { data } = await axios.get(`/api/bounty/claims/approved`)
				if (data.status !== 'error') {
					this.claims = data.data.claims
				} else {
					this.$toast.open({ text: 'Error loading approved claim data', type: 'error' })
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