<template>
  <panel :title="$t('bounty_dashboard')">
	Bounty Dashboard
  </panel>
</template>

<script>
export default {
  layout: 'account',
	
  metaInfo () {
    return { title: this.$t('bounty_dashboard') }
  }
}
</script>
