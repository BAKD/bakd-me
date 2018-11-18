<template>
  <section>
      <bakd-bounty-approved-claims />
      <bakd-bounty-pending-claims />
      <bakd-bounty-rejected-claims />
      <bakd-bounty-reward-types />
      <bakd-bounty-claim-instructions />
      <br />
  </section>
</template>

<script>
import axios from 'axios'
import swal from 'sweetalert2'

// Bounty Components
import BakdBountyClaimInstructions from '~/components/bounty/BakdBountyClaimInstructions'
import BakdBountyRewardTypes from '~/components/bounty/BakdBountyRewardTypes'
import BakdBountyPendingClaims from '~/components/bounty/BakdBountyPendingClaims'
import BakdBountyApprovedClaims from '~/components/bounty/BakdBountyApprovedClaims'
import BakdBountyRejectedClaims from '~/components/bounty/BakdBountyRejectedClaims'
import BakdBountyClaimsStats from '~/components/bounty/BakdBountyClaimsStats'

export default {
  layout: 'account',
  middleware: 'auth',

  components: {
    BakdBountyClaimInstructions,
    BakdBountyRewardTypes,
    BakdBountyPendingClaims,
    BakdBountyApprovedClaims,
    BakdBountyRejectedClaims,
    BakdBountyClaimsStats
  },

  mounted () {
    new WOW().init()
    this.$root.isLoading = false;   
  },
  
  metaInfo () {
    return { title: this.$t('bounty_dashboard') }
  },

  data() {
    return {
      isReady: false,
      isLoading: true,
      approvedClaims: [],
      pendingClaims: [],
      rejectedClaims: [],
      stats: {}
    }
  },

  computed: {
    reward: function () {
      if (this.isReady && this.isStakesBounty) {
        return this.bounty.reward_total.toLocaleString()
      }

      return this.isReady ? this.bounty.reward.toLocaleString() : '-'
    },

    isStakesBounty: function () {
      if (this.isReady && this.bounty.bounty_reward_type.name.toLowerCase() === 'stakes') {
        return true
      }

      return false;
    }
  },

  methods: {
    fetchData: function () {
      var self = this;
      this.isLoading = true;
      axios
        .get('/api/bounty/dashboard')
        .then(function(response) { 
          self.claims = response.data.claims
          self.isLoading = false
          self.isReady = true
        })
    },
  }
}
</script>