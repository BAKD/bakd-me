<template>
    <footer class="footer is-dark">
        <div class="container">
            <!-- <locale-dropdown dropdown="is-top-right" />  -->
            <div class="columns footer-columns">
                <div class="column link-column is-4">
                    <h2>
                        <span class="is-size-5">
                            About Us
                        </span>
                    </h2>
                    <hr/>
                    <!-- <p style="padding-bottom: 20px;"> -->
                    <p>
                       <strong>BAKD</strong> not only gives startups the capital they need to succeed, but we instill a sense of confidence among our members, all while providing them the tools they'll need to succeed.
                    </p>
                    <br />
                    <p class="has-text-centered">
                        <i>Invest with <strong>confidence</strong></i>
                    </p>
                    <!-- <p>
                       All of this is made possible by way of the <strong>BAKD</strong> Cryptocurrency Protocol. <strong>BAKD</strong> Coins are used to both invest in campaigns, as well as to pay campaign disbursements to project/campaign owners. 
                    </p> -->

                    <!-- <ul class="level social-icons">
                        <li><b-icon pack="fab" icon="twitter" class="is-twitter level-item" /></li>
                        <li><b-icon pack="fab" icon="github" class="is-github level-item" /></li>
                        <li><b-icon pack="fab" icon="discord" class="is-discord level-item" /></li>
                        <li><b-icon pack="fab" icon="reddit" class="is-reddit level-item" /></li>
                        <li><b-icon pack="fab" icon="medium" class="is-medium level-item" /></li>
                    </ul> -->
                </div>
                <div class="column is-8">

                    <div class="columns">
                    <div class="column link-column is-4">
                        <h2>
                            <span class="is-size-5">
                                Quick Links
                            </span>
                        </h2>
                        <hr/>
                        <ul>
                            <li>
                                <router-link :to="{ name: 'campaigns.directory' }">
                                    <fa icon="chevron-right" class="is-size-7" /> <span>Find a Project</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{ name: 'campaigns.create' }">
                                    <fa icon="chevron-right" class="is-size-7" /> <span>Start a Campaign</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{ name: 'bounties.all' }">
                                    <fa icon="chevron-right" class="is-size-7" /> <span>Bounties & Contests</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{ name: 'privacy' }">
                                    <fa icon="chevron-right" class="is-size-7" /> <span>Privacy Policy</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{ name: 'terms' }">
                                    <fa icon="chevron-right" class="is-size-7" /> <span>Terms & Conditions</span>
                                </router-link>
                            </li>
                        </ul>
                    </div>
                    <div class="column link-column is-4">
                        <h2>
                            <span class="is-size-5">
                                Resources
                            </span>
                        </h2>
                        <hr/>
                        <ul>
                            <li>
                                <a href="https://medium.com/@bakd" target="_blank">
                                    <fa icon="chevron-right" class="is-size-7" /> <span>Our Blog</span>
                                </a>
                            </li>
                            <li>
                                <router-link :to="{ name: 'resources.index' }">
                                    <fa icon="chevron-right" class="is-size-7" /> <span>Resources</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{ name: 'contact' }">
                                    <fa icon="chevron-right" class="is-size-7" /> <span>Join the Team</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{ name: 'contact' }">
                                    <fa icon="chevron-right" class="is-size-7" /> <span>Contact Support</span>
                                </router-link>
                            </li>
                            <li>
                                <a href="https://bakd.io" target="_blank">
                                    <fa icon="chevron-right" class="is-size-7" /> <span>Information Portal</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="column link-column is-4">
                        <h2>
                            <span class="is-size-5">
                                Newsletter
                            </span>
                        </h2>
                        <hr/>
                        <div class="newsletter-wrapper">
                            <!-- Name -->
                            <bakd-input 
                              name="email" 
                              type="email" 
                              :placeholder="$t('Enter your email...')" 
                              :form="form" 
                              style="margin-top: 15px;margin-bottom: 8px;"
                              v-model="form.email" />
                            
                            <!-- Submit Button -->
                            <v-button class="is-rounded is-medium is-fullwidth" :loading="form.busy" style="margin-bottom: 10px;">
                                <span class="is-size-6">Subscribe</span>
                            </v-button>
                        </div>
                        
                        <!-- <hr /> -->
                        
                        <ul class="level social-icons">
                            <li><b-icon pack="fab" icon="twitter" class="is-twitter level-item" /></li>
                            <li><b-icon pack="fab" icon="github" class="is-github level-item" /></li>
                            <li><b-icon pack="fab" icon="discord" class="is-discord level-item" /></li>
                            <li><b-icon pack="fab" icon="reddit" class="is-reddit level-item" /></li>
                            <li><b-icon pack="fab" icon="medium" class="is-medium-blog level-item" /></li>
                        </ul>

                        <!-- <img src="/images/branding/logo.png" class="footer-branding" /> -->
                    
                    </div>
                </div>
                </div>
            </div>
        </div>
    </footer>
</template>


<script>
// import LocaleDropdown from '../elements/LocaleDropdown'
import Form from 'vform'
import BakdInput from '~/components/elements/BakdInput'

export default {
    name: 'bakd-footer',

    components: {
        BakdInput
    },
    
  data: () => ({
    form: new Form({
        email: ''
    }),
    navigation: 'home',
    appName: window.config.appName,
  }),
}
</script>

<style scoped lang="scss">
    @import './resources/sass/variables';

    .footer {
        border-top: 3px solid $primary;
        margin-top: .5rem;
        background: #fff;
        z-index: 9;
        position: relative;
    }

    .footer-columns {
        .link-column:not(:last-child) {
            padding-right: 5rem;

            @media (max-width: 1279px) {
                padding-right: .5rem;
            }
        }
    }

    footer {
        -webkit-box-shadow: 0 -2px 4px 0 rgba(0, 0, 0, 0.1);
        box-shadow: 0 -2px 4px 0 rgba(0, 0, 0, 0.1);
        ul {
            padding-left: 5px;

            li {
                padding: 3px 0;
            }

            a {
                color: #333;

                &:hover,
                &:focus,
                &:active {

                    span {
                        margin-left: 1px;
                        transition: all .15s ease;
                    }
                    
                    .fa-chevron-right {
                        color: $primary;
                        margin-left: 4px;
                        transition: all .2s ease;
                    }
                }
            }

        }

        hr {
            margin: 15px 0;
            color: #aaa;
        }

        h2 {
            font-weight: 700;
        }
        
        .social-icons {
            text-align: center;
            font-size: 3rem;
            list-style: none;
            text-align: center;
            padding: 0;
            max-width: 230px;
            width: 100%;
            margin: 1rem auto;

            li {
                display: inline-block;
                text-align: center;
                max-width: 30px;
            }

            .fa {
                margin: 0 auto;
            }
        }

        .footer-branding {
            width: 100%;
            max-width: 300px;

            @media (max-width: 767px) {
                display: none;
            }
        }

        .newsletter-wrapper {
            @media (max-width: 767px) {
                margin-top: 40px;
            }
        }
    }
    
</style>