<template>
	<section>

		<bakd-cover-upload :user="member" />

		<div class="container profile-container">

			<div class="columns member-avatar">
				
				<div class="column is-9">

					<br />

					<b-tabs v-model="activeTab">
					
			            <b-tab-item label="Realtime" icon="comment">
							
							<template v-for="post in posts">
								<bakd-posted-message :post="post" :key="post.id" />
							</template>

			            </b-tab-item>

			            <b-tab-item label="Followers" icon="account">
			                You have no followers
			            </b-tab-item>

			            <b-tab-item label="Following" icon="account-plus">
			                You aren't following anyone yet
			            </b-tab-item>

			            <b-tab-item label="Campaigns" icon="chart-bar">
			                You have no campaigns
			            </b-tab-item>

		        	</b-tabs>

				</div> <!-- .is-9 -->

				<div class="column is-3">
					
					<div class="box" style="margin-top: 0px;">

						<!-- Member Avatar Upload -->
						<bakd-avatar-upload :user="member" style="margin-top: -120px;" />

						<div class="has-text-centered">
							<h2 v-text="member.name" class="is-size-3 is-dark" />
							<b-taglist attached style="justify-content: center;">
								<b-tag type="is-dark"><i class="fa fa-ban"></i></b-tag>
								<b-tag type="is-danger">UNVERIFIED</b-tag>
							</b-taglist>
						</div>

						<div class="columns" style="padding: 30px 10px 10px;">
							<div class="column is-6 has-text-centered">
								<p class="title is-size-3">
									{{ member.follower_count }}
								</p>
								<p class="subtitle is-size-6 has-text-grey-light">
									Followers
								</p>
							</div>
							<div class="column is-6 has-text-centered">
								<p class="title is-size-3">
									{{ member.following_count }}
								</p>
								<p class="subtitle is-size-6 has-text-grey-light">
									Following
								</p>
							</div>
						</div>

						<p class="has-text-left">
							<h3 v-text="member.title || 'Add a title'" class="is-size-5 is-title is-dark" />
							<h4 v-text="member.bio || 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio saepe iure quaerat veniam accusantium ipsum blanditiis odit et, laborum, neque quas, veritatis recusandae quibusdam quia? Cupiditate nemo voluptates in quaerat!'" class="is-size-6 is-subtitle is-dark" />
						</p>

						<br />

						<button class="is-fluid button is-rounded is-medium is-wide is-primary is-margin-centered" style="margin-bottom: 8px;">
							<span class="is-size-6"><i class="la la-plus-circle"></i>&nbsp;Follow</span>
						</button>
						<button class="button is-fluid is-rounded is-medium is-wide is-secondary is-margin-centered">
							<span class="is-size-6"><i class="la la-envelope"></i>&nbsp;Message</span>
						</button>
					
					</div>


					<!-- Start Organizations Box -->
					<p class="has-text-left title is-size-5">
						Organizations
					</p>
					<div class="box">
						<ul class="organization-list has-text-centered">
							
							<br /><br />
							<i class="la la-exclamation-triangle has-text-danger is-size-2"></i>
							<p class="is-size-5 title">Coming Soon</p>
							<br /><br />
							
						</ul>
					</div>
					<!-- End Organizations Box -->


					<!-- Start Social Box -->
					<p class="has-text-left title is-size-5">
						Social Media
					</p>
					<div class="box">
						<ul class="social-list" v-if="member.social">
							
							<template v-for="(network, index) in member.social">
								<li class="level is-marginless" v-if="network && !['id', 'owner_id', 'owner_type', 'created_at', 'updated_at'].includes(index)" :key="index">
									<a class="level-left" :href="network || ''">
										<div class="icon">
											<b-icon :icon="index" pack="fab" :class="getIconClass(index)" />
										</div>
										<span class="is-v-centered" style="padding-left: 5px;">
											{{ network || '' }}
										</span>
									</a>
								</li>
							</template>
							
						</ul>
					</div>
					<!-- End Social Box -->

				</div>
			</div>

		</div>
	</section>
</template>

<script>
import axios from 'axios'
import { mapState, mapGetters } from 'vuex'
import fileUpload from 'vue-upload-component'
import Cropper from 'cropperjs'

// Layout
import BakdPageHeader from '~/components/layout/BakdPageHeader'
import BakdPostedMessage from '~/components/common/BakdPostedMessage'

import BakdAvatarUpload from '~/components/user/BakdAvatarUpload'
import BakdCoverUpload from '~/components/user/BakdCoverUpload'

export default {
	layout: 'default',

	components: {
		fileUpload,
		BakdPageHeader,
		BakdCoverUpload,
		BakdAvatarUpload,
		BakdPostedMessage
	},

	metaInfo () {
		return { title: this.$t('View Profile') }
	},

	data: () => ({
		member: {},
		posts: [],
		activeTab: ''
	}),

	computed: {
		...mapGetters({
			user: 'auth/user',
			authenticated: 'auth/check'
		}),

		isUsersPage: function () {
			if (this.member.id == this.$route.params.id) {
				return true
			}
			return false
		},
	},

	watch: {
		$route: function () {
			var self = this
			this.fetchUserData().then(function () {
		    	self.fetchUserPosts()
				self.$root.isLoading = false
			})
		},
	},

	methods: {
		fetchUserData: async function () {
			var { data } = await axios.get(`/api/u/${this.$route.params.id}`)
			this.member = data.data.member;
			console.log(data.data.member);
		},

		fetchUserPosts: async function () {
			try {
				var { data } = await axios.get(`/api/u/${this.$route.params.id}/posts`)
				this.posts = data.data
				console.log(data.data)
			} catch (err) {
				alert(err)
			}
		},

	    getIconClass(network) {
	    	var className = 'is-' + network
	    	if (network === 'medium') {
	    		className = 'is-medium-blog'
	    	}
	    	return className;
	    }
	},

	mounted () {
		this.fetchUserData()
		this.fetchUserPosts()
	}
}
</script>


<style lang="scss" scoped>
.social-list {
	li:first-child {
		padding: 15px 5px;
	}
	li:not(:first-child) {
		padding: 15px 5px;
		border-top: 1px solid #ededed;
	}
}

.profile-container {
	z-index: 28;
}
</style>