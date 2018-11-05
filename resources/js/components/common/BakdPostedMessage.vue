<template>
    <div class="box posted-message">
      <article class="media">
        

        <!-- AVATAR/INFO -->
        <figure class="media-left has-text-centered" style="width: 64px;">
          <p class="image">
            <img src="/images/no-avatar.png" class="is-centered-margin image" style="width: 100%; height: auto; max-width: 64px;" />
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
          <div class="fielsd level">

            <p class="is-start">
              <span class="is-bold">Tom Grenier</span>&nbsp;&nbsp;<span class="is-size-7">1 minute ago...</span>
            </p>

            <p class="level-item is-size-7 has-text-right is-end">




              <!-- <fa icon="clock" class="icon" />&nbsp;&nbsp;1 minute ago... -->
            </p>

            <p class="level-item is-size-7 is-end" style="max-width: 30px;">
              <!-- <fa icon="ellipsis-v" /> -->
              <b-tooltip label="View Conversation" type="is-dark" position="is-left">
                <fa icon="chevron-down" />
              </b-tooltip>
            </p>
          </div>

          <div class="field" style="margin-bottom: 0;">
            <p class="control" style="padding-top: 0px;">
              <slot/>
            </p>
          </div>


          <!-- FOOTER ICONS -->
          <nav class="level">
            <div class="level-item has-text-left">
              <div class="is-size-7">






              </div>
            </div>

            <!-- TOP RIGHT -->
            <div class="media-right">


              <ul class="is-grouped field">


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
                        <fa icon="comment" />
                      </div>
                    </a>
                  </b-tooltip>
                </li>
                <li style="margin-right: 10px;">
                  <b-tooltip label="Reshare" type="is-dark">
                    <a href="#" class="has-text-dark">
                      <div class="icon">
                        <fa icon="share" />
                      </div>
                    </a>
                  </b-tooltip>
                </li>
                <li>

                  <b-tooltip label="More" type="is-dark">
                    <b-dropdown class="dropdown-trigger-icon" position="is-bottom-left">
                      <div class="icon is-v-centered" slot="trigger">
                        <fa icon="ellipsis-v"/>
                      </div>
                      <b-dropdown-item><fa icon="ban"/> Mute Member</b-dropdown-item>
                      <b-dropdown-item><fa icon="bell"/> Report Message</b-dropdown-item>
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

<style lang="scss" scoped>
  .posted-message {
    margin: 0 0 20px 0;
  }
</style>