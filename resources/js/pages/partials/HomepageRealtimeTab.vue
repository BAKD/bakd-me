<template>
	<section class="homepage-realtime-tab">

		<!-- POST MESSAGE -->
		<bakd-post-message :user="user" />

		<!-- TODO: REALTIME MESSAGE WALL -->
		<template v-if="hasPosts">
			<div v-for="(post, index) in posts" :key="index">
			    <transition name="page" mode="out-in" appear>
				  <bakd-posted-message class="wow fadeIn" :user="post.user || {}" :post="post"/>
				</transition>
			</div>
  	    </template>

		<div class="button-wrapper has-text-centered" style="margin-bottom: 40px;">
		  <a :class="{ 'is-loading': isLoading }" @click.prevet="loadMorePosts" class="button is-wide is-primary is-rounded is-medium wow fadeInUp" style="max-width: 220px;">
		    <span class="is-size-6"><i class="la la-refresh" /> Load More...</span>
		  </a>
		</div>

	</section>
</template>

<script>
import axios from 'axios'
import { mapGetters } from 'vuex'

import BakdPostMessage from '~/components/common/BakdPostMessage'
import BakdPostedMessage from '~/components/common/BakdPostedMessage'

export default {
	name: 'HomepageRealtimeTab',

	components: {
		BakdPostMessage,
		BakdPostedMessage
	},

	data () {
		return {
			posts: [],
			isLoading: true,
			isReady: false,
			refresh: {
				interval: {},
				timer: 60000 // 60 seconds
			}
		}
	},

	computed: {
		hasPosts: function () {
			return this.isReady && this.posts.length
		},

		...mapGetters({
			user: 'auth/user',
		}),
	},

	methods: {

		fetchPosts: function (limit = 6, offset = 0, initialFetch = false) {
		    var self = this;
	        
	        this.isLoading = true;

	        axios
		        .get(`/api/posts?limit=${limit}&offset=${offset}`)
		        .then(function(response) {
					if (initialFetch === true) {
						self.posts = response.data
					} else {
						self.posts = [...self.posts, ...response.data];
					}

					self.isLoading = false;
					self.isReady = true
		        })
		        .catch(function(err) {
		        	console.log(err)
		        })
		},

		loadMorePosts: async function () {
			var offset = this.posts.length
			var newPosts = await this.fetchPosts(6, offset);
		},

		// Ping the exsiting post list to update any stats or timestamps until
		// the realtime/socket logic is implemented
		updatePosts: async function () {
			var self = this;
			var postIds = this.posts.map((el) => { return el.id })
	        
			// console.log(postIds)

	        this.isLoading = true;

	        axios
		        .post('/api/posts/ping', { ids: postIds })
		        .then(function(response) {
					self.posts = response.data
					self.isLoading = false;
					self.isReady = true
		        })
		        .catch(function(err) {
		        	console.log(err)
		        })
		},
	},

	mounted () {
		var self = this;
		
		// Grab 6 posts, offset 0, set the posts data attr as well
		this.fetchPosts(6, 0, true)

		this.$on('PostCreated', function (post) {
			axios.post('/api/posts', post)
		})

		// Ping the post list every X seconds for now to hackishly update the timestamps
		this.refresh.interval = setInterval(this.updatePosts, this.refresh.timer)

		this.$echo.channel('wall')
			.listen('.wall.post.created', function(e) {
				console.log(e);
				self.posts.unshift(Object.assign(e.post, { user: e.user }))
			})
	},

	destroyed () {
		console.log('Clearing posts refresh interval.')
		clearInterval(this.refresh.interval)
	},
}
</script>

<style lang="scss" scoped>

</style>