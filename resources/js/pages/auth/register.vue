<template>
  <div class="columns is-centered level" style="height: 75vh;">
    <div class="column is-two-fifths register-wrapper">
      <div class="level-item" style="margin: 30px 10px;">
        <panel :title="$t('register')" style="width: 100%;">
          <form class="control form" @submit.prevent="register" @keyup="form.onKeydown($event)">

            <!-- Name -->
            <bakd-input 
              name="name" 
              type="text" 
              :placeholder="$t('name')"
              :label="$t('name')" 
              :form="form" 
              v-model="form.name" />

            <!-- Email -->
            <bakd-input 
              name="email" 
              type="email" 
              :placeholder="$t('email')"
              :label="$t('email')" 
              :form="form" 
              v-model="form.email" />

            <!-- Password -->
            <bakd-input 
              name="password" 
              type="password" 
              :placeholder="$t('password')"
              :label="$t('password')" 
              :form="form" 
              password-reveal
              v-model="form.password" />

            <!-- Password Confirm -->
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
              {{ $t('register') }}
            </v-button>

            <!-- GitHub Register Button -->
            <login-with-github label="Register with GitHub" class="is-fullwidth" />

          </form>
        </panel>
      </div>
    </div>
  </div>
</template>

<script>
import Form from 'vform'
import BakdInput from '~/components/elements/BakdInput'
import LoginWithGithub from '~/components/elements/LoginWithGithub'

export default {
  layout: 'default',
  middleware: 'guest',

  components: {
    BakdInput,
    LoginWithGithub
  },

  metaInfo () {
    return { title: this.$t('register') }
  },

  data: () => ({
    form: new Form({
      name: '',
      email: '',
      password: '',
      password_confirmation: ''
    })
  }),

  methods: {
    async register () {
      try {
        const { data } = await this.form.post('/api/register')

        const { data: { token } } = await this.form.post('/api/login')

        this.$store.dispatch('auth/saveToken', { token })

        await this.$store.dispatch('auth/updateUser', { user: data })

        this.$router.push({ name: 'home' })
        
      } catch (err) {
        let errors   = err.response.data.errors,
            field    = Object.keys(errors)[0],
            messages = errors[field];

        window.helpers.snackbar(messages[0], 'error')
      }
    }
  }
}
</script>

<style scoped lang="scss">
form {
  padding: 10px 5px;
}

.columns {
  min-height: 640px;
}

.register-wrapper {
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