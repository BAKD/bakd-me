<template>
    <nav style="width: 100%; margin-top: 40px;" class="panel has-shadow">
    
    <div class="panel-heading wow fadeIn">
      <div class="columns is-mobile is-v-centered level">
        <div class="column is-6 is-half-mobile is-bold" style="white-space: nowrap;">
          <fa icon="star" class="is-primary"/> Featured Campaign 
        </div>
        <div class="column is-6 is-half-mobile">

          <!-- <div class="tags"> -->
            <!-- <span class="tag is-primary">Cryptocurrency</span> -->
            <!-- <span class="tag is-primary">BTC</span> -->
            <!-- <span class="tag is-primary">Blockchain</span>
            <span class="tag is-primary">Proof of Work</span>
            <span class="tag is-primary">P2P</span>
          </div> -->
          
          <!-- <span class="tag is-primary is-small">
            <fa icon="star"/><fa icon="star"/><fa icon="star"/><fa icon="star"/><fa icon="star"/>
          </span> -->
          
          <div class="field is-grouped is-end project-stats-tags level-item">

              <!-- <div class="field is-grouped"> -->
             <!--  <div class="control is-small">
                <div class="tags has-addons">
                  <span class="tag is-light is-small">Team</span>
                  <span class="tag is-success is-bold is-small">4.4</span>
                </div>
              </div>
              <div class="control is-small">
                <div class="tags has-addons">
                  <span class="tag is-light is-small">Idea</span>
                  <span class="tag is-success is-bold is-small">4.8</span>
                </div>
              </div>
              <div class="control is-small">
                <div class="tags has-addons">
                  <span class="tag is-light is-small">Scalibility</span>
                  <span class="tag is-warning is-bold is-small">3.5</span>
                </div>
              </div> -->
            <!-- </div>  -->
            
            <div class="control is-small">
<!--               <span class="tag is-info is-small">
                <fa icon="bookmark"/>
              </span> -->
              <span class="tag is-success is-bold is-small">VERIFIED</span>
            </div>
            <!-- <div class="control is-small">
              <div class="tags has-addons">
                <span class="tag is-dark is-small">Team</span>
                <span class="tag is-primary is-bold is-small">4.4</span>
              </div>
            </div>
            <div class="control is-small">
              <div class="tags has-addons">
                <span class="tag is-dark is-small">Idea</span>
                <span class="tag is-primary is-bold is-small">4.8</span>
              </div>
            </div>
            <div class="control is-small">
              <div class="tags has-addons">
                <span class="tag is-dark is-small">Progress</span>
                <span class="tag is-primary is-bold is-small">4.9</span>
              </div>
            </div> -->
            
            <!-- DROPDOWN MENU -->

            <b-dropdown class="dropdown-trigger-icon" position="is-bottom-left" style="margin-top: 4px;">
              <div class="icon is-v-centered" slot="trigger">
                <fa icon="ellipsis-v"/>
              </div>
              <b-dropdown-item><fa icon="eye"/> View</b-dropdown-item>
              <b-dropdown-item><fa icon="chart-bar"/> Contribute</b-dropdown-item>
              <b-dropdown-item><fa icon="heart"/> Favorite</b-dropdown-item>
              <b-dropdown-item><fa icon="share"/> Share</b-dropdown-item>
            </b-dropdown>

          </div>
  


        </div>
      </div>
    </div>

    <div class="panel-block">

      <div class="columns" style="padding: 20px 20px 10px 20px;">

        <div class="column is-v-centered has-text-centered is-fullwidth-mobile is-one-third-tablet project-image-wrapper">
          <router-link :to="{ name: 'campaigns.view', params: { id: 1 }}">
            <img src="/images/bitcoin.jpg" class="project-image">
          </router-link>
        </div>

        <div class="column is-fullwidth-mobile">

            <p class="is-bold is-size-3">
              <router-link :to="{ name: 'campaigns.view', params: { id: 1 }}" class="has-text-dark">
                Bitcoin
              </router-link>        

              <!-- <span class="tag is-primary is-bold is-large" style="position: relative; top: -4px;">4.7</span> -->

              <!-- <span class="tag is-success is-small" style="position: relative; top: -4px;">
                <fa icon="star"/>
              </span> -->
              <!-- <span class="tag is-primary is-small" style="position: relative; top: -4px;">
                <fa icon="star"/><fa icon="star"/><fa icon="star"/><fa icon="star"/><fa icon="star"/>
              </span> -->
            </p>

            <p class="subtitle has-text-grey-light">
              A Peer-to-Peer Electronic Cash System
            </p>

            <p>
              
            </p>

            <p>
              Bitcoin is a decentralized digital currency that enables instant payments to anyone, anywhere in the world. Bitcoin uses peer-to-peer technology to operate with no central authority: transaction management and money issuance are carried out collectively by the network.
            </p>

            <div style="padding: 20px 0;" class="project-stats-wrapper">
              
              <!-- FUNDING PROGRESS -->
              <progress class="progress is-primary" value="60" max="100">60%</progress>


              <!-- FUNDING STATS -->
              <div class="columns is-vcentered has-text-centered">
                <div class="column is-4 is-one-third-tablet">
                  <strong>Contributions:</strong>
                  <p class="is-size-4 is-bold">$7,490,52</p>
                </div>
                <div class="column is-4 is-one-third-tablet">
                  <strong>BAK'ers:</strong>
                  <p class="is-size-4 is-bold">4,781</p>
                </div>
                <div class="column is-4 is-one-third-tablet">
                  <strong>Goal:</strong>
                  <p class="is-size-4 is-bold">$12,500,000</p>
                </div>
              </div>
            </div>



              <!-- FUNDING STATS -->
              <!-- <div class="columns is-vcentered has-text-centered">
                <div class="column is-4 is-one-third-tablet">
                  <div class="media">
                    <div class="media-left is-v-centered">
                      <fa icon="share" class="is-size-1" />
                    </div>
                    <div class="media-body">
                      <strong>Contributions:</strong>
                      <p class="is-size-4 is-bold">$7,490,52</p>
                    </div>
                  </div>
                </div>
                <div class="column is-4 is-one-third-tablet">
                  <div class="media">
                    <div class="media-left is-v-centered">
                      <fa icon="users" class="is-size-1" />
                    </div>
                    <div class="media-body">
                      <strong>BAK'ers:</strong>
                      <p class="is-size-4 is-bold">4,781</p>
                    </div>
                  </div>
                </div>
                <div class="column is-4 is-one-third-tablet">
                  <div class="media">
                    <div class="media-left is-v-centered">
                      <fa icon="chart-bar" class="is-size-1" />
                    </div>
                    <div class="media-body">
                      <strong>Goal:</strong>
                      <p class="is-size-4 is-bold">$12,500,000</p>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->

          </div>
        </div>
      </div>
      <div class="panel-block" style="display: none; background: whitesmoke;">
        <div class="has-text-right" style="width: 100%;">
            <a href="#" class="button is-secondary is-size-6">
              Contribute
            </a>
            <a href="#" class="button is-primary is-size-6">
              View
            </a>
        </div>
      </div>
    </nav>
</template>

<script>
export default {
  mounted() {
    new WOW().init()
  }
}
</script>

<style lang="scss" scoped>
.project-image-wrapper {
  max-width: 320px;

  .project-image {
    height: auto;
  }

  @media (max-width: 1279px) {
    text-align: center;
  }

  @media (max-width: 768px) {
    max-width: unset;
    text-align: center;
  }
}

@media (max-width: 768px) {
  .project-stats-tags .control {
    display: none !important;
  }
}
</style>