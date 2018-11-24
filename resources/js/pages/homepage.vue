<template>
  <div class="container-fluid">

    <bakd-main-searchbar/>

    <div class="container">

      <div class="columns">
        <!-- START LEFT COLUMN -->
        <div class="column is-3 hidden-mobile">
          <!-- AUTH'D SIDEBAR -->
          <template v-if="authenticated">
            <bakd-my-account-widget/>
            <bakd-homepage-menu-widget/>
            <bakd-ad-widget/>
          </template>

          <!-- NON AUTHED SIDEBAR -->
          <template v-else>
            <bakd-login-widget/>
            <bakd-random-bounty-widget/>
            <bakd-ad-widget/>
          </template>
        </div>
        <!-- END LEFT COLUMN -->

        <!-- MAIN CENTER COLUMN -->
        <div class="column is-6 is-paddingless">
          <b-tabs class="is-centered">
            <b-tab-item label="Realtime" icon="comment">
              <homepage-realtime-tab/>
            </b-tab-item>
            <b-tab-item label="Campaigns" icon="chart-bar">
              <homepage-campaigns-tab/>
            </b-tab-item>
            <b-tab-item label="Members" icon="account">
              <homepage-members-tab/>
            </b-tab-item>
            <b-tab-item label="News" icon="newspaper">
              <homepage-news-tab/>
            </b-tab-item>
          </b-tabs>
        </div>
        <!-- END MAIN CENTER COLUMN -->


        <!-- START RIGHT COLUMN -->
        <div class="column is-3 has-text-centered sidebar">
          <!-- AUTH'D SIDEBAR -->
          <template v-if="authenticated">
            <bakd-random-bounty-widget/>
            <bakd-members-widget/>
            <bakd-trending-campaigns-widget/>
          </template>

          <template v-else>
            <bakd-members-widget/>
            <bakd-ad-widget/>
            <bakd-trending-campaigns-widget/>
          </template>
        </div>
        <!-- END RIGHT COLUMN -->

      </div>
    </div>

    <bakd-featured-members/>

    <section class="section newsletter-section" style="margin-top: -40px;">
      <div class="container">
        
        <div class="level">
          <div class="level-left has-text-centered is-margin-centered is-v-centered">
            <img src="https://via.placeholder.com/150" style="padding-right: 20px; margin: 20px 0;" />
          </div>
          <div class="level-content is-v-centered">
            <span style="font-size: 72px;"></span>
            <p class="title is-size-4" style="margin-top: 20px;">
              Free Resources
            </p>
            <p style="padding-right: 20px; margin: 0 0 20px 0;">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem, veniam, eius. Quam temporibus quisquam veritatis cupiditate saepe rerum dicta recusandae. Nam, blanditiis, voluptatum. Aperiam sequi, ipsum at temporibus labore magni. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus mollitia molestiae qui sunt asperiores deserunt, doloremque maiores consequatur vel vero, ratione corrupti voluptatum obcaecati, neque cupiditate magni velit dolorum nisi.
            </p>
          </div>
          <div class="level-right has-text-centered is-v-centered is-margin-centered">
            <router-link :to="{ name: 'resources.index' }" class="button is-outlined has-shadow is-rounded is-large is-primary is-wide is-margin-centered" style="margin: 20px 0;">
              <span class="is-size-6"><i class="la la-book is-size-5" /> Resource Directory</span>
            </router-link>
          </div>
        </div>

      </div>
    </section>

    <bakd-how-it-works/>

    <bakd-site-stats/>

  </div>
</template>

<script>
import Form from 'vform'
import { mapGetters } from 'vuex'

// Main Components/Partials
import BakdPostMessage from '~/components/common/BakdPostMessage'
import BakdFeaturedProject from '~/components/common/BakdFeaturedProject'
import BakdPostedMessage from '~/components/common/BakdPostedMessage'
import BakdFeaturedMembers from '~/components/common/BakdFeaturedMembers'
import BakdMainSearchbar from '~/components/common/BakdMainSearchbar'
import BakdHowItWorks from '~/components/common/BakdHowItWorks'

// Elements
import BakdInput from '~/components/elements/BakdInput'
import BackToTop from '~/components/elements/BackToTop'

// Widgets
import BakdAdWidget from '~/widgets/BakdAdWidget'
import BakdLoginWidget from '~/widgets/BakdLoginWidget'
import BakdMembersWidget from '~/widgets/BakdMembersWidget'
import BakdTrendingCampaignsWidget from '~/widgets/BakdTrendingCampaignsWidget'
import BakdRandomBountyWidget from '~/widgets/BakdRandomBountyWidget'
import BakdMyAccountWidget from '~/widgets/BakdMyAccountWidget'
import BakdHomepageMenuWidget from '~/widgets/BakdHomepageMenuWidget'

// Tabs
import HomepageCampaignsTab from '~/pages/partials/HomepageCampaignsTab'
import HomepageMembersTab from '~/pages/partials/HomepageMembersTab'
import HomepageNewsTab from '~/pages/partials/HomepageNewsTab'
import HomepageRealtimeTab from '~/pages/partials/HomepageRealtimeTab'

export default {
  layout: 'home',
  hasHeader: true,
  scrollToTop: true,

  components: {
    BakdInput,
    BakdPostMessage,
    BakdAdWidget,
    BakdLoginWidget,
    BakdMembersWidget,
    BakdMyAccountWidget,
    BakdRandomBountyWidget,
    BakdTrendingCampaignsWidget,
    BakdPostedMessage,
    BakdFeaturedProject,
    HomepageRealtimeTab,
    HomepageCampaignsTab,
    HomepageMembersTab,
    HomepageNewsTab,
    BakdFeaturedMembers,
    BakdHomepageMenuWidget,
    BakdMainSearchbar,
    BakdHowItWorks,
    BackToTop
  },

  metaInfo () {
    return { title: this.$t('Home') }
  },

  data: () => ({
    form: new Form({
      email: ''
    }),
    title: window.config.appName
  }),

  mounted () {
    new WOW().init()
  },

  computed: mapGetters({
    authenticated: 'auth/check'
  })
}
</script>

<style lang="scss" scoped>
.b-tabs:not(:last-child) {
    margin-bottom: -15px;
}

.sidebar {
  margin-bottom: 40px;
}

hr {
  color: #dbdbdb;
}

.top-right {
  position: absolute;
  right: 10px;
  top: 18px;
}

.title {
  font-size: 85px;
}

.how-it-works {
  margin: 0 auto;
  padding: 10px 40px;

  .tile {
    margin: 0 auto;
    max-width: 900px;
    width: 100%;
    margin-bottom: 70px;
  }
}
</style>
