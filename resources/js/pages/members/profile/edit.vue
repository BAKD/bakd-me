<template>
  <panel :title="$t('edit_profile')">
    edit profile
  </panel>
</template>

<script>
export default {
  layout: 'account',
  middleware: 'auth',

  metaInfo () {
    return { title: this.$t('Users') }
  }
}
</script>
