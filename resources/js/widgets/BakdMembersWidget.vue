<template>
	<div class="widget">

	    <p class="has-text-left title is-size-5">
	      Trending Members
	    </p>
	    <div class="box">
	      <article class="media is-fullwidth" v-for="n in 4" :key="n">
	        <figure class="media-left">
	          <img src="/images/no-avatar.png" class="is-v-centered image" style="width: 100%; height: auto; max-width: 56px;" />
	        </figure>
	        <div class="media-body control is-100 is-v-centered">
	          <p class="title is-size-6">
	            Tom Grenier
	          </p>
	          <p class="subtitle is-size-7 has-text-grey-light">
	            Blockchain Developer
	          </p>
	        </div>
	        <p class="media-right is-pulled-right has-text-right is-v-centered">
		        <b-tooltip label="Follow" type="is-dark">
		          <a href="#" class="is-v-centered">
		            <!-- <b-icon icon="plus-circle"/> -->
		            <i class="la la-plus-square la-2x"/>
		          </a>
				</b-tooltip>
	        </p>
	      </article>

	      <div class="box-footer">
	        <router-link :to="{ name: 'members.directory' }" href="#" class="button is-primary is-rounded is-outlined--off is-fullwidth is-normal" style="max-width: 140px; margin: 20px auto 5px;">
	          <span class="is-size-7"><i class="la la-plus" /> View More</span>
	        </router-link>
	      </div>
	    </div>

	</div>
</template>