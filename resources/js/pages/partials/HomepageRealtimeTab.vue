<template>
	<section class="homepage-realtime-tab">

		<!-- POST MESSAGE -->
		<bakd-post-message :user="user" />

		<!-- TODO: REALTIME MESSAGE WALL -->
		<template v-if="hasPosts">
			<div v-for="post in posts" :key="post.id">
			    <transition name="page" mode="out-in" appear>
				  <bakd-posted-message class="wow fadeIn" :user="post.user || {}" :post="post"/>
				</transition>
			</div>
  	    </template>

		<div class="button-wrapper has-text-centered" style="margin-bottom: 40px;">
		  <a class="button is-wide is-primary is-rounded is-medium wow fadeInUp" style="max-width: 220px;">
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
			isReady: false,
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

		fetchPosts: function () {
		    var self = this;
	        this.isLoading = true;
	        axios
		        .get('/api/posts', { limit: 20 })
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
		this.fetchPosts()
		this.$on('PostCreated', function (post) {
			axios.post('/api/posts', post)
		})

		// Ping the post list every 30 seconds for now to hackishly update the timestamps
		setInterval(function () {
			self.fetchPosts()
		}, 30000)

		this.$echo.channel('wall')
			.listen('.wall.post.created', function(e) {
				console.log(e);
				self.posts.unshift(Object.assign(e.post, { user: e.user }))
			})
	},
}
</script>