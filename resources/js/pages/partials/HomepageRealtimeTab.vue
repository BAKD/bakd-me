<template>
	<section class="homepage-realtime-tab">

		<!-- POST MESSAGE -->
		<bakd-post-message/>

		<!-- TODO: REALTIME MESSAGE WALL -->
		<div v-for="n in 10" :key="n">
		  <bakd-posted-message class="wow fadeIn">
		  	<b-message style="margin-bottom: 20px;">
				Lorem ipsum dolor sit amet, <a href="#">#consectetur</a> adipisicing elit. Eligendi corporis, sed enim inventore perspiciatis tempore animi ex distinctio modi.
			</b-message>

			<!-- TODO: Setup Tag System -->
			<ul class="tags field is-grouped">
				<a href="#">
					<li class="tag is-rounded" style="margin-right: 10px;">
						#btc 
					</li>
				</a>
				<a href="#">
					<li class="tag is-rounded" style="margin-right: 10px;">
						#blockchain
					</li>
				</a>
				<a href="#">
					<li class="tag is-rounded" style="margin-right: 10px;">
						#cryptocurrency
					</li>
				</a>
				<a href="#">
					<li class="tag is-rounded" style="margin-right: 10px;">
						#p2p
					</li>
				</a>
			</ul>
			
		  </bakd-posted-message>

		</div>

		<div class="button-wrapper has-text-centered" style="margin-bottom: 40px;">
		  <a class="button is-wide is-primary is-rounded is-medium wow fadeInUp" style="max-width: 220px;">
		    <span class="is-size-6"><i class="la la-refresh" /> Load More...</span>
		  </a>
		</div>

	</section>
</template>

<script>
import BakdPostMessage from '~/components/common/BakdPostMessage'
import BakdPostedMessage from '~/components/common/BakdPostedMessage'

export default {
	name: 'HomepageRealtimeTab',

	components: {
		BakdPostMessage,
		BakdPostedMessage
	}
}
</script>