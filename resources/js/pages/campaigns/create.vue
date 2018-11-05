<template>
  <panel :title="$t('create_a_campaign')">

	<fa icon="exclamation-triangle" class="is-red fa-2x"/>
	<h3>
		Create A Campaign
	</h3>

  </panel>
</template>

<script>
export default {
  metaInfo () {
    return { title: this.$t('create_a_campaign') }
  }
}
</script>
