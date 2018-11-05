<template>
    <nav style="width: 100%; margin-top: 40px;" class="card has-shadow">
       

      <div class="columns" style="padding: 20px 20px 10px 20px;">

        <div class="column is-v-centered has-text-centered is-fullwidth-mobile is-one-third-tablet project-image-wrapper">
          <img src="/images/bitcoin.jpg" class="project-image">
        </div>

        <div class="column is-fullwidth-mobile">

            <p class="is-bold is-size-3">
              Bitcoin
              

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