<template>
	<router-link :to="{ name: 'members.show.public', params: { id: member.id } }">
		<div class="card has-shadow has-hover member-card-wrapper wow fadeIn">
		  <div class="card-image">
		    <figure class="image is-16x9" :class="{ 'orange-bg': !member.cover_url }" :style="'background-image: url(' + (member ? member.cover_url : '') + '); background-position: 50% 50%; background-size: cover; background-repeat: no-repeat; width: 100%; max-width: 400px; height: 120px; overflow: hidden;'">
		    </figure>
		  </div>
		  <div class="card-content">
		    <div class="media">
		      <div class="media-left">
		        <figure class="image is-48x48">
		          <img :src="member.avatar_url || member.photo_url" />
		        </figure>
		      </div>
		      <div class="media-content is-paddingless is-clipped">
		        <p class="title is-5 member-name">{{ member.name }}</p>
		        <p class="subtitle is-6 member-username">@{{ member.name | slugify }}</p>
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