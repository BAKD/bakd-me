<template>
  <div class="main-layout">
    <navbar/>
    <!-- <navbar-header/> -->

  <!--   <section class="hero" style="background-image: url(''); background-position: center; background-size: cover;">
      <div class="hero-body">
        <div class="container">
          <h1 class="title"></h1>
          <h2 class="subtitle"></h2>
        </div>
      </div>
    </section> -->
      
    <div class="container" style="padding-top: 90px;">
      <child/>
    </div>
    <back-to-top/>
    <bakd-footer/>
    <bakd-footer-copyright/>
  </div>
</template>

<script>
import Navbar from '~/components/layout/Navbar'
import NavbarHeader from '~/components/layout/NavbarHeader'
import BakdFooter from '~/components/layout/BakdFooter'
import BakdFooterCopyright from '~/components/layout/BakdFooterCopyright'

export default {
  name: 'SocialLayout',

  components: {
    Navbar,
    NavbarHeader,
    BakdFooter,
    BakdFooterCopyright
  }
}
</script>
