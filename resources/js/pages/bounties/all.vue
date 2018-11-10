<template>
	<section>

		<bakd-page-header class="has-text-centered is-medium">
			 <h1 class="title is-white wow fadeInRight is-size-2">BAKD <span class="is-primary">Bounties</span></h1>
      		 <h2 class="hidden-mobile subtitle is-white is-size-5 wow fadeInLeft">Earn <span style="font-weight: 700;">BAKD</span> Coins for participating in bounties for a limited time only!</h2>
		</bakd-page-header>

		<bakd-bounties-search-bar/>

		<div class="container">
			<div class="columns" style="margin: 40px 10px;">
				
				<div class="column is-3">
					<aside class="menu">
				      <p class="menu-label">
						Navigation
				      </p>
				      <ul class="menu-list">
				        <li>
				        	<a class="is-active">
				                Active Bounties <span class="is-pulled-right"><span class="tag is-rounded is-bold is-grey">0</span></span>
	  				        </a>
				        </li>
				        <li>
			              <a>
			              	Upcoming Bounties
			              	<span class="is-pulled-right"><span class="tag is-rounded is-bold is-grey">0</span></span>
			              </a>
				        </li>
				        <li>
			              <a>
			              	Completed Bounties
			              	<span class="is-pulled-right"><span class="tag is-rounded is-bold is-grey">0</span></span>
			              </a>
				        </li>
			        </ul>
			        <p class="menu-label">
						Quick Links
		        	</p>
			        <ul class="menu-list">
				        <li>
				        	<a>
				        		Bounty Dashboard
			        		</a>
		        		</li>
				        <li>
				        	<a>
				        		Request A Bounty
			        		</a>
		        		</li>
				        <li>
				        	<a>
								Report A Problem
			        		</a>
		        		</li>
				      </ul>
				      <p class="menu-label">
						Help
			      	  </p>
				      <ul class="menu-list">
				        <li>
				        	<a>
								Reward Types
			        		</a>
		        		</li>
				        <li>
				        	<a>
								Claim Instructions
			        		</a>
		        		</li>
				      </ul>
				    </aside>
				</div>

				<div class="column is-9">

					<div v-for="n in 5" :key="n" style="margin-bottom: 20px;">

						<router-link :to="{ name: 'bounties.view', params: { id: 1 } }" class="bounty-card">
							<div class="box has-hover">
								<div class="level is-fullwidth">
									<div class="level-item is-margin-centered" style="max-width: 120px;">
										<img src="/images/bounties/twitter.png" style="height: auto; width: 100%; max-width: 100px;" /> 
									</div>
									<div class="level-content is-100 has-text-left has-text-centered-mobile is-v-centered control bounty-card-info" style="padding: 0 20px;">
										<p class="title is-4 is-marginless">
											Translate the Onepager
											<span class="tag is-small is-green">
												ACTIVE
											</span>
										</p>
										<p class="subtitle is-marginless is-6">Thursday, June 12th, 2018</p>
									</div>
									<!-- <div class="level-content is-100 control is-v-centered">
										<p class="is-bold">
											Ends in 2 weeks...
										</p>
									</div> -->
									<div class="level-right is-v-centered has-text-centered" style="display: block;">
										<p class="is-bold">
											<span class="is-size-2">500,000<i class="is-bakd-coins is-3x" /></span>
										</p>
										<p class="is-bold" style="display: block;">
											STAKES BOUNTY
										</p>
									</div>
								</div>
							</div>
						</router-link>

					</div>

					<br />

			        <b-pagination
			        	class="is-centered"
			            :total="total"
			            :current.sync="current"
			            :order="order"
			            :size="size"
			            :simple="isSimple"
			            :rounded="isRounded"
			            :per-page="perPage">
			        </b-pagination>

			        <br />

				</div>
				
			</div>

		</div>

	</section>
</template>

<script>
import BakdPageHeader from '~/components/layout/BakdPageHeader'
import BakdBountiesSearchBar from '~/components/common/BakdBountiesSearchBar'

export default {
  layout: 'default',

  components: {
  	BakdPageHeader,
  	BakdBountiesSearchBar
  },

  data() {
	return {
	    total: 200,
	    current: 1,
	    perPage: 20,
	    order: '',
	    size: 'is-medium',
	    isSimple: false,
	    isRounded: false
	}
  },
	
  metaInfo () {
    return { title: this.$t('All Bounties') }
  }
}
</script>

<style lang="scss" scoped>
.bounty-card-info {

	@media (max-width: 768px) {
		margin: 0 auto;
		text-align: center;
	}

}

</style>