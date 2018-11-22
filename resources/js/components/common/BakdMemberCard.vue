<template>
	<router-link :to="{ name: 'members.show.public', params: { id: member.id } }">
		<div class="card has-shadow has-hover member-card-wrapper wow fadeIn">
		  <div class="card-image">
		    <figure class="image is-16x9" :style="'background: url(' + (member ? member.cover_url : '') + '); background-position: center center; background-size: cover; background-color: #dadada; width: 100%; max-width: 400px; height: 180px; overflow: hidden;'">
		      <!-- <img :src="member ? member.cover_url : ''" style="background-color: #dadada; width: 400px; height: 180px;"> -->
		    </figure>
		  </div>
		  <div class="card-content">
		    <div class="media">
		      <div class="media-left">
		        <figure class="image is-48x48">
		          <img :src="member.avatar_url || member.photo_url" />
		        </figure>
		      </div>
		      <div class="media-content" style="height: 60px;">
		        <p class="title is-5">{{ member.name }}</p>
		        <p class="subtitle is-6">@{{ member.name | slugify }}</p>
		      </div>
		    </div>
		  </div>
		  <div style="padding: 10px;" class="has-text-centered">
			<hr />
		  	<div class="columns">
		  		<div class="column is-half">
					<p class="title is-size-5">{{ member.follower_count }}</p>
					<p class="subtitle is-size-6 has-text-grey-light">Followers</p> 
  	  			</div>
  				<div class="column is-half">
					<p class="title is-size-5">{{ member.following_count }}</p>
					<p class="subtitle is-size-6 has-text-grey-light">Following</p> 
  	  			</div>
  			</div>
  	  	  </div>
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
</style>