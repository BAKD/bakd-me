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
					        <div class="column is-6 is-half-mobile is-bold" style="white-space: nowrap;">
					          <fa icon="trophy" class="is-primary"/> &nbsp;Social Bounty
					        </div>
					        <div class="column is-6 is-half-mobile">
					          <div class="field is-grouped is-end project-stats-tags level-item">
								<div class="control is-small">
				              		<span class="tag is-success is-bold is-small">ACTIVE</span>
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
						<div class="columns is-100 is-marginless is-fullwidth">
							<div class="column is-3 is-12-mobile is-margin-centered has-text-centered">
								<img src="/images/bounties/twitter.png" style="max-width: 300px; width: 100%; padding: 15px;" class="image has-text-centered is-margin-centered" /> 
								<div class="addthis_inline_share_toolbox"></div>
							</div>
							<div class="column is-9 is-12-mobile has-text-centered-mobile" style="padding: 20px;">
								
								<!-- BOUNTY TITLE -->
								<p class="title is-size-3">
									Bounty Name
								</p>
								
								<!-- BOUNTY MAIN DESCRIPTION -->
								<p class="subtitle is-size-6">
									Bounty information subtitle goes here
								</p>

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
				
				<bakd-bounty-stakes-stats/>
				
				<bakd-bounty-stats/>

				<bakd-bounty-reward-types/>
				
				<bakd-bounty-claim-instructions/>

				<br />

			</div>

		</div>
	</section>
</template>

<script>
import BakdPageHeader from '~/components/layout/BakdPageHeader'
import BakdMyAccountWidget from '~/widgets/BakdMyAccountWidget'

// Bounty Components
import BakdBountyStats from '~/components/bounty/BakdBountyStats'
import BakdBountyClaimInstructions from '~/components/bounty/BakdBountyClaimInstructions'
import BakdBountyRewardTypes from '~/components/bounty/BakdBountyRewardTypes'
import BakdBountyStakesStats from '~/components/bounty/BakdBountyStakesStats'

export default {
  layout: 'default',

  components: {
  	BakdPageHeader,
  	BakdMyAccountWidget,
  	BakdBountyStats,
  	BakdBountyClaimInstructions,
  	BakdBountyRewardTypes,
  	BakdBountyStakesStats
  },

  mounted () {
  	new WOW().init()
  },
	
  metaInfo () {
    return { title: this.$t('View Bounty') }
  }
}
</script>