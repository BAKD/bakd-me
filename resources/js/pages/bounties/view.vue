<template>
	<section>

		<bakd-page-header class="has-text-centered is-small">
			 <h1 class="title is-white wow fadeInRight is-size-2">Twitter <span class="is-primary">Bounty</span></h1>
		</bakd-page-header>

		<div class="container">

			<div class="columns" style="">
				
				<div class="column is-9">
					<h1 class="title is-5">VIEW BOUNTY</h1>

					<div v-for="n in 8" :key="n" style="margin-bottom: 20px;">
						<div class="box level">
							<!-- <div class="tile"> -->
							<div class="media">
								<div class="media-left">
									<img src="https://via.placeholder.com/150" /> 
								</div>
								<div class="media-body">
									<p class="title is-4">Bounty Name</p>
									<p class="subtitle is-6">Bounty information subtitle goes here</p>
									<p>
										<!-- <img src="https://via.placeholder.com/25" /> -->
									</p>
								</div>
							</div>
						</div>
					</div>

				</div>

				<div class="column is-3">
					<h1 class="title is-5">&nbsp;</h1>

					<div class="box" style="height: 100vh;">
					</div>

				</div>
				
			</div>
		</div>
	</section>
</template>

<script>
import BakdPageHeader from '~/components/layout/BakdPageHeader'

export default {
  layout: 'default',

  components: {
  	BakdPageHeader
  },
	
  metaInfo () {
    return { title: this.$t('view_bounty') }
  }
}
</script>
