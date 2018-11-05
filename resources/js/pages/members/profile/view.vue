<template>
  <panel :title="$t('view_profile')">
    view profile
  </panel>
</template>

<script>
export default {
  layout: 'account',
	
  // middleware: 'auth',

  metaInfo () {
    return { title: this.$t('Users') }
  }
}
</script>
