<template>
  <aside class="menu account-sidebar">
	<template v-for="(section, sectionIndex) in links">
		<p class="menu-label">
			{{ sectionIndex | uppercase }}
		</p>
		<ul class="menu-list">
			<template v-for="(link, index) in section">
		      <li @click="handleNavClick($event, sectionIndex)">
		        <router-link :to="{ name: link.to }" :class="{ 'is-active': link.isActive }">
		        	{{ link.name }}
		        </router-link>
		      </li>
			</template>
		</ul>
	</template>
  </aside>
</template>

<script>
export default {

	data() {
	    return {
	      links: {

	        // General Items
	        general: [
	          {
	            name: 'Dashboard',
	            slug: 'dashboard',
	            to: 'members.dashboard',
	            isActive: false,
	          },
	          {
	            name: 'Edit Profile',
	            slug: 'profile',
	            to: 'members.settings.profile',
	            isActive: false,
	          },
	          {
	            name: 'Change Password',
	            slug: 'password',
	            to: 'members.settings.password',
	            isActive: false,
	          },
	          {
	            name: 'Privacy Settings',
	            slug: 'privacy',
	            to: 'members.settings.privacy',
	            isActive: false,
	          },
	          {
	            name: 'Followers',
	            slug: 'followers',
	            to: 'members.followers',
	            isActive: false,
	          },
	          {
	            name: 'Following',
	            slug: 'following',
	            to: 'members.following',
	            isActive: false,
	          },
	          {
	            name: 'Bounty Dashboard',
	            slug: 'bounty_dashboard',
	            to: 'bounty.dashboard',
	            isActive: false,
	          }
	        ],

	        // Campaigns
	        campaigns: [
	          {
	            name: 'My Watchlist',
	            slug: 'watchlist',
	            to: 'members.watchlist',
	            isActive: false,
	          },
	          {
	            name: 'My Campaigns',
	            slug: 'campaigns',
	            to: 'members.campaigns',
	            isActive: false,
	          },
	          {
	            name: 'Start a Campaign',
	            slug: 'start_campaign',
	            to: 'campaigns.create',
	            isActive: false,
	          }
	        ],

	        // Transactions
	        transactions: [
	          {
	            name: 'My Balance',
	            slug: 'balance',
	            to: 'members.balance',
	            isActive: false,
	          },
	          {
	            name: 'My Contributions',
	            slug: 'contributions',
	            to: 'members.contributions',
	            isActive: false,
	          },
	          {
	            name: 'Deposit/Withdraw',
	            slug: 'deposit',
	            to: 'members.deposit',
	            isActive: false,
	          },
	          {
	            name: 'Transaction History',
	            slug: 'tx_history',
	            to: 'transaction.history',
	            isActive: false,
        	  }
		  ]
		}          
	  }
	},

	methods: {
	    handleNavClick(link, section) {
	      this.links[section].forEach((el) => {
	        el.isActive = false;
	        if (link.target.innerText === el.name) {
	        	el.isActive = true
	        }
	      });
	    }
	},

	created() {
		for (var section in this.links) {
			this.links[section].forEach((link) => {
				if (link.to === this.$route.name) {
					link.isActive = true
				}
			})
		}
	}
}
</script>

<style lang="scss" scoped>
	.account-sidebar {
		padding-bottom: 80px;
	}
</style>