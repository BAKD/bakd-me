<template>
  <panel :title="$t('Users')">
    {{ $t('you_are_logged_in') }}
  </panel>
</template>

<script>
export default {
  middleware: 'auth',

  metaInfo () {
    return { title: this.$t('Users') }
  }
}
</script>
