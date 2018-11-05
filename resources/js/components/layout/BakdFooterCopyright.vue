<template>
	<div class="sub-footer">
		<div class="container">
			<div class="level columns is-mobile">
				<div class="level-item column is-fullwidth-mobile is-half-tablet has-text-left is-size-7 locale-dropdown">
					<locale-dropdown dropdown="is-top-right"/>
				</div>
				<div class="level-item column is-fullwidth-mobile is-half-tablet has-text-right is-size-7">
					<strong>Made with <fa icon="heart" class="is-red"/> All Over the World</strong>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import LocaleDropdown from '../elements/LocaleDropdown'

export default {
	name: 'BakdFooterCopyright',

	components: {
		LocaleDropdown
	}
}
</script>

<style scoped lang="scss">
	@import './resources/sass/variables';

    .sub-footer {
        background: #f5f5f5;
        border-top: 1px solid $primary;
		padding: 20px 0px;
		height: 100%;
		display: block;
		border-bottom: 1px solid #cdcdcd;
        -webkit-box-shadow: 0 -2px 4px 0 rgba(0, 0, 0, 0.1);
        box-shadow: 0 -2px 4px 0 rgba(0, 0, 0, 0.1);
    }

	@media (max-width: 768px) {
		.locale-dropdown {
			margin: 0 auto;
			text-align: center;
		}
	}

    .fa-heart {
    	color: red;
    	margin: 0 5px;
    }
</style>