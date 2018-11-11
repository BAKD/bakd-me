import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import App from '~/components/App'
import Buefy from 'buefy'
import Helpers from '~/lib/helpers'
import VeeValidate from 'vee-validate'
import VueWaypoint from 'vue-waypoint'
import $ from 'jquery'
import { WOW } from 'wowjs'
import Odometer from 'odometer'

import '~/plugins'
import '~/components'
import '~/filters'

// console.log(Odometer);

// import 'buefy/dist/buefy.css'

window.$ = window.jQuery = $
window.helpers = Helpers
window.WOW = WOW
window.Odometer = Odometer

// window.odometerOptions = {
//   auto: true, // Don't automatically initialize everything with class 'odometer'
//   selector: '.odometer', // Change the selector used to automatically find things to be animated
//   format: '(,ddd).dd', // Change how digit groups are formatted, and how many digits are shown after the decimal point
//   duration: 3000, // Change how long the javascript expects the CSS animation to take
//   // theme: 'car', // Specify the theme (if you have more than one theme css file on the page)
//   // animation: 'count' // Count is a simpler animation method which just increments the value,
//                      // use it when you're looking for something more subtle.
// };
 
// Waypoint plugin
Vue.use(VueWaypoint)
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