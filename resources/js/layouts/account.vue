<template>
  <div class="main-layout">
    <navbar/>
    <!-- <bakd-header/> -->

    <div class="container" style="padding-top: 80px;">
      <div class="columns">
        
        <!-- SIDEBAR -->
      <div class="column is-3">
        <aside class="menu">
        <p class="menu-label">
          General
        </p>
        <ul class="menu-list">
          <li><a class="is-active">Dashboard</a></li>
          <!-- <li><a>Messages</a></li> -->
          <li>
            <router-link :to="{ name: 'members.settings.profile' }">Edit Profile</router-link>
          </li>
            <router-link :to="{ name: 'members.settings.password' }">Change Password</router-link>
          <li><a>Privacy Settings</a></li>
          <li><a>My Followers</a></li>
          <li>
            <router-link :to="{ name: 'bounties.dashboard' }">My Bounties</router-link>
          </li>
        </ul>
        <p class="menu-label">
          Projects
        </p>
        <ul class="menu-list">
          <li><a>My Watchlist</a></li>
          <li><a>My Campaigns</a></li>
          <li><a>Start a Campaign</a></li>
        </ul>
        <p class="menu-label">
          Transactions
        </p>
        <ul class="menu-list">
          <li><a>My Balance</a></li>
          <li><a>My Contributions</a></li>
          <li><a>Deposit/Withdraw</a></li>
          <li><a>Transaction History</a></li>
        </ul>
        <!-- <p class="menu-label">
          Team Settings
        </p>
        <ul class="menu-list">
          <li><a>My Team</a></li>
          <li>
            <a>Manage Your Team</a>
            <ul>
              <li><a>Invite Teammembers</a></li>
              <li><a>Find Teammembers</a></li>
            </ul>
          </li>
        </ul> -->
      </aside>
    </div>
    <!-- END SIDEBAR -->


    <!-- MAIN -->
    <div class="column is-9" style="background: #fff;">
      <div class="breadcrumb" aria-label="breadcrumbs">
        <ul>
          <li><a href="../">Home</a></li>
          <li><a href="../">Members</a></li>
          <li class="is-active"><a href="#" aria-current="page">Dashboard</a></li>
        </ul>
      </div>
      <child/>
    </div>
    <!-- END MAIN -->




  </div>
    </div>
    <back-to-top/>
    <bakd-footer></bakd-footer>
    <bakd-footer-copyright/>
  </div>
</template>

<script>
import Navbar from '~/components/layout/Navbar'
import NavbarHeader from '~/components/layout/NavbarHeader'
import BakdHeader from '~/components/layout/BakdHeader'
import BakdFooter from '~/components/layout/BakdFooter'
import BakdFooterCopyright from '~/components/layout/BakdFooterCopyright'

export default {
  name: 'AccountLayout',

  components: {
    Navbar,
    NavbarHeader,
    BakdHeader,
    BakdFooter,
    BakdFooterCopyright
  }
}
</script>
