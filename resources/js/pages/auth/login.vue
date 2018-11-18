<template>
  <div class="columns is-centered level" style="height: 66vh; min-height: 420px;">
    <div class="column is-two-fifths login-page-wrapper">
      <div class="level-item">
        <panel :title="$t('login')" style="width: 100%;" class="login-wrapper has-shadow">
          <form @submit.prevent="login" name="login" class="control form" style="padding: 5px;" @keyup="form.onKeydown($event)">

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

            <!-- Remember Me -->
            <b-checkbox v-model="remember" name="remember" class="is-size-7">{{ $t('remember_me') }}</b-checkbox>
            
            <!-- Forgot Password Link -->
            <router-link :to="{ name: 'password.request' }" class="is-size-7 is-pulled-right">
              {{ $t('forgot_password') }}
            </router-link>

            <hr style="margin: 15px 0;" />
            
            <!-- Submit Button -->
            <v-button class="is-fullwidth" :loading="form.busy" :disabled="form.errors.any()" style="margin-bottom: 10px;">
              {{ $t('login') }}
            </v-button>

            <!-- GitHub Login Button -->
            <login-with-github class="is-fullwidth" />

          </form>
        </panel>
      </div>
    </div>
  </div>
</template>

<script>
import Form from 'vform'
import LoginWithGithub from '~/components/elements/LoginWithGithub'
import BakdInput from '~/components/elements/BakdInput'

export default {
  layout: 'default',  
  middleware: 'guest',

  components: {
    BakdInput,
    LoginWithGithub
  },

  metaInfo () {
    return { title: this.$t('login') }
  },

  data: () => ({
    form: new Form({
      email: '',
      password: ''
    }),
    remember: false,
    disabled: false
  }),

  methods: {
    async login () {
      try {
        const { data } = await this.form.post('/api/login')

        this.$store.dispatch('auth/saveToken', {
          token: data.token,
          remember: this.remember
        })

        await this.$store.dispatch('auth/fetchUser')

        this.$router.push({ name: 'members.dashboard' })
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

.login-wrapper {
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