<template>
	<div class="widget">
	    <p class="has-text-left title is-size-5">
	      Members
	    </p>
	    <div class="box" v-if="isReady">
	      <article class="media is-fullwidth" v-for="member in members" :key="member.id">
	        <figure class="media-left has-hand-cursor" @click.prevent="viewMember($event, member.id)">
	          <img :src="member.photo_url || '/images/no-avatar.png'" class="is-v-centered image" style="width: 100%; height: auto; max-width: 56px;" />
	        </figure>
	        <div class="media-body control is-100 is-v-centered has-hand-cursor" @click.prevent="viewMember($event, member.id)">
	          <p class="title is-size-6">
	            {{ member.name }}
	          </p>
	          <p class="subtitle is-size-7 has-text-grey-light">
	            {{ member.type | capitalize }}
	          </p>
	        </div>
	        <p class="media-right is-pulled-right has-text-right is-v-centered">
				
				<template v-if="!member.isFollowing">
			        <b-tooltip label="Follow" type="is-dark">
			          <a class="is-v-centered" @click.prevent="followMember($event, member.id)">
			            <i class="la la-plus-square la-2x"/>
			          </a>
					</b-tooltip>
				</template>
				<template v-else>
					<b-tooltip label="Unfollow" type="is-dark">
			          <a class="is-v-centered" @click.prevent="unfollowMember($event, member.id)">
			            <i class="la la-minus-square la-2x"/>
			          </a>
					</b-tooltip>
				</template>

	        </p>
	      </article>
	      <div class="box-footer">
	        <router-link :to="{ name: 'members.directory' }" href="#" class="button is-primary is-rounded is-outlined--off is-fullwidth is-normal" style="max-width: 140px; margin: 20px auto 5px;">
	          <span class="is-size-7"><i class="la la-plus" /> View More</span>
	        </router-link>
	      </div>
	    </div>
	</div>
</template>

<script>
import axios from 'axios'
import swal from 'sweetalert2'

export default {

	props: {
		type: { 
			type: String,
			required: false 
		}
	},

	data() {
		return {
			isFollowing: false,
			isReady: false,
			members: []
		}
	},

	methods: {
		followMember: async function (event, memberId) {
			var self = this

			var { data } = await axios.post(`/api/user/follow`, { follow_id: memberId })

			if (data && data.status !== 'error') {
				this.isFollowing = true;			
				this.userFollowers = data.data.followers
				this.userFollowing = data.data.following
			}

	        helpers.toast({type: data.status, title: data.message })
		},

		unfollowMember: async function (event, memberId) {
			var self = this

			var { data } = await axios.post(`/api/user/unfollow`, { unfollow_id: memberId })

			if (data && data.status !== 'error') {
				this.isFollowing = false;			
				this.userFollowers = data.data.followers
				this.userFollowing = data.data.following
			}

	        helpers.toast({type: data.status, title: data.message })
		},

		viewMember: function (event, memberId) {
			this.$router.push({ name: 'members.show.public', params: { id: memberId } })
		}
	},

	mounted () {
	  	var self = this

	    axios
	      .post('/api/users/random', { limit: 5 })
	      .then(function(response) { 
	      	self.members = response.data
	      	self.isReady = true
	      })
	}
}
</script>