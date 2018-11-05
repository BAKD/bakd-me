<template>
  <panel :title="$t('campaign_dashboard')">

	<fa icon="exclamation-triangle" class="is-red fa-2x"/>
	<h3>
		Campaign Dashboard
	</h3>

  </panel>
</template>

<script>
export default {
  metaInfo () {
    return { title: this.$t('campaign_dashboard') }
  }
}
</script>
