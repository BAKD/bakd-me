<template>
	<router-link :to="{ name: 'members.profile' }">
		<div class="card has-shadow has-hover member-card-wrapper wow fadeIn">
		  <div class="card-image">
		    <figure class="image is-16x9">
		      <img src="https://via.placeholder.com/400x180">
		    </figure>
		  </div>
		  <div class="card-content">
		    <div class="media">
		      <div class="media-left">
		        <figure class="image is-48x48">
		          <img :src="member.photo_url || '/images/no-avatar.png'" />
		        </figure>
		      </div>
		      <div class="media-content">
		        <p class="title is-5">{{ member.name }}</p>
		        <p class="subtitle is-6">@{{ member.name | slugify }}</p>
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