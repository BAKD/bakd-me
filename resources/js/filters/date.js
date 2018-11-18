import Vue from 'vue'
import moment from 'moment-timezone'

Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).format('LLLL')
  }
})

Vue.filter('humanize', function(value) {
  if (value) {
    return moment(String(value)).humanize()
  }
})

Vue.filter('calendar', function(value) {
  if (value) {
    return moment(String(value)).calendar()
  }
})

Vue.filter('fromNow', function(value) {
  if (value) {
    return moment(moment.utc(String(value)).local()).fromNow()
  }
})