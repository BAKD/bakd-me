<template>
  <div class="main-layout">
    <navbar/>
    <bakd-page-header class="has-text-centered is-small" style="margin-top: 65px;">
       <h1 class="title is-white wow fadeInRight is-size-2">Member <span class="is-primary">Dashboard</span></h1>
       <h2 class="hidden-mobile subtitle is-white is-size-5 wow fadeInLeft">Find team members for your next project or just meet new people</h2>
    </bakd-page-header>
    <div class="container" style="margin-top: 30px;">
      <div class="columns">

        <div class="column is-3 is-clipped">
          <div class="sticky-menu">
            <bakd-account-sidebar />
          </div>
        </div>

        <div class="column is-9" id="main-content">
          <bakd-account-breadcrumbs/>
          <child @after-enter="afterEnter" />
        </div>

      </div>
    </div>
    <back-to-top/>
    <bakd-footer></bakd-footer>
    <bakd-footer-copyright/>
  </div>
</template>

<script>
import Navbar from '~/components/layout/Navbar'
import NavbarHeader from '~/components/layout/NavbarHeader'
import BakdHeader from '~/components/layout/BakdHeader'
import BakdFooter from '~/components/layout/BakdFooter'
import BakdFooterCopyright from '~/components/layout/BakdFooterCopyright'
import BakdAccountSidebar from '~/layouts/partials/account-sidebar'

export default {
  name: 'AccountLayout',
  middleware: 'auth',
  
  data() {
    return {
      offset: { top: 330, bottom: 60 }
    }
  },

  methods: {
    afterEnter () {
      this.$root.$emit('scrollAfterEnter');
      this.$root.isLoading = false;   
    },
  },

  components: {
    Navbar,
    NavbarHeader,
    BakdHeader,
    BakdFooter,
    BakdFooterCopyright,
    BakdAccountSidebar
  }
}
</script>

<style lang="scss">
  .sticky-menu {
     width: 315px;
  }

  .account-sidebar {
     width: 100%; 
     width: 315px;
  }

  @media (max-width: 1471px) {
    .sticky-menu {
      width: 273px;
    }

    .account-sidebar {
     max-width: 273px;
    }
  }


  @media (max-width: 1279px) {
    .sticky-menu {
      width: 230px;
    }

    .account-sidebar {
     max-width: 230px;
    }
  }

  @media (max-width: 996px) {
    .sticky-menu {
      position: relative;
      width: auto;
    }
    .account-sidebar {
      width: auto;
      max-width: unset;
    }
  }
</style>