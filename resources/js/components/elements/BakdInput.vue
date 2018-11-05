<template>
  <b-field :label="label"
      :label-for="name"
      :type="{ 'is-danger has-text-danger': form.errors.has(name) }"
      :message="form.errors.get(name)">
      <b-input :type="type"
          :name="name"
          :placeholder="placeholder"
          :class="{ 'is-danger has-text-danger': form.errors.has(name) }"
          v-model="form[name]"
          :password-reveal="passwordReveal"
          :expanded="expanded">
      </b-input>
      <!-- <has-error :form="form" field="email" /> -->
  </b-field>
</template>

<script>
import Form from 'vform'

export default {
  name: 'BakdInput',

  props: {
    type: {
      type: String,
      required: true
    },
    name: {
      type: String,
      required: true
    },
    form: {
      type: Object,
      required: true
    },
    label: {
      type: String
    },
    placeholder: {
      type: String
    },
    passwordReveal: {
      type: Boolean,
      default: false
    },
    expanded: {
      type: Boolean,
      default: false
    }
  },
}
</script>

<style lang="scss">

</style>