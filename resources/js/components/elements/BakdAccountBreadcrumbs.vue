<template>
	<section class="breadcrumb-wrapper">
		<div class="breadcrumb" aria-label="breadcrumbs">
			<ul>
			  <li v-for="(breadcrumb, index) in breadcrumbs">
			  	  <router-link 
			  	  		:to="{ name: breadcrumb.to }"
			  			:class="{ 'is-active': (index != Object.keys(breadcrumbs).length - 1) }">
			  	  	{{ breadcrumb.name }}
			  	  </router-link>
			  	</li>
			</ul>
		</div>
	</section>
</template>

<script>
export default {
	name: 'bakd-account-breadcrumbs',

	data() {
		return {
			breadcrumbs: []
		}
	},

	mounted() {
		var self = this
		this.$on('scrollAfterEnter', () => {
			self.breadcrumbs = self.$route.meta.breadcrumbs || ''
		})
	}
}
</script>

<style lang="scss" scoped>
	.breadcrump-wrapper {
		margin: 10px 0 20px;
	}
</style>