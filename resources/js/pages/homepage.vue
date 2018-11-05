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

    <section class="section how-it-works">
      <bakd-section-title title="How it Works" subtitle="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias natus nulla asperiores incidunt."/>
        <div class="container">
          <div class="tile wow fadeInUp" v-for="n in 3" :key="n">
            <article class="media">
              <figure class="media-left">
                <img src="https://via.placeholder.com/120" />
              </figure>
              <div class="media-content is-v-centered">
                <p class="title is-size-5 is-bold is-marginless">
                  Step {{ n }} - Lorem ipsum dolor sit amet
                </p>
                <p style="line-height: 26px;">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic necessitatibus sit soluta, odit aspernatur eos iste laborum ipsa harum quidem itaque aliquid modi quis, dolores impedit odio, ipsam, id incidunt. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Impedit iusto sit modi quam officiis dolore consequatur officia accusantium? Voluptates magni quia ex praesentium illum facilis harum iste ut possimus neque!
                </p>
              </div>
            </article>
            <hr/>
          </div>
          <div class="buttons has-text-centered is-100">
            <router-link :to="{ name: 'campaigns.create' }" class="button is-large is-primary is-wide is-rounded is-margin-centered">
              <span class="is-size-6">Start a Campaign</span>
            </router-link>
          </div>
          <br />
        </div>
      </section>



  </div>
</template>

<script>
import Form from 'vform'
import { mapGetters } from 'vuex'

// Main Components/Partials
import BakdPostMessage from '~/components/common/BakdPostMessage'
import BakdSectionTitle from '~/components/common/BakdSectionTitle'
import BakdFeaturedProject from '~/components/common/BakdFeaturedProject'
import BakdPostedMessage from '~/components/common/BakdPostedMessage'
import BakdFeaturedMembers from '~/components/common/BakdFeaturedMembers'
import BakdMainSearchbar from '~/components/common/BakdMainSearchbar'

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
    BakdSectionTitle,
    HomepageRealtimeTab,
    HomepageCampaignsTab,
    HomepageMembersTab,
    HomepageNewsTab,
    BakdFeaturedMembers,
    BakdHomepageMenuWidget,
    BakdMainSearchbar,
    BackToTop
  },

  metaInfo () {
    return { title: this.$t('home') }
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

<style lang="scss">
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
  // max-width: 1100px;
  // width: 100%;
  padding: 10px 40px;

  .tile {
    margin: 0 auto;
    max-width: 900px;
    width: 100%;
    margin-bottom: 70px;
  }
}
</style>
