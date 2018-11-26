<template>
	<router-link :to="{ name: 'members.show.public', params: { id: member.id } }">
		<div class="card has-shadow has-hover member-card-wrapper animated fadeIn" style="margin-bottom: .65rem;">
		  <div class="card-image">
		    <figure class="image is-16x9" :class="{ 'orange-bg': !member.cover_url }" :style="'background-image: url(' + (member ? member.cover_url : '') + '); background-position: 50% 50%; background-size: cover; background-repeat: no-repeat; width: 100%; max-width: 400px; height: 100px; overflow: hidden; border-radius: 2px;'">
		    </figure>
		  </div>
		  <div class="card-content" style="padding-bottom: 0;">
		    <div class="media" style="margin-top: -50px;">
		      <div class="media-left">
		        <figure class="image is-96x96 is-rounded">
		          <img :src="member.avatar_url || member.photo_url" class="is-rounded" style="border: 6px solid #fff;" />
		        </figure>
		      </div>
		      <div class="media-content is-paddingless is-clipped is-v-centered">
		        <p class="title is-5 member-name" style="margin-top: .25rem; margin-bottom: 1rem;">{{ member.name }}</p>
		        <p class="subtitle is-6 member-username" style="margin-top: -1rem;">@{{ member.username || member.id }}</p>
		      </div>
		    </div>
		  </div>

			<!-- <div class="card-footer"> -->
				<div class="columns" style="padding: 10px 10px 10px;">
					<div class="column is-one-third has-text-centered">
						<p class="subtitle is-size-7 has-text-grey-light">
							Tweets
						</p>
						<p class="title is-size-6">
							0
						</p>
					</div>
					<div class="column is-one-third has-text-centered">
						<p class="subtitle is-size-7 has-text-grey-light">
							Followers
						</p>
						<p class="title is-size-6">
							{{ member.follower_count || 0 }}
						</p>
					</div>
					<div class="column is-one-third has-text-centered">
						<p class="subtitle is-size-7 has-text-grey-light">
							Following
						</p>
						<p class="title is-size-6">
							{{ member.following_count || 0 }}
						</p>
					</div>
				</div>
			</div>





		  <!-- <div class="has-text-centered">
			<hr class="is-marginless" />
		  	<div class="columns" style="padding-top: 10px;">
  	  			<div class="column is-one-third">
					<p class="title is-size-5">{{ member.trust || 0 }}</p>
					<p class="subtitle is-size-6 has-text-grey-light">Trust</p> 
  	  			</div>
		  		<div class="column is-one-third">
					<p class="title is-size-5">{{ member.follower_count || 0 }}</p>
					<p class="subtitle is-size-6 has-text-grey-light">Followers</p> 
  	  			</div>
  				<div class="column is-one-third">
					<p class="title is-size-5">{{ member.following_count || 0 }}</p>
					<p class="subtitle is-size-6 has-text-grey-light">Following</p> 
  	  			</div>
  			</div>
  	  	  </div> -->
		</div>
	</router-link>
</template>

<script>
export default {

	props: {
		member: {
			type: Object,
			required: true
		}
	},

	mounted () {
		new WOW().init()
	}

}
</script>

<style scoped lang="scss">
.member-card-wrapper {
	padding: 0px;
	max-width: 320px;
	min-width: 300px;
	margin: auto;
}
.member-username,
.member-name {
	text-overflow: ellipsis;
	overflow: hidden;
	max-width: 100%;
	white-space: nowrap;
}
.orange-bg {
	background: none !important;
	background-image: none !important;
	background-color: #F59118 !important;
}
</style>