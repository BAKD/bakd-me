<template>
  <div class="widget has-text-centered" id="random-bounty">
    <p class="has-text-left title is-size-5">
      Random Bounty
    </p>
     <div class="box" ref="element" style="position: relative;" v-if="isReady">
      <b-loading animation="fade" :is-full-page="false" :active.sync="isLoading" :can-cancel="false" style="z-index: 9999;" />
      <div class="is-pulled-right">
        <b-tooltip type="is-dark" label="Refresh">
          <div class="icon has-hand-cursor">
            <i class="la la-refresh" @click="refreshBounty" />
          </div>
        </b-tooltip>
      </div>
      <img :src="'/storage/' + bounty.image" class="is-margin-centered is-v-centered image is-rounded" style="padding: 5px 30px 15px 30px;" />
      <h2 class="title is-size-5">
        {{ bounty.name || '' | uppercase }}
      </h2>
      <h3 class="subtitle is-size-6 has-text-grey-light">
        {{ bounty.type.name || '' }} Bounty
      </h3>
      <p class="is-size-3">
        <span class="is-bold">
          {{ reward }}<i class="is-bakd-coins is-2x"/>
        </span>
      </p>
      <p class="subtitle is-size-7 is-bold">
        {{ bounty.bounty_reward_type.name || '' | uppercase }} BOUNTY
      </p>
      <div class="box-footer">
        <router-link :to="{ name: 'bounties.view', params: { id: bounty.id } }" class="button is-primary is-fullwidth is-rounded is-outlined--off is-normal" style="max-width: 140px; margin: 20px auto 5px;">
          <span class="is-size-7"><i class="la la-plus" /> View Bounty</span>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import swal from 'sweetalert2'

export default {
  data() {
    return {
      isReady: false,
      isLoading: true,
      bounty: {},
    }
  },

  computed: {
    reward: function () {
      if (this.bounty.bounty_reward_type.name.toLowerCase() === 'stakes') {
        return this.bounty.reward_total.toLocaleString()
      }

      return this.bounty.reward.toLocaleString()
    }
  },

  methods: {
    followMember: function (event, memberId) {
      console.log(event);
      swal({
        type: 'info',
        title: 'Coming soon',
        text: 'action:follow, user:' + memberId
      })
    },

    viewMember: function (event, bountyId) {
      this.$router.push({ name: 'bounties.show', params: { id: bountyId }})
    },

    fetchData: function () {
      var self = this;
      this.isLoading = true;
      axios
        .post('/api/bounty/random', { limit: 1 })
        .then(function(response) { 
          self.bounty = response.data[0]
          self.isLoading = false;
          self.isReady = true
        })
    },

    refreshBounty: function () {
      this.fetchData()
    }
  },

  beforeMount () {
      this.fetchData()
  }
}
</script>

<style lang="scss" scoped">
  #random-bounty {
    transition: all .2s ease;
  }
</style>