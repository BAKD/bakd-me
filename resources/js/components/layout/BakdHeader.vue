<template>
    <section class="hero is-large main-hero-header is-primary has-text-centered">

    <div class="container" style="margin-top: 90px; margin-bottom: -160px;">
      <b-message type="is-danger" has-icon style="z-index: 20; position: relative;">
        <strong>BAKD</strong> is still in it is's alpha/proof of concept stage. The site is being actively developed, and therefor updates frequently. There is a high probability that you will run in to issues from time to time, as well as unfinished pages. We are working dilligently to get things to a production-ready state, and will continue to update our community as we progress. <a href="https://bakd.io" class="is-bold" target="_blank">Learn More...</a>
      </b-message>
    </div>



      <div class="hero-body">

        <div class="container">
            <h1 class="title header-title is-white wow fadeInRight is-size-2">Build Your <span class="is-primary">Dream</span> Project</h1>
            <h2 class="hidden-mobile subtitle is-white is-size-5 wow fadeInLeft">Start a campaign today in <i>minutes</i></h2>

            <div class="button-wrapper">
                <template v-if="authenticated">
                    <router-link class="button is-rounded is-wide is-primary is-large has-shadow wow fadeInUp" :to="{ name: 'campaigns.create' }">
                        <span class="is-size-6"><i class="la la-bar-chart" /> {{ $t('Start a Campaign') }}</span>
                    </router-link>
                </template>

                <template v-else>
                    <router-link style="margin-top: 10px;" class="button wow fadeInUp is-rounded has-shadow is-wide is-primary is-large" :to="{ name: 'register' }">
                        <span class="is-size-6">{{ $t('Signup Free') }}</span>
                    </router-link>
                </template>
            </div>
        
        </div>
      </div>

    </section>
</template>


<script>
import { mapGetters } from 'vuex'

export default {
    name: 'BakdHeader',

    computed: mapGetters({
        authenticated: 'auth/check'
    }),
    
    mounted() {
        new WOW().init();
    }
}
</script>

<style scoped lang="scss">
    .is-white {
        color: #fff;
    }

    .main-hero-header {
        background-image: url('/images/backgrounds/desk-header.jpg'); 
        background-position: center; 
        background-size: cover; 
        background-attachment: fixed;
        background-repeat: no-repeat;
        overflow: hidden;
        max-height: 700px;
        min-height: 370px;
        position: relative;
        border-bottom: 3px solid #EE8600;
        box-shadow: 0px 0px 10px -2px rgba(0, 0, 0, 0.3);
        -webkit-box-shadow: 1px 1px 20px -5px rgba(0, 0, 0, 0.5);

        &:before {
            position: absolute;
            opacity: 0.5;
            content: '';
            background: #000;
            width: 100%;
            height: 100%;
        }

        @media (max-width: 768px) {
            padding-top: 60px;
        }
    }
</style>