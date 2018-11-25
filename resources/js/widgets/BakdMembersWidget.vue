<template>
	<div class="widget">
	    <p class="has-text-left title is-size-5">
	      Members
	    </p>
	    <div class="box">

			<template v-if="isReady && this.members.length > 0">
				<!-- MEMBER LOOP -->
		      <article class="media is-fullwidth" v-for="(member, index) in members" :key="index">
		        <figure class="media-left has-hand-cursor" @click.prevent="viewMember($event, member.id)">
		          <img :src="member.avatar_url || member.photo_url" class="is-v-centered image" style="width: 100%; height: auto; max-width: 56px;" />
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
			        <b-tooltip label="Follow" type="is-dark">
			          <a class="is-v-centered" @click.prevent="followMember($event, member.id)" :data-id="index">
			            <i class="la la-plus-square la-2x"/>
			          </a>
					</b-tooltip>
		        </p>
		      </article>
	  	    </template>

			<!-- No members left... -->        
			<template v-else>
			  <div class="column has-text-centered mt-50">
				<!-- <b-icon icon="emoticon-sad" size="is-large" class="is-danger has-text-danger" /> -->
				<i class="la la-exclamation-triangle is-size-2 is-danger has-text-danger" />
			  	<p class="title is-size-5">
				    No Members Left
				</p>
			  </div>
			</template>
			<!-- End no members left... -->

	      <!-- VIEW MORE -->
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
			isReady: false,
			members: [],
			pendingMembers: [] // users on deck to be shown
		}
	},

	methods: {
		followMember: async function (event, memberId) {
			var self = this

			var { data } = await axios.post(`/api/user/follow`, { follow_id: memberId })

			// Fade element out and replace it with a pending member
			$(event.target).closest('article').animate({ 'opacity': 0 }, function () {
				// If we have no "pending" members left to replace the followed/faded 
				// members, just fade out and dump out 
				if (self.pendingMembers.length === 0) {
					return
				}
				
				var index = $(event.target).parent().data('id');
				var replacementMember = self.pendingMembers.pop();

				// Replace the element in the array of actively display members
				self.members.splice(index, 1, replacementMember);

				// Fade element back in
				$(this).animate({ 'opacity': 1 })
			})

	        helpers.toast({ type: data.status, title: data.message })
		},

		unfollowMember: async function (event, memberId) {
			var self = this

			var { data } = await axios.post(`/api/user/unfollow`, { unfollow_id: memberId })

	        helpers.toast({ type: data.status, title: data.message })
		},

		viewMember: function (event, memberId) {
			this.$router.push({ name: 'members.show.public', params: { id: memberId } })
		}
	},

	mounted () {
	  	var self = this

	    axios
	      .post('/api/users/random', { limit: 30 })
	      .then(function(response) { 
	      	self.pendingMembers = response.data
	      	self.isReady = true
		    
		    // Grab the first 5 members to display in the widget
		    self.members = self.pendingMembers.splice(0, 5);
	      })
	}
}
</script>