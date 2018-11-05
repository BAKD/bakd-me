<template>
	<section>

		<bakd-page-header class="has-text-centered is-medium">
			 <h1 class="title is-white wow fadeInRight is-size-2">BAKD <span class="is-primary">Bounties</span></h1>
      		 <h2 class="hidden-mobile subtitle is-white is-size-5 wow fadeInLeft">Earn <span style="font-weight: 700;">BAKD</span> Coins for participating in bounties for a limited time only!</h2>
		</bakd-page-header>


		<div class="container">
			<div class="columns" style="margin: 40px 10px;">
				
				<div class="column is-12">

					<div v-for="n in 8" :key="n" style="margin-bottom: 20px;">

						<router-link :to="{ name: 'bounties.view', params: { id: 1 } }">
							<div class="box has-hover">
								<div class="level is-fullwidth">
									<div class="level-left" style="max-width: 120px; margin-right: 20px;">
										<img src="/images/bounties/twitter.png" style="height: auto; width: 100%; max-width: 100px;" /> 
									</div>
									<div class="level-content is-100 has-text-left is-v-centered control">
										<p class="title is-4 is-marginless">
											Translate the Onepager
											<span class="tag is-small is-green">
												ACTIVE
											</span>
										</p>
										<!-- <p class="subtitle is-marginless is-6">Translate the BAKD Onepager.</p> -->
										<p class="is-bold">
											STAKES BOUNTY
										</p>
									</div>
									<!-- <div class="level-content is-100 control is-v-centered">
										<p class="is-bold">
											Ends in 2 weeks...
										</p>
									</div> -->
									<div class="level-right is-v-centered is-end">
										<p class="is-bold">
											500,000 BAKD Coins
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

export default {
  layout: 'default',

  components: {
  	BakdPageHeader
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

<style>

</style>