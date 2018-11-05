<template>
    <nav class="navbar navbar-header">
        <div class="navbar-start">
            <!-- Start -->
        </div>

        <div class="navbar-end">
            <locale-dropdown/> 
        </div>
    </nav>
</template>


<script>
import LocaleDropdown from '../elements/LocaleDropdown'

export default {
    components: {
        LocaleDropdown
    },
    
  data: () => ({
    navigation: 'home',
    appName: window.config.appName,
  }),
}
</script>

<style scoped lang="scss">
    @import './resources/sass/variables';

    .navbar-header {
        border-top: 4px solid $primary;
        background: #555;
        background-color: #555;
        color: #fff;
        height: 28px;
        min-height: unset;
    }
</style>