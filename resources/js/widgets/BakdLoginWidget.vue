<template>
  <div class="widget">

    <p class="has-text-left title is-size-5">
      Login
    </p>

    <div class="box">

      <!-- <p class="title is-size-5"><fa icon="key"/> Login</p> -->
      <!-- <p class="subtitle is-size-7">Login to view campaigns</p> -->
      <!-- <hr/> -->

     <form @submit.prevent="login" class="control form" style="padding: 5px;" @keyup="form.onKeydown($event)">

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
        <!-- <b-checkbox v-model="remember" name="remember" class="is-size-7">{{ $t('remember_me') }}</b-checkbox> -->
        
        <!-- Forgot Password Link -->
        <!-- <router-link :to="{ name: 'password.request' }" class="is-size-7 is-pulled-right"> -->
          <!-- {{ $t('forgot_password') }} -->
        <!-- </router-link> -->

        <!-- <hr style="margin: 15px 0;" /> -->
        
        <hr />

        <div class="box-footer">

          <!-- Submit Button -->
          <v-button class="is-rounded is-medium is-wide" :loading="form.busy" :disabled="this.form.errors.any()" style="margin-bottom: 10px;">
            <span class="is-size-6">{{ $t('login') }}</span>
          </v-button>

          <!-- GitHub Login Button -->
          <login-with-github labelClass="is-size-6" class="is-rounded is-medium is-wide" />
        </div>

      </form>


    </div>
  </div>
</template>

<script>
import Form from 'vform'
import LoginWithGithub from '~/components/elements/LoginWithGithub'
import BakdInput from '~/components/elements/BakdInput'

export default {
	name: 'BakdLoginWidget',
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


</style>