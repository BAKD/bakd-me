<template>
  <panel :title="$t('view_campaign')">

	<fa icon="exclamation-triangle" class="is-red fa-2x"/>
	<h3>
		View Campaign
	</h3>

  </panel>
</template>

<script>
export default {
  metaInfo () {
    return { title: this.$t('view_campaign') }
  }
}
</script>
