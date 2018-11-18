<template>
  <b-field :label="label"
      :label-for="name"
      :type="{ 'is-danger has-text-danger': form.errors.has(name) ||  errors.has(name)  }"
      :message="form.errors.get(name) || errors.first(name)">
      <b-input :type="type"
          :name="name"
          :placeholder="placeholder"
          :class="{ 'is-danger has-text-danger': form.errors.has(name) ||  errors.has(name) }"
          v-model="form[name]"
          :password-reveal="passwordReveal"
          :expanded="expanded"
          :required="required"
          :form="form"
          :minlength="minlength"
          :maxlength="maxlength"
          :rows="rows"
          v-validate="validate"
          >
      </b-input>
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
    },
    required: {
      type: Boolean,
      default: false
    },
    minlength: {
      type: String
    },
    maxlength: {
      type: String
    },
    rows: {
      type: Number
    },
    validate: {
      type: String,
      default: ''
    }
  },
}
</script>