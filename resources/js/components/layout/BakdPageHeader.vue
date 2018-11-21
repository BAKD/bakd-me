<template>
    <section :size="size" class="hero page-hero-header is-primary has-text-centered" :style="background ? `background-image: url('${background}')` : ''">
      <div class="hero-body">
        <div class="container">
         <slot/>
        </div>
      </div>
    </section>
</template>

<script>
export default {
    name: 'BakdPageHeader',

    props: {
        size: {
            type: String,
            default: 'is-medium'
        },

        background: {
            type: String
        }
    },
    
    data: () => ({
    
    }),

    // mounted() {
    //     new WOW().init();
    // }
}
</script>

<style scoped lang="scss">

    .page-hero-header {
        background-image: url('/images/backgrounds/desk-header.jpg'); 
        background-position: center; 
        background-size: cover; 
        background-attachment: fixed;
        background-repeat: no-repeat;
        overflow: hidden;
        max-height: 700px;
        position: relative;
        border-bottom: 3px solid #EE8600;
        box-shadow: 0px 0px 10px -2px rgba(0, 0, 0, 0.3);
        -webkit-box-shadow: 1px 1px 20px -5px rgba(0, 0, 0, 0.5);

        &:before {
            position: absolute;
            opacity: 0.35;
            content: '';
            background: #000;
            width: 100%;
            height: 100%;
        }
    }
</style>