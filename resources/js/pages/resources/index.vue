<template>
  <panel :title="$t('resources')">

	<fa icon="exclamation-triangle" class="is-red fa-2x"/>
	<h3>
		Resources
	</h3>

  </panel>
</template>

<script>
export default {
  metaInfo () {
    return { title: this.$t('resources') }
  }
}
</script>
