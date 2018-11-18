<template>
	<div>

		<bakd-page-header class="has-text-centered is-medium">
			 <h1 class="title is-white wow fadeInRight is-size-2">Member <span class="is-primary">Directory</span></h1>
      		 <h2 class="hidden-mobile subtitle is-white is-size-5 wow fadeInLeft">Find team members for your next project or just meet new people</h2>
		</bakd-page-header>

		<bakd-member-searchbar/>

		<section class="featured-section">
			<div class="container">
				
				<div class="columns is-multiline">
				    <div class="column is-one-quarter" v-for="member in members">
				    	<bakd-member-card :member="member" />
				    </div> 
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
		            :per-page="perPage"
		            @change="fetchMembers($event)">
		        </b-pagination>

			</div>
		</section>

		<section class="section campaign-directory">

			<!-- <bakd-section-title title="CAMPAIGNS DIRECTORY" subtitle="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio eligendi perspiciatis explicabo neque sint." /> -->

		</section>

	</div>
</template>


<script>
import axios from 'axios'

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
			isReady: false,
			isLoading: true,
			members: [],
		    total: 0,
		    current: 1,
		    perPage: 16,
		    order: 'desc',
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
		this.fetchMembers()
	},

	methods: {
		fetchMembers: function (event, limit = 16) {
			var self = this;
			var page = event
			var order = this.order

			axios
				.post('/api/users', { limit, page, order })
				.then(function(response) { 
					self.members = response.data.data
					self.current = response.data.current_page
					self.perPage = limit
					self.total = response.data.total
					self.isLoading = false
					self.isReady = true
				})
			}
		},

		changePage: function (page) {
			self.fetchMembers(limit, page, offset)
		}
	}
</script>
