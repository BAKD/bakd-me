<template>
  <section>

    <nav class="panel has-shadow">
      <div class="panel-block is-size-4">
        <i class="la la-edit is-size-5" />&nbsp;<span class="is-size-5 is-bold">Your Profile</span>
      </div>
      <div class="panel-block" style="padding: 35px;">

        <form class="control form" @submit.prevent="update" @keyup="form.onKeydown($event)">

          <!-- <bakd-alert-success :form="form" :message="$t('info_updated')" has-icon /> -->
          
          <!-- Name -->
          <bakd-input 
            name="name" 
            type="name" 
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

          <!-- Username -->
          <bakd-input 
            name="username" 
            type="text" 
            :placeholder="$t('Username')" 
            :label="$t('Username')" 
            :form="form" 
            v-model="form.username" />


          <!-- Type -->
          <b-field label="Type">
              <b-select expanded placeholder="User Type" name="type">
                  <option
                      v-for="option in userTypes"
                      :value="option.id"
                      :key="option.id">
                      {{ option.name.replace('_', ' ') | capitalize }}
                  </option>
              </b-select>
          </b-field>


          <!-- Title -->
          <bakd-input 
            name="title" 
            type="text" 
            :placeholder="$t('Title')" 
            :label="$t('Title')" 
            :form="form" 
            v-model="form.title" />


          <!-- Bio -->
          <bakd-input 
            name="bio" 
            type="textarea" 
            :placeholder="$t('Biography')" 
            :label="$t('Biography')" 
            :form="form" 
            v-model="form.bio" />


          <!-- Email -->
          <bakd-input 
            name="wallet" 
            type="text" 
            :placeholder="$t('Wallet')" 
            :label="$t('Wallet')" 
            :form="form" 
            v-model="form.wallet" />

          <!-- Website -->
          <bakd-input 
            name="website" 
            type="text" 
            :placeholder="$t('Website')" 
            :label="$t('Website')" 
            :form="form" 
            v-model="form.website" />

        </form>

      </div>
    </nav>

    <!-- Submit Button -->
    <div class="has-text-centered is-100">
      <button class="button is-large is-primary is-rounded is-wide" @click="update" :loading="form.busy" style="margin-bottom: 10px; margin-top: 30px;">
        <span class="is-size-6">{{ $t('update') }}</span>
      </button>
    </div>

    <br />
    <br />

  </section>
</template>

<script>
import Form from 'vform'
import BakdInput from '~/components/elements/BakdInput'
import BakdAlertSuccess from '~/components/elements/BakdAlertSuccess'
import { mapGetters } from 'vuex'

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
      name: '',
      email: '',
      type: [
        'INVESTOR'
      ],
      title: '',
      bio: '',
      username: '',
      wallet: '',
      website: '',
    }),
    userTypes: []
  }),

  computed: mapGetters({
    user: 'auth/user'
  }),

  created () {
    // Fill the form with user data.
    this.form.keys().forEach(key => {
      this.form[key] = this.user[key]
    })
  },
  
  mounted: async function() {
    this.$root.isLoading = false;
    try {
      var { data } = await axios.get('/api/user/types')
      this.userTypes = data.data
    } catch (err) {
      alert(err)
    }
  },

  methods: {
    async update () {
      try {
        const { data } = await this.form.patch('/api/settings/profile')

        this.$store.dispatch('auth/updateUser', { user: data.data })

        helpers.toast({ type: data.status, title: data.message })
      } catch (err) {
        let response = err.response
  
        if (response.status === 400) {
          helpers.toast({ title: response.data.email || 'Please check the form and try again.', type: 'error'});
        } else {
          let errors   = response.data.errors
          let field    = Object.keys(errors)[0]
          let messages = errors[field]

          helpers.toast({ title: messages[0] || 'Please check the form and try again.', type: 'error'});
        }
      }
    }
  }
}
</script>
