<template>
  <b-dropdown class="has-text-left is-fullwidth" :position="dropdown">
    <a class="button is-fullwidth is-size-7" href="javascript: void(0);" slot="trigger">
      <!-- <b-tooltip label="Change Language" position="is-left" animated> -->
        <span :class="flagClass" style="margin-right: 6px;"></span> <strong>Change Language</strong>
      <!-- </b-tooltip> -->
    </a>
    <b-dropdown-item has-link v-for="(value, key) in locales" :key="key">
      <a class="dropdown-item" href="#" @click.prevent="setLocale(key)" v-html="getDisplayName(key)"></a>
    </b-dropdown-item>
  </b-dropdown>
</template>

<script>
import { mapGetters } from 'vuex'
import { loadMessages } from '~/plugins/i18n'

export default {

  props: {
    dropdown: { type: String, default: "is-bottom-right" }
  },

  computed: mapGetters({
    locale: 'lang/locale',
    locales: 'lang/locales'
  }),

  data() {
    return {
      displayName : 'English',
      flagClass   : 'flag-icon flag-icon-us'
    }
  },

  mounted() {
    this.setFlag(this.locale);
    this.setDisplayName(this.locale);
  },

  methods: {
    setLocale (locale) {
      if (this.$i18n.locale !== locale) {
        loadMessages(locale)
        this.setFlag(locale);
        this.setDisplayName(locale);
        this.$store.dispatch('lang/setLocale', { locale })
      }
    },

    setFlag (locale) {
      switch (locale) {
        case 'en'    : this.flagClass = 'flag-icon flag-icon-us'; break;
        case 'zh-CN' : this.flagClass = 'flag-icon flag-icon-cn'; break;
        case 'es'    : this.flagClass = 'flag-icon flag-icon-es'; break;
        default      : this.flagClass = 'flag-icon flag-icon-us'; break;
      }
    },

    getDisplayName (locale) {
      switch (locale) {
        case 'en'    : return '<span class="flag-icon flag-icon-us"></span> English';
        case 'zh-CN' : return '<span class="flag-icon flag-icon-cn"></span> Chinese';
        case 'es'    : return '<span class="flag-icon flag-icon-es"></span> Spanish';
        default      : return '<span class="flag-icon flag-icon-us"></span> English';
      }
    },

    setDisplayName (locale) {
      switch (locale) {
        case 'en'    : this.displayName = 'English'; break;
        case 'zh-CN' : this.displayName = 'Chinese'; break;
        case 'es'    : this.displayName = 'Spanish'; break;
        default      : this.displayName = 'English'; break;
      }
    }
  }
}
</script>

<style scoped lang="scss">
.flag-icon {
  transition: all .2s ease;
}
.dropdown {
  max-width: 200px !important;
}
</style>