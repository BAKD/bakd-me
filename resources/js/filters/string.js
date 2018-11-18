import Vue from 'vue'


// String to upper helper
Vue.filter('uppercase', function(value) {
  if (value) {
    return value.toUpperCase()
  }
})


// Capitalize
Vue.filter('capitalize', function(value) {
  if (value) {
    return value.charAt(0).toUpperCase() + value.toLowerCase().slice(1)
  }
})


/**
 * Filter to truncate string, accepts a length parameter
 */
Vue.filter('truncate', function(value, length) {
  if (value && length) {
    return value.length > length
        ? value.substr(0, length) + '...'
        : value
  }
})


// SLUGIFY A STRING VALUE
Vue.filter('slugify', function(value, hardChange = false) {
  value = value.replace(/^\s+|\s+$/g, ''); // trim
  value = value.toLowerCase();

  // remove accents, swap ñ for n, etc
  var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
  var to   = "aaaaaeeeeeiiiiooooouuuunc------";
  for (var i=0, l=from.length ; i<l ; i++) {
    value = value.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
  }

  // hard change toggle switch to keep russian/chinese chars in certain instances
  if (hardChange) {
    value = value.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
  }

  value = value.replace(/\s+/g, '-') // collapse whitespace and replace by -
    .replace(/-+/g, '-'); // collapse dashes

  return value;
});