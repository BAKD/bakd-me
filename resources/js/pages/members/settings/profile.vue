<template>
    <div class="level-item">
      <panel :title="$t('your_info')" style="width: 100%;">
        <form class="control form" @submit.prevent="update" @keyup="form.onKeydown($event)">

        <bakd-alert-success :form="form" :message="$t('info_updated')" has-icon />
        
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
      email: ''
    })
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

  methods: {
    async update () {
      const { data } = await this.form.patch('/api/settings/profile')

      this.$store.dispatch('auth/updateUser', { user: data })
    }
  }
}
</script>
