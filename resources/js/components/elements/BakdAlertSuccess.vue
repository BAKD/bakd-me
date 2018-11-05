<template>
  <b-notification v-if="form.successful" type="is-success" :has-icon="hasIcon">
    <slot>
      <div v-html="message"/>
    </slot>
  </b-notification>

  <!-- <div v-if="form.successful" class="notification is-success" role="alert" :has-icon="hasIcon">
    <button v-if="dismissible" @click="dismiss" type="button" class="delete" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <slot>
      <div v-html="message"/>
    </slot>
  </div> -->
</template>

<script>
import BakdAlert from './BakdAlert'

export default {
  name: 'bakd-alert-success',

  extends: BakdAlert,

  props: {
    message: { type: String, default: '' },
    hasIcon: { type: Boolean, default: false }
  },

  methods: {
    dismiss () {
      if (this.dismissible) {
        this.form.clear()
      }
    }
  }
}
</script>
