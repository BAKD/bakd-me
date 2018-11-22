<template>
  <div class="widget has-text-centered">
    <!-- <img src="https://via.placeholder.com/320x250" style="height: auto; width: 100%; max-width: 320px;" /> -->
	

    <p class="has-text-left title is-size-5">
      Sponsored
    </p>
	
	<router-link :to="{ name: 'bounty.view', params: { id: 18 }}">
	    <img src="/images/ads/spread-word-banner.jpg" style="height: auto; width: 100%; max-width: 320px;" />
  	</router-link>
  </div>
</template>