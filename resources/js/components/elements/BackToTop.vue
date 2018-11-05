<template>
  <transition name="back-to-top-fade">
    <div class="vue-back-to-top button is-rounded is-medium is-primary has-shadow" :style="`bottom:${this.bottom};right:${this.right};`" v-show="visible" @click="backToTop">
      <slot>
        <div class="default">
          <span>
            <fa icon="chevron-up"/>
          </span>
        </div>
      </slot>
    </div>
  </transition>
</template>

<script>
export default {
  // https://github.com/caiofsouza/vue-backtotop
  name: 'BackToTop',
  props: {
    text: {
      type: String,
      default: ''
    },
    visibleoffset: {
      type: [String, Number],
      default: 1000
    },
    right: {
      type: String,
      default: '30px',
    },
    bottom: {
      type: String,
      default: '40px',
    },
  },
  data () {
    return {
      visible: false
    }
  },
  mounted () {
    window.smoothscroll = () => {
      let currentScroll = document.documentElement.scrollTop || document.body.scrollTop
      if (currentScroll > 0) {
        window.requestAnimationFrame(window.smoothscroll)
        window.scrollTo(0, Math.floor(currentScroll - (currentScroll / 5)))
      }
    }
    window.addEventListener('scroll', this.catchScroll)
  },
  destroyed () {
    window.removeEventListener('scroll', this.catchScroll)
  },
  methods: {
    /**
     * Catch window scroll event 
     * @return {void}
     */
    catchScroll () {
      this.visible = (window.pageYOffset > parseInt(this.visibleoffset))
    },
    /**
     * The function who make the magics
     * @return {void}
     */
    backToTop () {
      window.smoothscroll()
      this.$emit('scrolled');
    }
  }
}
</script>

<style lang="scss">
.back-to-top-fade-enter-active, .back-to-top-fade-leave-active {
  transition: opacity .7s;
}
.back-to-top-fade-enter, .back-to-top-fade-leave-to{
  opacity: 0;
}

.vue-back-to-top{
  position: fixed;
  z-index: 1000;
  height: 45px;
  width: 45px;
  padding: 0;
  cursor:pointer;
  border-radius: 50% !important;
}
</style>