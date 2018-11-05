<template>
	<div>

		<bakd-page-header class="has-text-centered is-medium">
			 <h1 class="title is-white wow fadeInRight is-size-2">Member <span class="is-primary">Directory</span></h1>
      		 <h2 class="hidden-mobile subtitle is-white is-size-5 wow fadeInLeft">Find team members for your next project or just meet new people</h2>
		</bakd-page-header>

		<bakd-member-searchbar/>

		<section class="featured-section">
			<div class="container">

				<template v-for="n in 3">
					<div class="columns">
						<template v-for="n in 4">
							<div class="column is-one-quarter">
								<bakd-member-card/>
							</div>
						</template>
					</div>
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

		<section class="section campaign-directory">

			<!-- <bakd-section-title title="CAMPAIGNS DIRECTORY" subtitle="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio eligendi perspiciatis explicabo neque sint." /> -->

		</section>

	</div>
</template>


<script>

// Common
import BakdSectionTitle from '~/components/common/BakdSectionTitle'
import BakdFeaturedProject from '~/components/common/BakdFeaturedProject'
import BakdMemberSearchbar from '~/components/common/BakdMemberSearchbar'
import BakdMemberCard from '~/components/common/BakdMemberCard'

// Layout
import BakdPageHeader from '~/components/layout/BakdPageHeader'

export default {
  layout: 'default',  

  components: {
  	BakdSectionTitle,
  	BakdFeaturedProject,
  	BakdPageHeader,
  	BakdMemberSearchbar,
  	BakdMemberCard
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
    return { title: this.$t('Members Directory') }
  },

  mounted () {
	new WOW().init()  	
  }

}
</script>
