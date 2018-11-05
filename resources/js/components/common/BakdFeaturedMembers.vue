<template>

  <section class="section level" style="border-top: 2px solid #cdcdcd; border-bottom: 2px solid #cdcdcd; background: #fff; margin: 0 0 40px 0; min-height: 400px; padding: 50px 10px;">
    <div class="container has-text-centered">


      <bakd-section-title title="FEATURED MEMBERS" subtitle="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio eligendi perspiciatis explicabo neque sint." />



      <div class="columns has-text-centered" style="margin: 0 auto;">
        


        <!-- FEATURED MEMBER SLIDER -->
        <div class="column level-item wow fadeIn" v-for="n in 3" :key="n">





          <img src="https://via.placeholder.com/400x300" class="image" />
          <h2 class="title is-size-4" style="padding: 30px;">
            <b-tooltip type="is-dark" animated label="Follow Tom">
              <a href="#" class="button is-normal icon is-primary is-v-centered has-hand-cursor" style="top: 3px; position: relative;"><fa icon="plus"/></a> 
            </b-tooltip>
            Tom Grenier 
          </h2>
          <h3 class="subtitle is-size-6 has-text-grey-light">
            Blockchain Developer
          </h3>
          <p style="padding: 20px 0;">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam voluptatibus soluta rerum laborum reiciendis ducimus dolor error quibusdam eaque.
          </p>
          <div class="field is-grouped is-spaced-evenly is-fullwidth">
            <!-- <a href="#" class="button icon is-primary">
              <fa icon="plus"/>
            </a> -->
            <!-- <a href="#" class="button icon is-success">
              <fa icon="envelope"/>
            </a>
            <a href="#" class="button icon is-danger">
              <fa icon="bookmark"/>
            </a> -->
          </div>



        </div>
        <!-- END FEATURED MEMBER SLIDER -->


  <!--       <div class="column level-item">
          <img src="https://via.placeholder.com/300" />
          <p class="subtitle is-size-6">
            <h2 class="title is-size-4" style="padding: 30px;">
              Test Title #1
            </h2>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam voluptatibus soluta rerum laborum reiciendis ducimus dolor error quibusdam eaque, quas officia aspernatur, rem, at veniam repellat eligendi delectus doloremque ipsam!
          </p>
          <a href="#" class="button is-primary">
            View <fa icon="chevron-right"/>
          </a>
        </div>
        <div class="column level-item">
          <img src="https://via.placeholder.com/300" />
          <p class="subtitle is-size-6">
            <h2 class="title is-size-4" style="padding: 30px;">
              Test Title #1
            </h2>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam voluptatibus soluta rerum laborum reiciendis ducimus dolor error quibusdam eaque, quas officia aspernatur, rem, at veniam repellat eligendi delectus doloremque ipsam!
          </p>
          <a href="#" class="button is-primary">
            View <fa icon="chevron-right"/>
          </a>
        </div> -->



      </div>

    </div>

  </section>
</template>

<script>
import BakdSectionTitle from '~/components/common/BakdSectionTitle'

export default {

  components: {
    BakdSectionTitle
  }

}
</script>