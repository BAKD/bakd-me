<template>
	<section>

		<bakd-cover-upload :user="member" />

		<div class="container profile-container">

			<div class="columns member-avatar">
				
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
							<p>
								{{ member.type }}
							</p>
						</div>

						<div class="columns" style="padding: 30px 10px 10px;">
							<div class="column is-6 has-text-centered">
								<p class="title is-size-3">
									{{ userFollowers }}
								</p>
								<p class="subtitle is-size-6 has-text-grey-light">
									Followers
								</p>
							</div>
							<div class="column is-6 has-text-centered">
								<p class="title is-size-3">
									{{ userFollowing }}
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
						
						<!-- AUTHENTICATED BUTTONS -->
						<template v-if="!isUsersPage">
							<!-- FOLLOW/UNFOLLOW BUTTONS -->
							<template v-if="!isFollowing">
								<button @click.prevent="followUser" class="is-fluid button is-rounded is-medium is-wide is-primary is-margin-centered" style="margin-bottom: 8px;">
									<span class="is-size-6"><i class="la la-plus-circle"></i>&nbsp;Follow</span>
								</button>
							</template>
							<template v-else>
								<button @click.prevent="unfollowUser" class="is-fluid button is-rounded is-medium is-wide is-danger is-margin-centered" style="margin-bottom: 8px;">
									<span class="is-size-6"><i class="la la-minus-circle"></i>&nbsp;Unfollow</span>
								</button>
							</template>							
							
							<!-- MESSAGING BUTTONS -->
							<button @click.prevent="messageUser" class="button is-fluid is-rounded is-medium is-wide is-secondary is-margin-centered">
								<span class="is-size-6"><i class="la la-envelope"></i>&nbsp;Message</span>
							</button>
						</template>

						<!-- GUEST BUTTONS -->
						<template v-else>
							<router-link :to="{ name: 'members.settings.profile' }" class="is-fluid button is-rounded is-medium is-wide is-primary is-margin-centered" style="margin-bottom: 8px;">
								<span class="is-size-6"><i class="la la-edit"></i>&nbsp;Edit Profile</span>
							</router-link>
							<!-- <button class="button is-fluid is-rounded is-medium is-wide is-danger is-margin-centered"> -->
								<!-- <span class="is-size-6"><i class="la la-trash"></i>&nbsp;Delete Account</span> -->
							<!-- </button> -->
						</template>

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
					<template v-if="member.social">
						<p class="has-text-left title is-size-5">
							Social Media
						</p>
						<div class="box">
							<ul class="social-list">
								
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
					</template>
					<!-- End Social Box -->

					<br />

				</div>

				<div class="column is-6">

					<br />

					<b-tabs v-model="activeTab">
					
			            <b-tab-item label="Realtime" icon="comment">
							
							<template v-if="posts.length > 0">
								<template v-for="(post, index) in posts">
									<bakd-posted-message :post="post" :key="index" />
								</template>
							</template>
			            	<template v-else>
			            		<div class="has-text-centered is-100 mt-50">
					            	<b-icon icon="emoticon-sad" size="is-large" class="has-text-danger" />
					                <p class="title">No Posts</p>
								</div>
								<div class="has-text-centered btn-group mt-50">
									<router-link :to="{ name: 'homepage' }" class="button is-wide is-primary">
										<i class="la la-home" />&nbsp;Join the Conversation
									</router-link>
								</div>
							</template>

			            </b-tab-item>

			            <b-tab-item label="Followers" icon="account">
			            	<div class="has-text-centered is-100 mt-50">
				            	<b-icon icon="emoticon-sad" size="is-large" class="has-text-danger" />
				                <p class="title">No Followers</p>
							</div>
							<div class="has-text-centered btn-group mt-50">
								<router-link :to="{ name: 'homepage' }" class="button is-wide is-primary">
									<i class="la la-user-plus" />&nbsp;Start Networking
								</router-link>
							</div>
			            </b-tab-item>

			            <b-tab-item label="Following" icon="account-plus">
			                <div class="has-text-centered is-100 mt-50">
				            	<b-icon icon="emoticon-sad" size="is-large" class="has-text-danger" />
				                <p class="title">No Follows</p>
							</div>
							<div class="has-text-centered btn-group mt-50">
								<router-link :to="{ name: 'homepage' }" class="button is-wide is-primary">
									<i class="la la-users" />&nbsp;Search the Directory
								</router-link>
							</div>
			            </b-tab-item>

			            <b-tab-item label="Campaigns" icon="chart-bar">
			                <div class="has-text-centered is-100 mt-50">
				            	<b-icon icon="emoticon-sad" size="is-large" class="has-text-danger" />
				                <p class="title">No Campaigns</p>
							</div>
							<div class="has-text-centered btn-group mt-50">
								<router-link :to="{ name: 'homepage' }" class="button is-wide is-primary">
									<i class="la la-bar-chart" />&nbsp;Start a Campaign
								</router-link>
							</div>
			            </b-tab-item>

		        	</b-tabs>

				</div> <!-- .is-6 -->


				<div class="column is-3">
	
					<br />
					
		            <bakd-members-widget type="random" />

					<br />

				</div> <!-- .is-3 -->


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

import BakdMembersWidget from '~/widgets/BakdMembersWidget'

export default {
	layout: 'default',

	components: {
		fileUpload,
		BakdPageHeader,
		BakdCoverUpload,
		BakdAvatarUpload,
		BakdPostedMessage,
		BakdMembersWidget
	},

	metaInfo () {
		return { title: this.$t('View Profile') }
	},

	data: () => ({
		member: {},
		posts: [],
		activeTab: '',
		userFollowers: 0,
		userFollowing: 0,
		isFollowing: false // is the auth'd user following this person?
	}),

	computed: {
		...mapGetters({
			user: 'auth/user',
			authenticated: 'auth/check'
		}),

		isUsersPage: function () {
			if (this.user.id === parseInt(this.$route.params.id, 10)) {
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
			this.member = data.data.member
			this.isFollowing = data.data.isFollowing
			this.userFollowers = this.member.follower_count
			this.userFollowing = this.member.following_count
			console.log(data.data.member)
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

		followUser: async function () {
			var self = this

			var { data } = await axios.post(`/api/user/follow`, { follow_id: self.member.id })

			if (data && data.status !== 'error') {
				this.isFollowing = true;			
				this.userFollowers = data.data.followers
				this.userFollowing = data.data.following
			}

	        helpers.toast({type: data.status, title: data.message })
		},

		unfollowUser: async function () {
			var self = this

			var { data } = await axios.post(`/api/user/unfollow`, { unfollow_id: self.member.id })

			if (data && data.status !== 'error') {
				this.isFollowing = false;			
				this.userFollowers = data.data.followers
				this.userFollowing = data.data.following
			}

	        helpers.toast({type: data.status, title: data.message })
		},

		messageUser: async function () {
			swal({
				type: 'info',
				text: 'Coming Soon'
			})
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
.mt-50 {
	margin-top: 50px;
}
</style>