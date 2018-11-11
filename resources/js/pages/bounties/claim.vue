<template>
  <panel :title="$t('claim_bounty')">
	Claim Bounty
  </panel>
</template>

<script>
export default {
  layout: 'account',
  middleware: 'auth',
	
  metaInfo () {
    return { title: this.$t('claim_bounty') }
  }
}
</script>
