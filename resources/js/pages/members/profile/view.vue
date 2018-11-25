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
					
						<!-- POSTS/REALTIME TAB CONTENT -->
			            <b-tab-item label="Realtime" icon="comment">
							
							<!-- USER POSTS -->
							<template v-if="posts.length > 0">
								<template v-for="(post, index) in posts">
									<bakd-posted-message :post="post" :key="index" />
								</template>

								<!-- LOAD MORE POSTS BUTTON -->
								<div class="button-wrapper has-text-centered" style="margin-bottom: 40px;" v-if="loadMoreButtons.posts">
								  <a :class="{ 'is-loading': isLoading }" @click.prevet="loadMorePosts" class="button is-wide is-primary is-rounded is-medium animated fadeInUp" style="max-width: 220px;">
								    <span class="is-size-6"><i class="la la-refresh" /> Load More...</span>
								  </a>
								</div>
							</template>

							<!-- NO POSTS -->
			            	<template v-else>
			            		<div class="has-text-centered is-100 mt-50">
					            	<b-icon icon="emoticon-sad" size="is-large" class="has-text-danger" />
					                <p class="title">No Posts</p>
								</div>
								<div class="has-text-centered btn-group mt-50">
									<router-link :to="{ name: 'homepage' }" class="button is-wide is-primary is-rounded is-medium">
										<span class="is-size-6">
											<i class="la la-home" />&nbsp;Join the Conversation
										</span>
									</router-link>
								</div>
							</template>

			            </b-tab-item>
			            <!-- END POSTS/REALTIME TAB CONTENT -->

						<!-- FOLLOWERS TAB -->
			            <b-tab-item label="Followers" icon="account">

			            	<!-- FOLLOWER MEMBER CARDS -->
							<template v-if="followers.length > 0">
								<div class="columns is-multiline has-text-left">
								    <div class="column is-one-half" style="width: 50% !important; max-width: 50%;" v-for="(follower, index) in followers" :key="index">
										<bakd-member-card :member="follower" />
									</div>
								</div>

								<!-- LOAD MORE FOLLOWERS BUTTON -->
								<div class="button-wrapper has-text-centered" style="margin-bottom: 40px;" v-if="loadMoreButtons.followers">
								  <a :class="{ 'is-loading': isLoading }" @click.prevet="loadMoreFollowers" class="button is-wide is-primary is-rounded is-medium animated fadeInUp" style="max-width: 220px;">
								    <span class="is-size-6"><i class="la la-refresh" /> Load More...</span>
								  </a>
								</div>

								<br />

								<!-- <b-pagination
								    class="is-pulled-right"
								    :total="total"
								    :current.sync="current"
								    :order="order"
								    :size="size"
								    :simple="isSimple"
								    :rounded="isRounded"
								    :per-page="perPage"
								    @change="fetchMembers($event)">
								</b-pagination> -->
							</template>

							<!-- FOLLOWERS EMPTY -->
							<template v-else>
				            	<div class="has-text-centered is-100 mt-50">
					            	<b-icon icon="emoticon-sad" size="is-large" class="has-text-danger" />
					                <p class="title">No Followers</p>
								</div>
								<div class="has-text-centered btn-group mt-50">
									<router-link :to="{ name: 'homepage' }" class="button is-wide is-primary is-rounded is-medium">
										<span class="is-size-6">
											<i class="la la-user-plus" />&nbsp;Start Networking
										</span>
									</router-link>
								</div>
							</template>

			            </b-tab-item>
			            <!-- END FOLLOWERS TAB CONTENT -->

						<!-- FOLLOWING TAB CONTENT -->
			            <b-tab-item label="Following" icon="account-plus">

			            	<!-- FOLLOWING MEMBER CARDS -->
							<template v-if="following.length > 0">
								<div class="columns is-multiline has-text-left">
								    <div class="column is-one-half" style="width: 50% !important; max-width: 50%;" v-for="(follow, index) in following" :key="index">
										<bakd-member-card :member="follow" />
									</div>
								</div>

								<!-- LOAD MORE FOLLOWS BUTTON -->
								<div class="button-wrapper has-text-centered" style="margin-bottom: 40px;" v-if="loadMoreButtons.following">
								  <a :class="{ 'is-loading': isLoading }" @click.prevet="loadMoreFollowing" class="button is-wide is-primary is-rounded is-medium animated fadeInUp" style="max-width: 220px;">
								    <span class="is-size-6"><i class="la la-refresh" /> Load More...</span>
								  </a>
								</div>

								<br />

								<!-- <b-pagination
								    class="is-pulled-right"
								    :total="total"
								    :current.sync="current"
								    :order="order"
								    :size="size"
								    :simple="isSimple"
								    :rounded="isRounded"
								    :per-page="perPage"
								    @change="fetchMembers($event)">
								</b-pagination> -->
							</template>

							<template v-else>
				                <div class="has-text-centered is-100 mt-50">
					            	<b-icon icon="emoticon-sad" size="is-large" class="has-text-danger" />
					                <p class="title">No Follows</p>
								</div>
								<div class="has-text-centered btn-group mt-50">
									<router-link :to="{ name: 'homepage' }" class="button is-wide is-primary is-rounded is-medium">
										<span class="is-size-6">
											<i class="la la-users" />&nbsp;Search the Directory
										</span>
									</router-link>
								</div>
							</template>

			            </b-tab-item>
			            <!-- END FOLLOWING TAB CONTENT -->

			            <b-tab-item label="Campaigns" icon="chart-bar">
			                <div class="has-text-centered is-100 mt-50">
				            	<b-icon icon="emoticon-sad" size="is-large" class="has-text-danger" />
				                <p class="title">No Campaigns</p>
							</div>
							<div class="has-text-centered btn-group mt-50">
								<router-link :to="{ name: 'homepage' }" class="button is-wide is-primary is-rounded is-medium">
									<span class="is-size-6">
										<i class="la la-bar-chart" />&nbsp;Start a Campaign
									</span>
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
import BakdMemberCard from '~/components/common/BakdMemberCard'

export default {
	layout: 'default',

	components: {
		fileUpload,
		BakdPageHeader,
		BakdCoverUpload,
		BakdAvatarUpload,
		BakdPostedMessage,
		BakdMembersWidget,
		BakdMemberCard
	},

	metaInfo () {
		return { title: this.$t('View Profile') }
	},

	data: () => ({
		member: {},
		posts: [],
		followers: [],
		following: [],
		campaigns: [],
		activeTab: '',
		isLoading: false,
		userFollowers: 0,
		userFollowing: 0,
		isFollowing: false, // is the auth'd user following this person?

		// Flags used to show/hide the load more buttons
		loadMoreButtons: {
			posts: true,
			followers: true,
			following: true,
			campaigns: true,
		}
	}),

	computed: {
		...mapGetters({
			user: 'auth/user',
			authenticated: 'auth/check'
		}),

		isUsersPage: function () {
			if (this.authenticated && this.user.id === parseInt(this.$route.params.id, 10)) {
				return true
			}
			return false
		},
	},

	watch: {
		// Handle same component/route but different param
		$route: function (to, from) {
			var self = this
			this.fetchUserData().then(function () {
				self.fetchUserPosts(6, 0, true)
				self.fetchFollowers(10, 0, true)
				self.fetchFollowing(10, 0, true)
				self.$root.isLoading = false
			})

			this.loadMoreButtons = {
				posts: true,
				followers: true,
				following: true,
				campaigns: true,
			}
		},
	},

	// TODO: Combine all the fetch requests into one backend request
	methods: {
		fetchUserData: async function () {
			var { data } = await axios.get(`/api/u/${this.$route.params.id}`)
			this.member = data.data.member
			this.isFollowing = data.data.isFollowing
			this.userFollowers = this.member.follower_count
			this.userFollowing = this.member.following_count
			console.log(data.data.member)
		},

		fetchFollowers: async function (limit = 10, offset = 0, initialFetch = false) {
			var userId = this.$route.params.id;

	        this.isLoading = true;

			try {
				var { data } = await axios.get(`/api/user/followers/${userId}?limit=${limit}&offset=${offset}`)

				if (initialFetch === true) {
					this.followers = data.data
				} else {
					this.followers = [...this.followers, ...data.data];
				}
			
				// Show/hide the load more button
				if (data.data.length < limit) {
					this.loadMoreButtons.followers = false
				} else {
					this.loadMoreButtons.followers = true
				}

				this.isLoading = false;
				this.isReady = true

				console.log(data.data.data)

				return data.data
			} catch (err) {
				console.log(err)
			}
		},

		fetchFollowing: async function (limit = 10, offset = 0, initialFetch = false) {
			var userId = this.$route.params.id;

	        this.isLoading = true;

			try {
				var { data } = await axios.get(`/api/user/following/${userId}?limit=${limit}&offset=${offset}`)

				if (initialFetch === true) {
					this.following = data.data
				} else {
					this.following = [...this.following, ...data.data];
				}

				this.isLoading = false;
				this.isReady = true

				// Show/hide the load more button
				if (data.data.length < limit) {
					this.loadMoreButtons.following = false
				} else {
					this.loadMoreButtons.following = true
				}

				console.log(data.data.data)

				return data.data
			} catch (err) {
				console.log(err)
			}
		},

		fetchUserPosts: function (limit = 6, offset = 0, initialFetch = false) {
		    var self = this;
	        
	        this.isLoading = true;

	        return axios
	        	.get(`/api/u/${this.$route.params.id}/posts?limit=${limit}&offset=${offset}`)
		        .then(function (response) {
					if (initialFetch === true) {
						self.posts = response.data
					} else {
						self.posts = [...self.posts, ...response.data];
					}

					self.isLoading = false;
					self.isReady = true

					// Show/hide the load more button
					if (response.data.length < limit) {
						self.loadMoreButtons.posts = false
					} else {
						self.loadMoreButtons.posts = true
					}

					return response
		        })
		        .catch(function(err) {
		        	console.log(err)
		        })
		},

		loadMorePosts: async function () {
			var limit = 6
			var offset = this.posts.length
			var response = await this.fetchUserPosts(limit, offset);

			console.log(response)

			if (response.data.length < limit) {
				this.loadMoreButtons.posts = false
				console.log('No more posts left to display.')
			}
		},

		loadMoreFollowers: async function () {
			var limit = 10
			var offset = this.followers.length
			var response = await this.fetchFollowers(limit, offset);

			console.log(response)

			if (response.length < limit) {
				this.loadMoreButtons.followers = false
				console.log('No more followers left to display.')			
			}
		},

		loadMoreFollowing: async function () {
			var limit = 10
			var offset = this.following.length
			var response = await this.fetchFollowing(limit, offset);

			console.log(response)

			if (response.length < limit) {
				this.loadMoreButtons.following = false
				console.log('No more follows left to display.')			
			}
		},

		loadMoreCampaigns: async function () {
			// var offset = this.campaigns.length
			// var response = await this.fetchUserPosts(6, offset);
			
			// console.log(response)

			// if (response.length < limit) {
			// 	this.loadMoreButtons.campaigns = false
			// 	console.log('No more campaigns left to display.')			
			// }
		},

		// Move to a helper or vuex
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
		// Grab 6 posts, offset 0, set the posts data attr as well
		this.fetchUserData()
		this.fetchUserPosts(6, 0, true)
		this.fetchFollowers(10, 0, true)
		this.fetchFollowing(10, 0, true)
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