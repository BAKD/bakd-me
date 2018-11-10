<template>
    <section class="section bakd-site-stats" v-waypoint="{ active: true, callback: onSiteStatsWaypoint }">
      <div class="container">
        <div class="columns has-text-centered">
          <div class="column is-one-third">
            <i class="la la-users is-primary has-shadow la-4x"/>
            <br />
            <h2 class="title is-bold is-size-1 members-odometer">
              72,123
            </h2>
            <h3 class="subtitle has-text-grey-light is-size-6">
              Current Members
            </h3>
          </div>
          <div class="column is-one-third">
            <i class="la la-money is-primary has-shadow la-4x"/>
            <br />
            <h2 class="title is-bold is-size-1">
              <span class="contributions-odometer">373</span>M
            </h2>
            <h3 class="subtitle has-text-grey-light is-size-6">
              Total Contributions
            </h3>
          </div>
          <div class="column is-one-third">
            <i class="la la-bar-chart is-primary has-shadow la-4x"/>
            <br />
            <h2 class="title is-bold is-size-1 campaigns-odometer">
              1,381
            </h2>
            <h3 class="subtitle has-text-grey-light is-size-6">
              Active Campaigns
            </h3>
          </div>
        </div>
      </div>
    </section>
</template>

<script>
export default {
	name: 'BakdSiteStats',

  methods: {
    onSiteStatsWaypoint ({ going, direction }) {
      if (going === this.$waypointMap.GOING_IN) {
        var $membersOdometer = $('.members-odometer');
        var $contributionsOdometer = $('.contributions-odometer');
        var $campaignsOdometer = $('.campaigns-odometer');

        var membersOd = new Odometer({
          el: $membersOdometer.get(0),
        });
        
        var contributionsOd = new Odometer({
          el: $contributionsOdometer.get(0),
        });

        var campaignsOd = new Odometer({
          el: $campaignsOdometer.get(0),
        });

        // TODO: Fix these
        membersOd.update(78192)
        contributionsOd.update(373)
        campaignsOd.update(1392)
      }
    }
  }
}	
</script>