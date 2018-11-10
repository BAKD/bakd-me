<template>
  <div class="main-layout">
    <navbar/>
    <div class="container-fluid" style="padding-top: 65px;">
      <transition name="page" mode="out-in" @after-enter="afterEnter" appear>
        <child/>
      </transition>
    </div>
    <back-to-top></back-to-top>
    <bakd-footer/>
    <bakd-footer-copyright/>
  </div>
</template>

<script>
import Navbar from '~/components/layout/Navbar'
import NavbarHeader from '~/components/layout/NavbarHeader'
import BakdHeader from '~/components/layout/BakdHeader'
import BakdFooter from '~/components/layout/BakdFooter'
import BakdFooterCopyright from '~/components/layout/BakdFooterCopyright'
import { mapGetters } from 'vuex'

export default {
  name: 'MainLayout',
  scrollToTop: true,
  
  // props: {
  //   hasHeader: {
  //     type: Boolean,
  //     default: false
  //   }
  // },
  
  computed: mapGetters({
    user: 'auth/user'
  }),

  data: () => ({
    hasHeader: true
  }),

  methods: {
    afterEnter () {
      this.$root.$emit('scrollAfterEnter');
    },
  },

  components: {
    Navbar,
    NavbarHeader,
    BakdHeader,
    BakdFooter,
    BakdFooterCopyright
  }
}
</script>
