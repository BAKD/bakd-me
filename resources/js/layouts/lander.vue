<template>
  <div class="basic-layout d-flex align-items-center justify-content-center m-0 bg-white">
    <div class="logo-wrapper">
      <router-link :to="{ name: 'homepage' }">
        <img src="/images/branding/logo.png" class="is-responsive logo" />
      </router-link>
    </div>
    <div class="links-wrapper is-pulled-right">
      <a class="is-bold" href="">
        Register
      </a>
    </div>

    <child/>
    
    <div class="has-text-centered copyright-footer">
      Copyright 2018 &copy; <strong>BAKD</strong> Solutions. All rights reserved.
      <p>
        <router-link :to="{ name: 'privacy' }">Privacy Policy</router-link> | <router-link :to="{ name: 'terms' }">Terms & Conditions</router-link>
      </p>
    </div>
  </div>
</template>

<script>
export default {
  middleware: 'guest',

  name: 'BasicLayout'
}
</script>

<style scoped lang="scss">
.basic-layout {
  color: #636b6f;
  height: 100vh;
  position: relative;
  background-image: url('/images/backgrounds/login-background-2.png');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  
  .links-wrapper {
    float: right;
    position: absolute;
    top: 40px;
    right: 40px;
  }

  .logo {
    width: 100%; 
    max-width: 300px; 
    margin: 0 auto; 
    position: relative; 
    padding: 30px;
  }

  .copyright-footer {
    padding: 20px;
    bottom: 0;
    position: absolute;
    margin: 0 auto;
    width: 100%;

    @media (max-height: 700px) {
      position: relative;
    }
  }

  .logo-wrapper {
    text-align: left;
    display: block; 
    position: relative; 
    width: 100%; 
    margin-bottom: 30px;

    @media (max-width: 767px) {
      text-align: center;
    }
  }

  .links > a {
    color: #636b6f;
    padding: 0 25px;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: .1rem;
    text-decoration: none;
    text-transform: uppercase;
  }
}
</style>
