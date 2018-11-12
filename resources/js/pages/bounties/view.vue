<template>
	<section>
		<bakd-page-header class="has-text-centered is-small">
			<h1 class="title is-white wow fadeInRight is-size-2 wow zoomIn">Twitter <span class="is-primary">Bounty</span></h1>
		</bakd-page-header>
		<div class="container">

			<!-- BOUNTY INFO -->
			<div class="columns">
				<div class="column is-fullwidth">
					<nav style="width: 100%; margin-top: 40px;" class="panel has-shadow">
					    <div class="panel-heading wow fadeIn">
					      <div class="columns is-mobile is-v-centered level">
					        <div class="column is-6 is-half-mobile is-bold" style="white-space: nowrap;" v-if="isReady">
					          <fa icon="trophy" class="is-primary"/> &nbsp;{{ bounty.type.name }} Bounty
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
							<div class="column is-3 is-12-mobile is-margin-centered has-text-centered">
								<img :src="'/storage/' + bounty.image" style="max-width: 300px; width: 100%; padding: 15px;" class="image has-text-centered is-margin-centered" /> 
								<div class="addthis_inline_share_toolbox"></div>
							</div>
							<div class="column is-9 is-12-mobile has-text-centered-mobile" style="padding: 20px;">
								
								<!-- BOUNTY TITLE -->
								<p class="title is-size-3">
									{{ bounty.name }}
								</p>
								
								<!-- BOUNTY MAIN DESCRIPTION -->
								<p class="subtitle is-size-6" v-html="bounty.description"></p>

								<!-- BOUNTY TAGS -->
								<ul class="tags is-grouped field has-text-centered-mobile" style="display: block;">
									<li class="tag is-rounded is-medium is-grey">
										<span class="is-size-7">Blockchain</span>
									</li>
									<li class="tag is-rounded is-medium is-grey">
										<span class="is-size-7">Crypto</span>
									</li>
									<li class="tag is-rounded is-medium is-grey">
										<span class="is-size-7">P2P</span>
									</li>
									<li class="tag is-rounded is-medium is-grey">
										<span class="is-size-7">PoW</span>
									</li>
									<li class="tag is-rounded is-medium is-grey">
										<span class="is-size-7">Currency</span>
									</li>
								</ul>
							</div>
							
						</div>
					</div>
					<div class="panel-block">
						<div class="has-text-right is-100">
							<a class="button is-rounded is-medium is-wide is-primary is-normal" style="max-width: 140px; margin: 5px;">
								<span class="is-size-6">Claim</span>
						 	</a>
						</div>
					</div>
				</nav>
			  </div>
			</div>
			<!-- END BOUNTY INFO -->
				
			<bakd-bounty-stakes-stats :bounty="bounty" />
			
			<bakd-bounty-stats :bounty="bounty" :reward="reward" :is-ready="isReady" />

			<bakd-bounty-my-claims v-if="hasClaims" :claims="claims" :is-ready="isReady" />

			<bakd-bounty-reward-types/>
			
			<bakd-bounty-claim-instructions/>

			<br />

		</div>

		</div>
	</section>
</template>

<script>
import axios from 'axios'
import swal from 'sweetalert2'

import BakdPageHeader from '~/components/layout/BakdPageHeader'
import BakdMyAccountWidget from '~/widgets/BakdMyAccountWidget'

// Bounty Components
import BakdBountyStats from '~/components/bounty/BakdBountyStats'
import BakdBountyClaimInstructions from '~/components/bounty/BakdBountyClaimInstructions'
import BakdBountyRewardTypes from '~/components/bounty/BakdBountyRewardTypes'
import BakdBountyStakesStats from '~/components/bounty/BakdBountyStakesStats'
import BakdBountyMyClaims from '~/components/bounty/BakdBountyMyClaims'

export default {
  layout: 'default',
  middleware: 'auth',

  components: {
  	BakdPageHeader,
  	BakdMyAccountWidget,
  	BakdBountyStats,
  	BakdBountyClaimInstructions,
  	BakdBountyRewardTypes,
  	BakdBountyStakesStats,
  	BakdBountyMyClaims
  },

  mounted () {
  	new WOW().init()
  },
	
  metaInfo () {
    return { title: this.$t('View Bounty') }
  },

  data() {
    return {
      isReady: false,
      isLoading: true,
      hasClaims: false,
      bounty: {},
      claims: []
    }
  },

  computed: {
    reward: function () {
      if (this.isReady && this.bounty.bounty_reward_type.name.toLowerCase() === 'stakes') {
        return this.bounty.reward_total.toLocaleString()
      }

      return this.isReady ? this.bounty.reward.toLocaleString() : '-'
    }
  },

  methods: {
    fetchData: function () {
      var self = this;
      this.isLoading = true;
      axios
        .get('/api/bounty/' + self.$route.params.id)
        .then(function(response) { 
          console.log(response.data)
          self.bounty = response.data.bounty
          self.claims = response.data.claims

          if (self.claims.length !== 0) {
          	self.hasClaims = true
          }

          self.isLoading = false
          self.isReady = true
        })
    },
  },

  beforeMount () {
    this.fetchData()
  }
}
</script>

<style lang="scss" scoped">
  #random-bounty {
    transition: all .2s ease;
  }
</style>