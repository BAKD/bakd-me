<template>
    <div class="box posted-message">
      <article class="media">

        <!-- AVATAR/INFO -->
        <figure class="media-left has-text-centered" style="width: 64px;">
          <p class="image">
            <router-link :to="{ name: 'members.show.public', params: { id: post.user.id } }">
              <img :src="user.avatar_url || user.photo_url" class="is-centered-margin image" style="width: 100%; height: auto; max-width: 64px;" />
            </router-link>
          </p>
          <p class="subtitle is-size-7" style="padding-top: 6px;">
            {{ post.user.type | capitalize }}
          </p>
          <p class="trust-widget is-size-7 has-text-centered">
            <span class="is-bold">Trust:</span> <span class="is-green is-bold">+10,200</span>
          </p>

          <!-- <p>
            <ul class="has-text-centered">
              <li class="inline-block">
                <b-tooltip label="Give Trust" type="is-dark">
                  <a href="#" class="has-text-dark">
                    <div class="icon">
                      <i class="la la-chevron-up" />
                    </div>
                  </a>
                </b-tooltip>
              </li>
              <li class="inline-block">
                <b-tooltip label="Lose Trust" type="is-dark">
                  <a href="#" class="has-text-dark">
                    <div class="icon">
                      <i class="la la-chevron-down" />
                    </div>
                  </a>
                </b-tooltip>
              </li>
            </ul>
          </p> -->
        </figure>

        <!-- MAIN POST CONTENT -->
        <div class="media-content">
          <div class="level">
            <div class="level-left">
              <span class="is-bold">
              <router-link :to="{ name: 'members.show.public', params: { id: post.user.id } }">
                {{ post.user.name }}
              </router-link>
            </span>
            &nbsp;&nbsp;
            <span class="is-size-7" :title="post.created_at">
                <i class="la la-clock-o"></i> {{ post.created_at | fromNow }}...
            </span>
            </div>
            <div class="level-right is-size-7 has-text-right">
              <p class="is-size-7" style="max-width: 30px;">
                <b-tooltip label="View Conversation"type="is-dark" position="is-left">
                  <a href="#" class="has-text-dark" @click.prevent="">
                    <fa icon="chevron-down" />
                  </a>
                </b-tooltip>
              </p>
            </div>
          </div>

          <!-- Main Message Section -->
          <div class="field" style="margin-bottom: 0;">
            <p class="control" style="padding-top: 0px;">
              <b-message style="margin-bottom: 20px; padding: 20px;" v-html="post.message"></b-message>
              <!-- TODO: Setup Tag System -->
              <ul class="tags field is-grouped">
                <a href="#">
                  <li class="tag is-rounded" style="margin-right: 10px;">
                    #btc 
                  </li>
                </a>
                <a href="#">
                  <li class="tag is-rounded" style="margin-right: 10px;">
                    #blockchain
                  </li>
                </a>
                <a href="#">
                  <li class="tag is-rounded" style="margin-right: 10px;">
                    #cryptocurrency
                  </li>
                </a>
                <a href="#">
                  <li class="tag is-rounded" style="margin-right: 10px;">
                    #p2p
                  </li>
                </a>
              </ul>
            </p>
          </div>
        </div>
      </article>

        <!-- FOOTER ICONS -->
        <nav class="level" style="margin-top: 5px;">
          <div class="level-item has-text-left">
            <div class="is-size-7">
              <!-- ... -->
            </div>
          </div>

          <!-- TOP RIGHT -->
          <div class="media-right">
            <ul class="is-grouped field is-end">
              <li style="margin-right: 10px;">
                <b-tooltip label="Like" type="is-dark" position="is-bottom">
                  <a href="#" class="has-text-dark" @click.prevent="">
                    <div class="icon">
                      <i class="la la-thumbs-up is-size-5" />
                    </div>
                  </a>
                </b-tooltip>
              </li>
              <li style="margin-right: 10px;">
                <b-tooltip label="Dislike" type="is-dark" position="is-bottom">
                  <a href="#" class="has-text-dark" @click.prevent="">
                    <div class="icon">
                      <i class="la la-thumbs-down is-size-5" />
                    </div>
                  </a>
                </b-tooltip>
              </li>
              <li style="margin-right: 10px;">
                <b-tooltip label="Comment" type="is-dark" position="is-bottom">
                  <a href="#" class="has-text-dark" @click.prevent="">
                    <div class="icon">
                      <i class="la la-comment is-size-5" />
                    </div>
                  </a>
                </b-tooltip>
              </li>
              <!-- <li style="margin-right: 10px;">
                <b-tooltip label="Reshare" type="is-dark" position="is-bottom">
                  <a href="#" class="has-text-dark" @click.prevent="">
                    <div class="icon">
                      <i class="la la-share is-size-5" />
                    </div>
                  </a>
                </b-tooltip>
              </li> -->
              <li>
                <b-tooltip label="More" type="is-dark" position="is-bottom">
                  <b-dropdown class="dropdown-trigger-icon" position="is-bottom-left">
                    <div class="icon is-v-centered" slot="trigger">
                      <i class="la la-ellipsis-v is-size-5" />
                    </div>
                    <b-dropdown-item><i class="la la-share"/> Reshare</b-dropdown-item>
                    <b-dropdown-item><i class="la la-ban"/> Mute Member</b-dropdown-item>
                    <b-dropdown-item><i class="la la-bell"/> Report Message</b-dropdown-item>
                  </b-dropdown>
                </b-tooltip>
              </li>
            </ul>
          </div>
        </nav>
    </div>
</template>

<script>
import { mapGetters } from "vuex"

export default {
  props: {
    post: {
      type: Object,
      required: true
    },
  },

  data: () => ({
    avatar: '',
    user: {},
    submitOnEnter: false
  }),

  computed: {
    ...mapGetters({
      authdUser: 'auth/user'
    })
  },

  mounted() {
    // If this post belongs to the currently auth'd user, use the vuex store
    // value for user instead of the ajax response data so when a new avatar
    // is uploaded, it is reactive
    if (this.authdUser.id == this.$props.post.user.id) {
      // Vuex user
      this.user = this.authdUser
    } else {
      // Ajax response data/DB relationship post.user
      this.user = this.$props.post.user
    }

    // Grab the avatar from whichever user is currently being used
    this.avatar = this.user.avatar_url || this.user.photo_url
  }

}
</script>

<style lang="scss" scoped>
  .posted-message {
    margin: 0 0 20px 0;
  }
  .inline-block {
    display: inline-block;
  }
</style>