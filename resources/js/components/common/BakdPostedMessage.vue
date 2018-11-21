<template>
    <div class="box posted-message">
      <article class="media">
        

        <!-- AVATAR/INFO -->
        <figure class="media-left has-text-centered" style="width: 64px;">
          <p class="image">
            <img :src="user ? user.avatar_url : ''" class="is-centered-margin image" style="width: 100%; height: auto; max-width: 64px;" />
          </p>
          <p class="subtitle is-size-7" style="padding-top: 6px;">
            Blockchain Developer
          </p>
          <p class="trust-widget is-size-7 has-text-centered">
            <span class="is-bold">Trust:</span> <span class="is-green is-bold">+10,200</span>
          </p>
          <p>

<!-- 
                <ul class="is-grouped field is-start is-pulled-bottom has-text-centered">

                  <li>
                    <b-tooltip label="Like" type="is-dark">
                      <a href="#" class="has-text-dark">
                        <div class="icon">
                          <fa icon="thumbs-up" />
                        </div>
                      </a>
                    </b-tooltip>
                  </li>

                  <li>
                    <b-tooltip label="Dislike" type="is-dark">
                      <a href="#" class="has-text-dark">
                        <div class="icon">
                          <fa icon="thumbs-down" />
                        </div>
                      </a>
                    </b-tooltip>
                  </li>

                </ul> -->
            <!-- <img src="https://via.placeholder.com/50" /> -->
          </p>
        </figure>


        <!-- MAIN POST CONTENT -->
        <div class="media-content">
          <div class="level">

            <div class="level-left">
              <span class="is-bold">{{ user.name }}</span>&nbsp;&nbsp;<span class="is-size-7">{{ post.created_at | fromNow }}...</span>
            </div>

            <div class="level-right is-size-7 has-text-right">
              <p class="is-size-7" style="max-width: 30px;">
                <b-tooltip label="View Conversation"type="is-dark" position="is-left">
                  <fa icon="chevron-down" />
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


          <!-- FOOTER ICONS -->
          <nav class="level" style="margin-top: 5px;">
            <div class="level-item has-text-left">
              <div class="is-size-7">






              </div>
            </div>

            <!-- TOP RIGHT -->
            <div class="media-right">


              <ul class="is-grouped field is-end is-clipped">


<!-- 
                  <li style="margin-right: 10px;">
                    <b-tooltip label="Like" type="is-dark">
                      <a href="#" class="has-text-dark">
                        <div class="icon">
                          <fa icon="heart" class="has-text-red" />
                        </div>
                      </a>
                    </b-tooltip>
                  </li> -->
<!-- 
                  <li style="margin-right: 10px;">
                    <b-tooltip label="Dislike" type="is-dark">
                      <a href="#" class="has-text-dark">
                        <div class="icon">
                          <fa icon="thumbs-down" />
                        </div>
                      </a>
                    </b-tooltip>
                  </li> -->


                <li style="margin-right: 10px;">
                  <b-tooltip label="Comment" type="is-dark">
                    <a href="#" class="has-text-dark">
                      <div class="icon">
                        <!-- <fa icon="comment" /> -->
                        <i class="la la-comment is-size-5" />
                      </div>
                    </a>
                  </b-tooltip>
                </li>
                <li style="margin-right: 10px;">
                  <b-tooltip label="Reshare" type="is-dark">
                    <a href="#" class="has-text-dark">
                      <div class="icon">
                        <!-- <fa icon="share" /> -->
                        <i class="la la-share is-size-5" />
                      </div>
                    </a>
                  </b-tooltip>
                </li>
                <li>

                  <b-tooltip label="More" type="is-dark">
                    <b-dropdown class="dropdown-trigger-icon" position="is-bottom-left">
                      <div class="icon is-v-centered" slot="trigger">
                        <!-- <fa icon="ellipsis-v"/> -->
                        <i class="la la-ellipsis-v is-size-5" />
                      </div>
                      <b-dropdown-item><i class="la la-ban"/> Mute Member</b-dropdown-item>
                      <b-dropdown-item><i class="la la-bell"/> Report Message</b-dropdown-item>
                    </b-dropdown>
                  </b-tooltip>

                </li>

              </ul>
            </div>
      
          </nav>
        </div>

      </article>
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
    user: {
      type: Object,
      required: true
    }
  },

  data: () => ({
    submitOnEnter: false
  }),

}
</script>

<style lang="scss" scoped>
  .posted-message {
    margin: 0 0 20px 0;
  }
</style>