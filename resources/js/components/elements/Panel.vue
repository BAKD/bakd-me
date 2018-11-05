<template>
  <nav class="panel">
    <p v-if="title" class="panel-heading">
      {{ title }}
    </p>
    <div class="panel-block">
      <slot/>
    </div>
  </nav>
</template>

<script>
export default {
  name: 'Panel',

  props: {
    title: { type: String, default: null }
  }
}
</script>

<style scoped lang="scss">
  nav.panel {
    box-shadow: 0px 0px 10px -3px rgba(0, 0, 0, 0.25);

    .panel-heading {
      font-weight: 500;
    }

    .panel-block {
      background-color: #fff;
    }
  }
</style>