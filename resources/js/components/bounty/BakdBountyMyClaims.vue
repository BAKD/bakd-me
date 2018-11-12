<template>
	<nav class="panel has-shadow">
		<div class="panel-block is-size-4">
			<fa icon="list" class="is-size-6" />&nbsp;<span class="is-size-5 is-bold">My Claims</span>
		</div>
		<div class="panel-block">
		    <table class="table is-fullwidth is-size-7" v-if="isReady">
				<tr v-for="claim in claims" key="claim.id">
					<td>
						{{ claim.id }}
					</td>
					<td>
						{{ claim.user_id }}
					</td>
				</tr>
			</table>
		</div>
	</nav>
</template>

<script>
	export default {
		props: {
			claims: {
				type: Array,
				required: true
			},
			isReady: {
				type: Boolean,
				required: true
			}
		}
	}
</script>