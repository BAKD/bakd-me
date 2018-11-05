<template>
  <panel :title="$t('member_followers')">
		
	MEMBER FOLLOWERS

  </panel>
</template>

<script>
export default {
  layout: 'social',

  metaInfo () {
    return { title: this.$t('member_followers') }
  }
}
</script>
