<template>
  <button :type="nativeType" :disabled="loading" :class="{
    [`${type}`]: true,
    'btn-block': block,
    'is-large': large,
    'is-loading': loading
  }" class="button">
    <slot/>
  </button>
</template>

<script>
export default {
  name: 'VButton',

  props: {
    type: {
      type: String,
      default: 'is-primary'
    },

    nativeType: {
      type: String,
      default: 'submit'
    },

    loading: {
      type: Boolean,
      default: false
    },

    block: {
      type: Boolean,
      default: false
    },

    large: {
      type: Boolean,
      default: false
    }
  }
}
</script>
