<template>
	<div class="widget">
	    <p class="has-text-left title is-size-5">
	      Latest Members
	    </p>
	    <div class="box">
	      <article class="media is-fullwidth" v-for="member in members" :key="member.id">
	        <figure class="media-left has-hand-cursor" @click.prevent="viewMember($event, member.id)">
	          <img :src="member.photo_url || '/images/no-avatar.png'" class="is-v-centered image" style="width: 100%; height: auto; max-width: 56px;" />
	        </figure>
	        <div class="media-body control is-100 is-v-centered has-hand-cursor" @click.prevent="viewMember($event, member.id)">
	          <p class="title is-size-6">
	            {{ member.name }}
	          </p>
	          <p class="subtitle is-size-7 has-text-grey-light">
	            <!-- Fix me -->
	            Blockchain Developer 
	          </p>
	        </div>
	        <p class="media-right is-pulled-right has-text-right is-v-centered">
		        <b-tooltip label="Follow" type="is-dark">
		          <a class="is-v-centered" @click.prevent="followMember($event, member.id)">
		            <i class="la la-plus-square la-2x"/>
		          </a>
				</b-tooltip>
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
	data() {
		return {
			members: []
		}
	},

	methods: {
		followMember: function (event, memberId) {
			console.log(event);
			swal({
				type: 'info',
				title: 'Coming soon',
				text: 'action:follow, user:' + memberId
			})
		},

		viewMember: function (event, memberId) {
			this.$router.push({ name: 'members.show.public', params: { id: memberId }})
		}
	},

	mounted () {
	  	var self = this;
	    axios
	      .post('/api/users', { limit: 5 })
	      .then(function(response) { self.members = response.data })
	}
}
</script>