import Vue from 'vue'

Vue.filter('fixed', function (value, places) {
	return Number.parseFloat(value, 10).toFixed(places)
})