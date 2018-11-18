<template>
  <div class="main-layout">
    <navbar/>
    <div class="container" style="padding-top: 80px;">
      <div class="columns">

        <!-- SIDEBAR -->
        <div class="column is-3">
          <bakd-account-sidebar/>
        </div>

        <!-- MAIN -->
        <div class="column is-9">
          <div class="breadcrumb" aria-label="breadcrumbs">
            <ul>
              <li><a href="#">Home</a></li>
              <li><a href="#">Members</a></li>
              <li class="is-active"><a href="#" aria-current="page">Dashboard</a></li>
            </ul>
          </div>
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
