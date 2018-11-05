import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import App from '~/components/App'
import Buefy from 'buefy'
import Helpers from '~/lib/helpers'
import VeeValidate from 'vee-validate'
import $ from 'jquery'
import { WOW } from 'wowjs'

import '~/plugins'
import '~/components'

// import 'buefy/dist/buefy.css'

window.$ = window.jQuery = $
window.helpers = Helpers
window.WOW = WOW

Vue.use(Buefy)
Vue.use(VeeValidate, {
    events: ''
})

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  i18n,
  store,
  router,
  ...App
})

// Sitewide Components
import BakdDevelopmentNotice from '~/components/common/BakdDevelopmentNotice'
import BackToTop from '~/components/elements/BackToTop'

Vue.component('BakdDevelopmentNotice', BakdDevelopmentNotice)
Vue.component('BackToTop', BackToTop)
