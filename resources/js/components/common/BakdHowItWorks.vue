<template>
	<section class="section how-it-works section-white is-marginless">
	  <div class="container">
		<bakd-section-title title="How it Works" subtitle="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias natus nulla asperiores incidunt."/>
		  <div class="tile wow fadeInUp" v-for="n in 3" :key="n" style="margin-top: 80px;">
		    <div class="level">
		      <div class="level-left has-text-centered is-margin-centered" style="padding-right: 20px;">
		        <img src="https://via.placeholder.com/120" />
		      </div>
		      <div class="level-content is-v-centered">
		        <p class="title is-size-5 is-bold is-marginless">
		          Step {{ n }} - Lorem ipsum dolor sit amet
		        </p>
		        <p style="line-height: 26px;">
		          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic necessitatibus sit soluta, odit aspernatur eos iste laborum ipsa harum quidem itaque aliquid modi quis, dolores impedit odio, ipsam, id incidunt. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Impedit iusto sit modi quam officiis dolore consequatur officia accusantium? Voluptates magni quia ex praesentium illum facilis harum iste ut possimus neque!
		        </p>
		      </div>
		    </div>
		    <hr/>
		  </div>
		  <div class="buttons has-text-centered is-grouped is-margin-centered">
		    <router-link :to="{ name: 'campaigns.create' }" class="button is-rounded is-large is-wide is-primary is-margin-centered">
		      <span class="is-size-6"><i class="la la-bar-chart is-size-5" /> Start a Campaign</span>
		    </router-link>
		  </div>
		  <br />
	  </div>
	</section>
</template>