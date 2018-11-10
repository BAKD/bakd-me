<template>
	<section>
      <bakd-page-header size="is-small" class="has-text-centered">
       <h1 class="title is-white wow fadeInRight is-size-2">Contact <span class="is-primary">Us</span></h1>
       <!-- <h2 class="hidden-mobile subtitle is-white is-size-5 wow fadeInLeft">Earn <span style="font-weight: 700;">BAKD</span> Coins for participating in bounties for a limited time only!</h2> -->
      </bakd-page-header>
		<div class="container section">
			<panel :title="$t('Contact Us')">
				<div style="min-height: 400px; margin: 40px 10px; padding: 120px 50px 50px 50px;" class="has-text-centered is-100">

					<div class="is-v-centered">
						<fa icon="exclamation-triangle" class="has-text-red is-danger has-text-danger fa-2x"/>
						<br/>
						<h3 class="is-bold">In Development</h3>
					</div>
	
				</div>
			</panel>
		</div>
	</section>
</template>

<script>
export default {
  metaInfo () {
    return { title: this.$t('Contact Us') }
  }
}
</script>
