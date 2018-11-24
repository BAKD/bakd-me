<template>
  <section class="featured-members-section has-white-bg section level" style="border-top: 2px solid #cdcdcd; border-bottom: 2px solid #cdcdcd; margin: 0 0 40px 0; min-height: 400px; padding: 50px 10px;">
    <div class="container has-text-centered">
      <bakd-section-title title="FEATURED MEMBERS" subtitle="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio eligendi perspiciatis explicabo neque sint." />
      <div class="columns has-text-centered" style="margin: 0 auto;">
        
        <!-- Member Card -->
        <div class="column level-item wow fadeIn" v-for="(member, index) in members" :key="member.id">
          <router-link :to="{ name: 'members.show.public', params: { id: member.id } }">
            <img :src="member.avatar_url || member.photo_url" class="image member-image" />
          </router-link>
          <h2 class="title is-size-4" style="padding: 30px;">
            <b-tooltip type="is-dark" animated :label="`Follow ${member.name}`">
              <a href="#" class="button is-normal icon is-primary is-v-centered has-hand-cursor" style="top: 3px; position: relative;"><fa icon="plus"/></a> 
            </b-tooltip>
            <router-link :to="{ name: 'members.show.public', params: { id: member.id } }">
              {{ member.name }}
            </router-link>
          </h2>
          <h3 class="subtitle is-size-6 has-text-grey-light">
            {{ member.type }}
          </h3>
          <p style="padding: 20px 0;">
            {{ member.bio || 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam voluptatibus soluta rerum laborum reiciendis ducimus dolor error quibusdam eaque.' }}
          </p>
        </div>
        <!-- End Member Card -->

      </div>
    </div>
  </section>
</template>

<script>
import BakdSectionTitle from '~/components/common/BakdSectionTitle'

export default {

  components: {
    BakdSectionTitle
  },

  data() {
    return {
      isReady: false,
      isLoading: true,
      members: []
    }
  },

  methods: {
    fetchMembers: function () {
      var self = this
      var limit = 3

      axios
        .post('/api/users/random', { limit })
        .then(function(response) { 
          self.members = response.data
          self.isLoading = false
          self.isReady = true
        })
    }
  },

  created() {
    this.fetchMembers()
  }
}
</script>


<style lang="scss" scoped>
.member-image {
  width: 100%;
  max-width: 350px;
  height: auto;
  margin: 0 auto;
}
.featured-members-section {
    // display: block;
    // height: 100%;
    // width: 100%;
    // background-color: #fff;
    // background-image: url('/images/footer-bg-sm.png');
    // background-size: contain;
    // background-position: center;
}
</style>