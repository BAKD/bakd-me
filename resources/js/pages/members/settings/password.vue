<template>
  <section>
    <nav class="panel has-shadow">
      <div class="panel-block is-size-4">
        <i class="la la-lock is-size-4" />&nbsp;<span class="is-size-5 is-bold">Update Password</span>
          <hr style="margin: 15px 0;" />
      </div>
      <div class="panel-block" style="padding: 35px;">
        <form class="control form" @submit.prevent="update" @keyup="form.onKeydown($event)">

          <!-- <bakd-alert-success :form="form" :message="$t('password_updated')"/> -->

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

        </form>
      </div>
    </nav>
    
    <!-- Submit Button -->
    <div class="has-text-centered is-100">
      <button class="button is-primary is-large is-rounded is-wide" @click.prevent="update" :loading="form.busy" style="margin-bottom: 10px; margin-top: 30px;">
        <span class="is-size-6">{{ $t('update') }}</span>
      </button>
    </div>

  </section>
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

  mounted() {
    this.$root.isLoading = false;
  },

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
            helpers.toast({ title: response.data.email || 'Please check the form and try again.', type: 'error'});
          } else {
            let errors   = response.data.errors
            let field    = Object.keys(errors)[0]
            let messages = errors[field]

            helpers.toast({ title: messages[0] || 'Please check the form and try again.', type: 'error'});
          }
        })
    }
  }
}
</script>
