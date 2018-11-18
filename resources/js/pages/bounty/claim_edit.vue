<template>
  <panel :title="$t('claim_bounty')">
	Claim Bounty
  </panel>
</template>

<template>
	<section>
		<bakd-page-header class="has-text-centered is-small">
			<h1 class="title is-white wow fadeInRight is-size-2 wow zoomIn">Claim <span class="is-primary">Bounty</span></h1>
		</bakd-page-header>
		<div class="container">

			<!-- BOUNTY INFO -->
			<div class="columns">
				<div class="column is-fullwidth">
					<nav style="width: 100%; margin-top: 40px;" class="panel has-shadow">
						<form @submit.prevent="claimed" name="claim" class="control form" @keyup="form.onKeydown($event)">

						    <div class="panel-heading wow fadeIn">
						      <div class="columns is-mobile is-v-centered level">
						        <div class="column is-6 is-half-mobile is-bold" style="white-space: nowrap;" v-if="isReady">
						          <fa icon="trophy" class="is-primary"/> &nbsp;Claim Bounty #{{ bounty.id }} ({{ bounty.name }})
						        </div>
						        <div class="column is-6 is-half-mobile">
						          <div class="field is-grouped is-end project-stats-tags level-item">
									<div class="control is-small is-bold" v-if="isReady">
										{{ reward }}<i class="has-bakd-coins"/>
					            	</div>
						            <b-dropdown class="dropdown-trigger-icon" position="is-bottom-left" style="margin-top: 4px;">
						              <div class="icon is-v-centered" slot="trigger">
						                <i class="la la-ellipsis-v is-size-3"/>
						              </div>
						              <b-dropdown-item><fa icon="check"/> Claim</b-dropdown-item>
						              <b-dropdown-item><fa icon="bookmark"/> Bookmark</b-dropdown-item>
	              					  <b-dropdown-item separator />
						              <b-dropdown-item><fa icon="share"/> Share</b-dropdown-item>
						            </b-dropdown>
								</div>
							  </div>
							</div>
						</div>
					    <div class="panel-block">
							<div class="columns is-100 is-marginless is-fullwidth" v-if="isReady">
								<div class="column is-12">
									<blockquote class="message is-default" style="padding: 40px; border: 1px solid #cdcdcd;">
										<!-- BOUNTY TITLE -->
										<p class="title is-size-5">
											Bounty Description
										</p>
										<!-- BOUNTY MAIN DESCRIPTION -->
										<b-message>
											<p class="subtitle is-size-6" v-html="bounty.description"></p>
										</b-message>
									</blockquote>
						            <!-- Claim Submission -->
						            <bakd-input 
						              name="description" 
						              type="textarea" 
						              :placeholder="$t('Enter all information noted in the Bounty Description in order to receive credit for this claim!')"
						              :form="form"
						              v-model="form.description"
									  :rows="10"
						              :validate="'required'"
						               />
								</div>
							</div>
						</div>
						<div class="panel-block">
							<div class="has-text-right is-100">
								<button class="button is-rounded is-wide is-default is-medium" style="max-width: 140px; margin: 5px;">
									<span class="is-size-6">Cancel</span>
							 	</button>
							 	<v-button class="button is-rounded is-wide is-primary is-medium" :loading="form.busy" :disabled="form.errors.any() || errors.has()" style="max-width: 140px; margin: 5px;">
									<span class="is-size-6">Update Claim</span>
							 	</v-button>
							</div>
						</div>
					</form>
				</nav>
			  </div>
			</div>
			<!-- END BOUNTY INFO -->

			<bakd-bounty-my-claims v-if="hasClaims" :claims="claims" :bounty="bounty" />

			<bakd-bounty-reward-types/>
			
			<bakd-bounty-claim-instructions/>

			<br />

		</div>

		</div>
	</section>
</template>

<script>
// import swal from 'sweetalert2'
import Form from 'vform'
import BakdInput from '~/components/elements/BakdInput'
// import axios from 'axios'

import BakdPageHeader from '~/components/layout/BakdPageHeader'

// Bounty Components
import BakdBountyClaimInstructions from '~/components/bounty/BakdBountyClaimInstructions'
import BakdBountyRewardTypes from '~/components/bounty/BakdBountyRewardTypes'
import BakdBountyMyClaims from '~/components/bounty/BakdBountyMyClaims'

export default {
  layout: 'default',
  middleware: 'auth',

  components: {
  	BakdInput,
  	BakdPageHeader,
  	BakdBountyMyClaims,
  	BakdBountyClaimInstructions,
  	BakdBountyRewardTypes
  },

  data: () => ({
    form: new Form({
      description: ''
    }),
    isReady: false,
    isLoading: true,
    hasClaims: false,
    bounty: {},
    claims: []
  }),

  computed: {
    reward: function () {
      if (this.isReady && this.isStakesBounty) {
        return this.bounty.reward_total.toLocaleString()
      }

      return this.isReady ? this.bounty.reward.toLocaleString() : '-'
    },

    isStakesBounty: function () {
    	if (this.isReady && this.bounty.bounty_reward_type.name.toLowerCase() === 'stakes') {
    		return true
    	}

    	return false;
    }
  },

  methods: {
    fetchData: function () {
      var self = this;
      this.isLoading = true;
      this.form
        .get('/api/bounty/' + self.$route.params.id)
        .then(function(response) { 
          self.bounty = response.data.bounty
          self.claims = response.data.claims

          if (self.claims.length !== 0) {
          	self.hasClaims = true
          }

          self.isLoading = false
          self.isReady = true
        })

      this.form
        .get(`/api/bounty/claim/${self.$route.params.claim_id}`)
        .then(function(response) { 
          console.log(response.data.data.claim)
          self.claim = response.data.data.claim || {}
          self.form.description = response.data.data.claim.description
        })

    },
	
	async claimed () {
      try {
        const { data } = await this.form.patch(`/api/bounty/claim/${this.$route.params.claim_id}/edit`)

        if (data.status === 'error') {
        	helpers.alert({type: 'error', title: data.message })
        	return;
        }

        helpers.toast({type: 'success', title: data.message })
        this.$router.push({ name: 'bounty.dashboard' })

      } catch (err) {
        let errors   = err.response.data.errors,
            field    = Object.keys(errors)[0],
            messages = errors[field];

		helpers.alert({ type: 'error', title: messages[0] })
      }
    }
  },

  metaInfo () {
    return { title: this.$t('claim_bounty') }
  },

  mounted () {
  	new WOW().init()
    this.fetchData()
  }
}
</script>