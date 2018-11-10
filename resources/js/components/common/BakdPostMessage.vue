<template>
  <div v-if="user" class="box">

    <article class="media">
      
      <figure class="media-left">
        <p class="image is-64x64">
          <img :src="user.photo_url" class="is-v-centered image is-64x64" style="height: auto; width: 100%; max-width: 64px" />
        </p>
      </figure>

      <div class="media-content">

        <div class="field">
          <p class="control">
            <textarea class="textarea" placeholder="Post a message..."></textarea>
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
              <!-- Remember Me -->
              <b-checkbox v-model="submitOnEnter" name="submitOnEnter" class="is-size-7">{{ $t('Press enter to submit') }}</b-checkbox>
            </div>
          </div>

          <div class="level-right">
            <div class="level-item">
              <a href="#" class="button is-primary is-rounded is-wide is-fullwidth is-normal">
                <span class="is-size-7"><i class="la la-check" /> Post Message</span>
              </a>
            </div>
          </div>

        </nav>

      </div>
    </article>
  </div>
</template>


<script>
import { mapGetters } from "vuex"

export default {

  data: () => ({
    submitOnEnter: false
  }),

  computed: mapGetters({
    user: 'auth/user'
  })

}
</script>