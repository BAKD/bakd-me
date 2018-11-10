<template>
  <div id="app">
    <loading ref="loading"/>
    <transition name="page" mode="out-in" @after-enter="afterEnter" appear>
      <component v-if="layout" :is="layout" :has-header="hasHeader" />
    </transition>
  </div>
</template>

<script>
import Loading from './layout/Loading'

// Load layout components dynamically.
const requireContext = require.context('~/layouts', false, /.*\.vue$/)

const layouts = requireContext.keys()
  .map(file =>
    [file.replace(/(^.\/)|(\.vue$)/g, ''), requireContext(file)]
  )
  .reduce((components, [name, component]) => {
    components[name] = component.default || component
    return components
  }, {})

export default {
  el: '#app',

  components: {
    Loading
  },

  data: () => ({
    layout: null,
    defaultLayout: 'default',
    hasHeader: false
  }),

  metaInfo () {
    const { appName } = window.config

    return {
      title: appName,
      titleTemplate: `%s · ${appName}`
    }
  },

  mounted () {
    this.$loading = this.$refs.loading
  },

  methods: {
    afterEnter () {
      this.$root.$emit('scrollAfterEnter');
    },
    /**
     * Set the application layout.
     *
     * @param {String} layout
     */
    setLayout (layout) {
      if (!layout || !layouts[layout]) {
        layout = this.defaultLayout
      }

      this.layout = layouts[layout]
    }
  }
}
</script>

<style lang="scss">
// Import Bulma's core
//@import "~bulma/sass/utilities/_all";

// Setup main branding colors
/*
$primary: #FFA800;
$primary-invert: findColorInvert($primary);
//$primary: #FF7F00;
//$primary-invert: findColorInvert($primary);
$twitter: #4099FF;
$twitter-invert: findColorInvert($twitter);
$discord: #7289da;
$discord-invert: findColorInvert($discord);
$github: #171515;
$github-invert: findColorInvert($github);
$reddit: #FF5700;
$reddit-invert: findColorInvert($reddit);
$medium: #3cb371;
$medium-invert: findColorInvert($medium);
$transparent: transparent;

$info: #E2F0FB;
$info-invert: findColorInvert($info);

// Setup $colors to use as bulma classes (e.g. 'is-twitter')
$colors: (
  "white": ($white, $black),
  "black": ($black, $white),
  "light": ($light, $light-invert),
  "dark": ($dark, $dark-invert),
  "primary": ($primary, $primary-invert),
  "info": ($info, $info-invert),
  "success": ($success, $success-invert),
  "warning": ($warning, $warning-invert),
  "danger": ($danger, $danger-invert),
  "twitter": ($twitter, $twitter-invert),
  "github": ($github, $github-invert),
  "discord": ($discord, $discord-invert),
  "reddit": ($reddit, $reddit-invert),
  "medium": ($medium, $medium-invert),
  "transparent": ($transparent, $transparent),
  //"primary-2": ($primary-2, $primary-2-invert),  
);
*/


// Import Bulma and Buefy styles
//@import "~bulma";
//@import "~buefy/src/scss/buefy";
</style>