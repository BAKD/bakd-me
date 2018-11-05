<template>
	<div>

		<bakd-page-header class="has-text-centered is-medium">
			 <h1 class="title is-white wow fadeInRight is-size-2">Campaign <span class="is-primary">Directory</span></h1>
      		 <h2 class="hidden-mobile subtitle is-white is-size-5 wow fadeInLeft">Find the perfect campaigns to join or contribute to</h2>
		</bakd-page-header>

		<bakd-campaign-searchbar/>

		<section class=" featured-section">
			<div class="container">
				<bakd-featured-project/>
			</div>
		</section>

		<section class="section campaign-directory" style="margin-top: -50px;">

			<!-- <bakd-section-title title="CAMPAIGNS DIRECTORY" subtitle="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio eligendi perspiciatis explicabo neque sint." /> -->

			<div class="container">
				<template v-for="n in 5">
					<router-link :to="{ name: 'campaigns.view', params: { id: 1 }}">
					  <bakd-project class="has-hover" />
					</router-link>
				</template>
				
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
			</div>

		</section>

	</div>
</template>

<script>

// Common
import BakdSectionTitle from '~/components/common/BakdSectionTitle'
import BakdFeaturedProject from '~/components/common/BakdFeaturedProject'
import BakdProject from '~/components/common/BakdProject'
import BakdCampaignSearchbar from '~/components/common/BakdCampaignSearchbar'

// Layout
import BakdPageHeader from '~/components/layout/BakdPageHeader'

export default {
  layout: 'default',  

  components: {
  	BakdSectionTitle,
  	BakdProject,
  	BakdFeaturedProject,
  	BakdPageHeader,
  	BakdCampaignSearchbar
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
    return { title: this.$t('Campaign Directory') }
  }
}
</script>
