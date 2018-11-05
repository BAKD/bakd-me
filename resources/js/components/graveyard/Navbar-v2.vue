<template>
<nav class="navbar level" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <router-link :to="{ name: user ? 'home' : 'welcome' }" class="level-item">
      <img src="/images/branding/logo-200w.png" height="45" width="130" :alt="appName" :title="appName">
    </router-link>

    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navMainMenu">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navMainMenu" class="navbar-menu">
    <div class="navbar-start">
      <a class="navbar-item">
        Start a Campaign
      </a>

      <a class="navbar-item">
        Find a Project
      </a>

      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">
          More
        </a>

        <div class="navbar-dropdown">
          <a class="navbar-item">
            About
          </a>
          <a class="navbar-item">
            Jobs
          </a>
          <a class="navbar-item">
            Contact
          </a>
          <hr class="navbar-divider">
          <a class="navbar-item">
            Report an issue
          </a>
        </div>
      </div>
    </div>

    <!-- Authenticated -->
    <template>
      <div v-if="user" class="level-item">
        <b-dropdown position="is-bottom-left">
          <div class="media" role="button" slot="trigger">
            <div class="media-content navbar-item has-dropdown text-dark">
              <img :src="user.photo_url"> {{ user.name }} <b-icon icon="menu-down"></b-icon>
            </div>
          </div>
          <b-dropdown-item has-link paddingless>
            <router-link :to="{ name: 'settings.profile' }" class="text-dark">
              <fa icon="cog" />
              {{ $t('settings') }}
            </router-link>
          </b-dropdown-item>
          <b-dropdown-item separator />
          <b-dropdown-item has-link paddingless>
            <a href="#" @click.prevent="logout" class="text-dark">
              <fa icon="sign-out-alt" />
              {{ $t('logout') }}
            </a>
          </b-dropdown-item>
        </b-dropdown>
      </div>

      <!-- Guest -->
      <div v-else class="level-item">
        <div class="navbar-end">
          <div class="navbar-item">
            <div class="buttons">
              <router-link :to="{ name: 'register' }" class="button is-primary" active-class="active">
                <strong>{{ $t('register') }}</strong>
              </router-link>
              <router-link :to="{ name: 'login' }" class="button is-light" active-class="active">
                {{ $t('login') }}
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </template>

  </div>
</nav>
</template>

<script>
import { mapGetters } from 'vuex'
import LocaleDropdown from './LocaleDropdown'

export default {
  components: {
    LocaleDropdown
  },

  data: () => ({
    appName: window.config.appName
  }),

  computed: mapGetters({
    user: 'auth/user'
  }),

  methods: {
    async logout () {
      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to login.
      this.$router.push({ name: 'login' })
    },
    showDropdown () {
      alert('show')
    }
  }
}
</script>

<style lang="scss">
@import './resources/sass/variables';

nav {
  border-top: 4px solid $primary;
}
.navbar-brand {
  padding: 8px;

  img {
    width: 100%;
    height: auto;
    max-width: 130px;
    max-height: 45px;
  }
}

.profile-photo {
  width: 2rem;
  height: 2rem;
  margin: -.375rem 0;
}
</style>








<!-- 






                <b-dropdown v-model="navigation" position="is-bottom-left">
                    <a class="navbar-item" slot="trigger">
                        <span>Menu</span>
                        <b-icon icon="menu-down"></b-icon>
                    </a>

                    <b-dropdown-item custom>
                        Logged in as <b>Tom Grenier</b>
                    </b-dropdown-item>
                    <hr class="dropdown-divider">
                    <b-dropdown-item has-link>
                        <a href="https://google.com" target="_blank">
                            <b-icon icon="link"></b-icon>
                            Google (link)
                        </a>
                    </b-dropdown-item>
                    <b-dropdown-item value="home">
                        <b-icon icon="home"></b-icon>
                        Home
                    </b-dropdown-item>
                    <b-dropdown-item value="products">
                        <b-icon icon="cart"></b-icon>
                        Products
                    </b-dropdown-item>
                    <b-dropdown-item value="blog" disabled>
                        <b-icon icon="book-open"></b-icon>
                        Blog
                    </b-dropdown-item>
                    <hr class="dropdown-divider">
                    <b-dropdown-item value="settings">
                        <b-icon icon="settings"></b-icon>
                        Settings
                    </b-dropdown-item>
                    <b-dropdown-item value="logout">
                        <b-icon icon="logout"></b-icon>
                        Logout
                    </b-dropdown-item>
                </b-dropdown> -->