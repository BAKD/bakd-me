<template>
	<div class="has-text-centered">
		<h2 class="title is-size-3 wow fadeInDown" v-html="title"></h2>
		<h3 class="subtitle is-6 wow fadeInUp" v-html="subtitle"></h3>
		<hr />
	</div>
</template>

<script>
export default {
	name: 'BakdSectionTitle',

	props: {
		
		title: {
			type: String,
			required: true
		},

		subtitle: {
			type: String,
			required: true
		}

	}
}
</script>