<template>
  <section>
      <bakd-bounty-claims-stats />
      <bakd-bounty-approved-claims />
      <bakd-bounty-pending-claims />
      <bakd-bounty-rejected-claims />
      <bakd-bounty-reward-types />
      <bakd-bounty-claim-instructions />
      <br />
  </section>
</template>

<script>
// Bounty Components
import BakdBountyClaimInstructions from '~/components/bounty/BakdBountyClaimInstructions'
import BakdBountyRewardTypes from '~/components/bounty/BakdBountyRewardTypes'
import BakdBountyPendingClaims from '~/components/bounty/BakdBountyPendingClaims'
import BakdBountyApprovedClaims from '~/components/bounty/BakdBountyApprovedClaims'
import BakdBountyRejectedClaims from '~/components/bounty/BakdBountyRejectedClaims'
import BakdBountyClaimsStats from '~/components/bounty/BakdBountyClaimsStats'
import BakdPageHeader from '~/components/layout/BakdPageHeader'

export default {
  layout: 'account',
  middleware: 'auth',

  data() {
    return {
      
    }
  },

  components: {
    BakdBountyClaimInstructions,
    BakdBountyRewardTypes,
    BakdBountyPendingClaims,
    BakdBountyApprovedClaims,
    BakdBountyRejectedClaims,
    BakdBountyClaimsStats,
    BakdPageHeader
  },

  mounted () {
    new WOW().init()
    this.$root.isLoading = false
  },
  
  metaInfo () {
    return { title: this.$t('bounty_dashboard') }
  },
}
</script>