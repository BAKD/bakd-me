<template>
	<section>

		<bakd-page-header class="has-text-centered is-medium" background="https://via.placeholder.com/1600x400">
			 <!-- <h1 class="title is-white wow fadeInRight is-size-2">Member <span class="is-primary">Directory</span></h1>
      		 <h2 class="hidden-mobile subtitle is-white is-size-5 wow fadeInLeft">Find team members for your next project or just meet new people</h2> -->

		</bakd-page-header>
		<div class="container">






<!-- 
			<div class="columns">
				<div class="column is-12">
					<div class="box is-fullwidth is-100">

					</div>
				</div>
			</div>
 -->

			<div class="columns">
				<div class="column is-3">
					
					<div class="box" style="margin-top: 0px;">
					<div class="avatar-wrapper has-text-centered" style="margin-top: -120px;">
						<div style="border-radius: 500px; text-align: center; margin: 0 auto; width: 200px; height: 200px; border: 2px solid #f5f5f5; background: #fff;">
							<img :src="member ? member.photo_url : ''" class="is-rounded" style="border-radius: 500px; margin: 0 auto;" />
						</div>

						<div class="columns">
							<div class="column is-6 has-text-centered">
	Followers: {{ member.follower_count }}
</div>
							<div class="column is-6 has-text-centered">
	Following: {{ member.following_count }}
</div>
</div>
						<!-- <ul class="list"> -->
							<!-- <li> -->
								<!-- <b-icon icon="twitter" />
								<b-icon icon="facebook" />
								<b-icon icon="google" />
								<b-icon pack="fab" icon="btc" />
								<b-icon icon="discord" />
								<b-icon icon="telegram" />
								<b-icon pack="fab" icon="github" />
								<b-icon icon="medium" />
								<b-icon icon="reddit" /> -->
							<!-- </li> -->
						<!-- </ul> -->
					</div>
						
						<ul class="social-list" v-if="member.social">
							<li>
								<b-tooltip label="Twitter">
								<!-- <router-link :to="{ path: member.social.google || '' }"> -->
									<b-icon icon="twitter" class="is-twitter" />
									<span>
										{{ member.social.twitter || '' }}
									</span>
								<!-- </router-link> -->
								</b-tooltip>
							</li>
							<li>
								<!-- <router-link :to="{ path: member.social.google || '' }"> -->
									<b-icon icon="facebook" class="is-facebook" />
									<span>
										{{ member.social.facebook || '' }}
									</span>
									<!-- </router-link> -->
							</li>
							<li>
								<!-- <router-link :to="{ path: member.social.google || '' }"> -->
									<b-icon icon="google" class="is-google" />
									<span>
										{{ member.social.google || '' }}
									</span>
									<!-- </router-link> -->
							</li>
							<li>
								<!-- <router-link :to="{ path: member.social.google || '' }"> -->
									<b-icon pack="fab" icon="btc" class="is-bitcoin" />
									<span>
										{{ member.social.bitcoin || '' }}
									</span>
									<!-- </router-link> -->
							</li>
							<li>
								<!-- <router-link :to="{ path: member.social.google || '' }"> -->
									<b-icon icon="discord" class="is-discord" />
									<span>
										{{ member.social.discord || '' }}
									</span>
									<!-- </router-link> -->
							</li>
							<li>
								<!-- <router-link :to="{ path: member.social.google || '' }"> -->
									<b-icon icon="telegram" class="is-telegram" />
									<span>
										{{ member.social.telegram || '' }}
									</span>
									<!-- </router-link> -->
							</li>
							<li>
								<!-- <router-link :to="{ path: member.social.google || '' }"> -->
									<b-icon pack="fab" icon="github" class="is-github" />
									<span>
										{{ member.social.github || '' }}
									</span>
									<!-- </router-link> -->
							</li>
							<li>
								<!-- <router-link :to="{ path: member.social.google || '' }"> -->
									<b-icon icon="medium" class="is-medium-blog" />
									<span>
										{{ member.social.medium || '' }}
									</span>
									<!-- </router-link> -->
							</li>
							<li>
								<!-- <router-link :to="{ path: member.social.google || '' }"> -->
									<b-icon icon="reddit" class="is-reddit" />
									<span>
										{{ member.social.reddit || '' }}
									</span>
									<!-- </router-link> -->
							</li>
						</ul>


					</div>

				</div>
				<div class="column is-9">

					
						<h2 v-text="member.name" class="is-size-1 is-dark" />
						<span class="label is-danger">UNVERIFIED</span>
						<h3 v-text="member.title || 'Add a title'" class="is-size-5 is-title is-dark" />
						<h4 v-text="member.bio || 'Add a bio'" class="is-size-6 is-subtitle is-dark" />

						<b-tabs expanded v-model="activeTab">
						
				            <b-tab-item label="Posts">
								
								<template v-for="post in posts">
									<bakd-posted-message :user="member" :post="post" :key="post.id" />
								</template>

				            </b-tab-item>

				            <b-tab-item label="Followers">
				                You have no followers
				            </b-tab-item>

				            <b-tab-item label="Following">
				                You aren't following anyone yet
				            </b-tab-item>

				            <b-tab-item label="Campaigns">
				                You have no campaigns
				            </b-tab-item>

			        </b-tabs>

				</div>
			</div>


		</div>
	</section>
</template>

<script>
import axios from 'axios'
import { mapGetters } from 'vuex'

// Layout
import BakdPageHeader from '~/components/layout/BakdPageHeader'
import BakdPostedMessage from '~/components/common/BakdPostedMessage'

export default {
	layout: 'default',

	components: {
		BakdPageHeader,
		BakdPostedMessage
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
		}
	},

	metaInfo () {
		return { title: this.$t('View Profile') }
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
</style>