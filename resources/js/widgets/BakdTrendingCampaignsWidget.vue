<template>
  <div class="widget">
    <p class="has-text-left title is-size-5">
      Trending Campaigns
    </p>
    <div class="box">
      <article class="media is-fullwidth" v-for="n in 4" :key="n">
        <figure class="media-left">
          <img src="https://via.placeholder.com/56" class="is-v-centered"/>
        </figure>
        <div class="media-body control is-100 is-v-centered">
          <p class="title is-size-6">
            Bitcoin
          </p>
          <p class="subtitle is-size-7 has-text-grey-light">
            A Peer-to-Peer Electronic Cash System
          </p>
        </div>
        <p class="media-right is-pulled-right has-text-right is-v-centered">
          <b-tooltip label="Add to Watchlist" type="is-dark">
            <a href="#" class="is-v-centered">
              <!-- <b-icon icon="plus-circle" /> -->
              <i class="la la-plus-square la-2x"/>
            </a>
          </b-tooltip>
        </p>
      </article>
      <div class="box-footer">
        <router-link :to="{ name: 'campaigns.directory' }" class="button is-rounded is-outlined--off is-primary is-fullwidth is-normal" style="max-width: 140px; margin: 20px auto 5px;">
          <span class="is-size-7"><i class="la la-plus" /> View More</span>
        </router-link>
      </div>
    </div>
  </div>
</template>