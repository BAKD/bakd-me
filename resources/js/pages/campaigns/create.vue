<template>
	<section class="section">
		<div class="container">
			<panel :title="$t('Create a Campaign')">
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
    return { title: this.$t('Create a Campaign') }
  }
}
</script>
