<template>
  <div class="level-item">
    <panel :title="$t('your_password')" style="width: 100%;">
      <form class="control form" @submit.prevent="update" @keyup="form.onKeydown($event)">

        <bakd-alert-success :form="form" :message="$t('password_updated')"/>

        <!-- Password -->
        <bakd-input 
          name="password" 
          type="password" 
          :placeholder="$t('new_password')" 
          :label="$t('password')" 
          :form="form" 
          password-reveal
          v-model="form.password" />

        <!-- Password Confirmation -->
        <bakd-input 
          name="password_confirmation" 
          type="password" 
          :placeholder="$t('confirm_password')" 
          :label="$t('confirm_password')" 
          :form="form" 
          password-reveal
          v-model="form.password_confirmation" />

        <hr style="margin: 15px 0;" />

        <!-- Submit Button -->
        <v-button class="is-fullwidth" :loading="form.busy" style="margin-bottom: 10px;">
          {{ $t('update') }}
        </v-button>
      </form>

    </panel>
  </div>
</template>

<script>
import Form from 'vform'
import BakdAlertSuccess from '~/components/elements/BakdAlertSuccess'
import BakdInput from '~/components/elements/BakdInput'

export default {
  layout: 'account',
 
  scrollToTop: false,

  components: {
    BakdInput,
    BakdAlertSuccess
  },

  metaInfo () {
    return { title: this.$t('settings') }
  },

  data: () => ({
    form: new Form({
      password: '',
      password_confirmation: ''
    })
  }),

  methods: {
    update () {
      this.form.patch('/api/settings/password')
        .then((response) => {
          this.status = response.data.status
          this.form.reset()
        })
        .catch((err) => {
          let response = err.response
          if (response.status === 400) {
            window.helpers.snackbar(response.data.email || 'Please check the form and try again.', 'error');
          } else {
            let errors   = response.data.errors
            let field    = Object.keys(errors)[0]
            let messages = errors[field]

            window.helpers.snackbar(messages[0] || 'Please check the form and try again.', 'error');
          }
        })
    }
  }
}
</script>
