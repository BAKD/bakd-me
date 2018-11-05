<template>
  <div class="columns is-centered level" style="height: 75vh;">
    <div class="column is-two-fifths">
      <div class="level-item">
        <panel :title="$t('reset_password')" style="width: 100%;" class="reset-wrapper is-v-centered">

          <form @submit.prevent="send" class="control form" style="padding: 5px;" @keyup="keyupHandler">
            <alert-success :form="form" :message="status"/>

              <!-- Email -->
              <bakd-input 
                name="email" 
                type="email" 
                :placeholder="$t('email')"
                :label="$t('email')" 
                :form="form" 
                v-model="form.email" />

            <hr style="margin: 15px 0;" />

            <!-- Submit Button -->
            <v-button class="is-fullwidth" :loading="form.busy" :disabled="this.form.errors.any()" style="margin-bottom: 10px;">
              {{ $t('send_password_reset_link') }}
            </v-button>

          </form>
        </panel>
      </div>
    </div>
  </div>
</template>

<script>
import Form from 'vform'
import BakdInput from '~/components/elements/BakdInput'

export default {
  middleware: 'guest',

  components: {
    BakdInput
  },

  metaInfo () {
    return { title: this.$t('reset_password') }
  },

  data: () => ({
    status: '',
    form: new Form({
      email: ''
    })
  }),

  methods: {
    keyupHandler (event) {
      if (event.keyCode !== 13) {
        this.form.onKeydown(event)
      }
    },

    send () {
      this.form.post('/api/password/email')
        .then((response) => this.status = response.data.status)
        .catch((err) => {
          let response = err.response
          if (response.status === 400) {
            window.helpers.snackbar(response.data.email, 'error')
          } else if (response.status === 530) {
            window.helpers.snackbar('Unable to send password reset email. Please try again or contact an administrator if the problem persists.', 'error')
          } else {
              let errors   = response.data.errors
              let field    = Object.keys(errors)[0]
              let messages = errors[field]
            
              window.helpers.snackbar(messages[0], 'error')
          }
      })
    }
  }
}
</script>

<style scoped lang="scss">
.reset-wrapper {
  min-width: 420px;
  margin: 0 auto;
  max-width: 500px;
  
  @media (max-width: 768px) {
    margin-top: 30px;
  }

  @media (max-width: 421px) {
    min-width: unset;
    width: 100%;
  }
}
</style>