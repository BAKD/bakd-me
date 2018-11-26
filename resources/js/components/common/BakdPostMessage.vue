<template>
  <div v-if="user" class="box">

    <article class="media">
      
      <figure class="media-left">
        <p class="image is-64x64">
          <img :src="user ? user.avatar_url : ''" class="is-v-centered image is-64x64" style="height: auto; width: 100%; max-width: 64px" />
        </p>
      </figure>
      
      <form @submit.prevent.keydown="send" class="is-100">
      <div class="media-content">

        <div class="field">
          <p class="control">
            
            <!-- POST TEXT -->
            <div id="post-box" @keyup="parse" class="textarea is-clipped"></div>

            <!-- <textarea id="post-box" class="textarea" placeholder="Post a message..." v-model="post.message"></textarea> -->
          </p>

          <div class="field has-addons" style="margin-top: 15px;">
            <p class="control">
              <b-tooltip label="Add Image" type="is-dark">
                <a class="button">
                  <span class="icon is-small is-size-6">
                    <i class="la la-image"></i>
                  </span>
                </a>
              </b-tooltip>
            </p>
            <p class="control">
              <b-tooltip label="Add Link" type="is-dark">
                <a class="button">
                  <span class="icon is-small">
                    <i class="la la-link"></i>
                  </span>
                </a>
              </b-tooltip>
            </p>
            <p class="control">
              <b-tooltip label="Add Video" type="is-dark">
                <a class="button">
                  <span class="icon is-small">
                    <i class="la la-camera"></i>
                  </span>
                </a>
              </b-tooltip>
            </p>
            <p class="control">
              <b-tooltip label="Add Chart" type="is-dark">
                <a class="button">
                  <span class="icon is-small">
                    <i class="la la-bar-chart"></i>
                  </span>
                </a>
              </b-tooltip>
            </p>
          </div>

        </div>

        <nav class="level">
          <div class="level-left">
            <div class="level-item">
              <b-checkbox v-model="submitOnEnter" name="submitOnEnter" class="is-size-7">{{ $t('Press enter to submit') }}</b-checkbox>
            </div>
          </div>

          <div class="level-right">
            <div class="level-item">
              <button type="submit" class="button is-primary is-rounded is-wide is-fullwidth is-normal">
                <span class="is-size-7"><i class="la la-check" /> Post Message</span>
              </button>
            </div>
          </div>

        </nav>

      </div>
    </form>
    </article>
  </div>
</template>


<script>
import { mapGetters } from "vuex"
import twitter from '~/plugins/twitter-text'
import TwitterBox from '~/components/elements/TwitterBox'

export default {
  name: 'bakd-posted-message',

  data: () => ({
    post: {
      message: '',
      user: this.user
    },
    submitOnEnter: false
  }),

  components: {
    TwitterBox
  },

  computed: mapGetters({
    user: 'auth/user'
  }),

  mounted() {
      if ($('#post-box').length > 0) {
        $('#post-box').get(0).contentEditable = true
      }
  },

  methods: {

    parse: function (event) {
      var $post = $('#post-box')
      var parsed = twitter.autoLink($post.text())
      $post.html(parsed)
      this.post.message = parsed
      // this.placeCaretAtEnd($post.get(0))
    },

    // c/o stack overflow:
    // 
    // https://stackoverflow.com/questions/4233265/contenteditable-set-caret-at-the-end-of-the-text-cross-browser/4238971#4238971
    placeCaretAtEnd: function (el) {
        el.focus();
        if (typeof window.getSelection != "undefined"
                && typeof document.createRange != "undefined") {
            var range = document.createRange();
            range.selectNodeContents(el);
            range.collapse(false);
            var sel = window.getSelection();
            sel.removeAllRanges();
            sel.addRange(range);
        } else if (typeof document.body.createTextRange != "undefined") {
            var textRange = document.body.createTextRange();
            textRange.moveToElementText(el);
            textRange.collapse(false);
            textRange.select();
        }
    },

    send: function () {
      var self = this
      
      // var twittered = twitter.autoLink(twitter.htmlEscape(this.post.message))

      if (this.post.message.length < 1) {
        helpers.toast({ type: 'error', title: 'Post can not be empty.' })
      } else {
        this.$parent.$emit('PostCreated', {
          message: self.post.message,
          user: self.post.user
        })

        this.post = {}
      }
    }
  }

}
</script>