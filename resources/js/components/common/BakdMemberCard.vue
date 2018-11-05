<template>
	<router-link :to="{ name: 'members.profile' }">
		<div class="card has-shadow has-hover member-card-wrapper wow fadeIn">
		  <div class="card-image">
		    <figure class="image is-16x9">
		      <img src="https://via.placeholder.com/1280x960">
		    </figure>
		  </div>
		  <div class="card-content">
		    <div class="media">
		      <div class="media-left">
		        <figure class="image is-48x48">
		          <img src="https://via.placeholder.com/96">
		        </figure>
		      </div>
		      <div class="media-content">
		        <p class="title is-4">Tom Grenier</p>
		        <p class="subtitle is-6">@tomgren</p>
		      </div>
		    </div>

		    <!-- <div class="content">
		      Lorem ipsum dolor sit amet, consectetur adipiscing elit.
		      Phasellus nec iaculis mauris. <a>@bulmaio</a>.
		      <a href="#">#css</a> <a href="#">#responsive</a>
		      <br>
		      <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>
		    </div> -->
		  </div>
		</div>


	<!-- 
		<div class="card has-text-centered member-card-wrapper has-hover">
			<div class="image">
				<img src="https://via.placeholder.com/150x70" />
			</div>
			<div class="profile-picture">
				<img src="/images/no-avatar.png" class="is-rounded has-shadow" style="height: auto; width: 100%; max-width: 100px; border-radius: 500px; margin-top: -60px; z-index: 9; border: 1px solid orange; position: relative;" />
			</div>
			<div class="member-info" style="margin-top: 10px;">
				<p class="title is-size-5 is-marginless">
					Tom Grenier
				</p>
				<p class="sub-title is-size-6 is-marginless">
					Blockchain Developer
				</p>
			</div>
			<div class="card-footer">
				<div class="columns is-fullwidth">
					<div class="column is-one-third has-text-centered">
						<span class="is-bold is-size-6">
							Followers
							<br />
							398
						</span>
					</div>
					<div class="column is-one-third has-text-centered">
						<span class="is-bold is-size-6">
							Followers
							<br />
							398
						</span>
					</div>
					<div class="column is-one-third has-text-centered">
						<span class="is-bold is-size-6">
							Followers
							<br />
							398
						</span>
					</div>
				</div> -->
			<!-- </div> -->
				<!-- <div class="field control" style="margin-bottom: 30px;">
					<router-link :to="{ name: 'members.profile' }" class="is-margin-centered button is-primary">
						View Profile
					</router-link>
				</div> -->
	<!-- 		</div>
		</div>
	 -->
	</router-link>
</template>

<script>
export default {

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