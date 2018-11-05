<template>
  <panel :title="$t('how_it_works')">

	<fa icon="exclamation-triangle" class="is-red fa-2x"/>
	<h3>
		How it Works
	</h3>

  </panel>
</template>

<script>
export default {
  metaInfo () {
    return { title: this.$t('how_it_works') }
  }
}
</script>
