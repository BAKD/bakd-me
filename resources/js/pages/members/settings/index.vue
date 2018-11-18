<template>
  <div>
    dashboard
  </div>
</template>

<script>
export default {
  layout: 'account',
 
  mounted() {
    this.$root.isLoading = false;
  },
   
  metaInfo () {
    return { title: this.$t('Member Settings') }
  }
}
</script>
