const Homepage = () => import('~/pages/homepage').then(m => m.default || m)
const Login = () => import('~/pages/auth/login').then(m => m.default || m)
const Register = () => import('~/pages/auth/register').then(m => m.default || m)
const PasswordEmail = () => import('~/pages/auth/password/email').then(m => m.default || m)
const PasswordReset = () => import('~/pages/auth/password/reset').then(m => m.default || m)
const NotFound = () => import('~/pages/errors/404').then(m => m.default || m)

// Static Pages
const ContactUs = () => import('~/pages/static/contact').then(m => m.default || m)
const PrivacyPolicy = () => import('~/pages/static/privacy').then(m => m.default || m)
const TermsAndConditions = () => import('~/pages/static/terms').then(m => m.default || m)
const HowItWorks = () => import('~/pages/static/how-it-works').then(m => m.default || m)

// Member Profile Pages
const MembersProfileView = () => import('~/pages/members/profile/view').then(m => m.default || m)
const MembersProfileEdit = () => import('~/pages/members/profile/edit').then(m => m.default || m)
const MembersSettings = () => import('~/pages/members/settings/index').then(m => m.default || m)
const MembersProfile = () => import('~/pages/members/settings/profile').then(m => m.default || m)
const MembersPassword = () => import('~/pages/members/settings/password').then(m => m.default || m)

const MembersDashboard = () => import('~/pages/dashboard').then(m => m.default || m)


const MembersDirectory = () => import('~/pages/members/directory').then(m => m.default || m)
const CampaignsDirectory = () => import('~/pages/campaigns/directory').then(m => m.default || m)


const CampaignsView = () => import('~/pages/campaigns/view').then(m => m.default || m)
const CampaignsDashboard = () => import('~/pages/campaigns/dashboard').then(m => m.default || m)
const CampaignsCreate = () => import('~/pages/campaigns/create').then(m => m.default || m)

const Resources = () => import('~/pages/resources/index').then(m => m.default || m)


const BountiesView = () => import('~/pages/bounties/view').then(m => m.default || m)
const BountiesAll = () => import('~/pages/bounties/all').then(m => m.default || m)
const BountiesClaim = () => import('~/pages/bounties/claim').then(m => m.default || m)
const BountiesDashboard = () => import('~/pages/bounties/dashboard').then(m => m.default || m)


export default [
  { path: '/', name: 'homepage', component: Homepage },

  // Auth Pages
  { path: '/login', name: 'login', component: Login },
  { path: '/register', name: 'register', component: Register },
  { path: '/password/reset', name: 'password.request', component: PasswordEmail },
  { path: '/password/reset/:token', name: 'password.reset', component: PasswordReset },

  // Bounty Dashboard Pages
  { path: '/bounties', name: 'bounties.all', component: BountiesAll },
  { path: '/bounties/view/:id', name: 'bounties.view', component: BountiesView },
  { path: '/bounties/claim/:id', name: 'bounties.claim', component: BountiesClaim },
  { path: '/bounties/dashboard', name: 'bounties.dashboard', component: BountiesDashboard },

  // Static Pages
  { path: '/contact', name: 'contact', component: ContactUs },
  { path: '/terms-and-conditions', name: 'terms', component: TermsAndConditions },
  { path: '/privacy-policy', name: 'privacy', component: PrivacyPolicy },
  { path: '/how-it-works', name: 'how-it-works', component: HowItWorks },

  // Resources Index
  { path: '/resources', name: 'resources.index', component: Resources },


  // Campaigns Pages
  { path: '/campaigns/view/:id', name: 'campaigns.view', component: CampaignsView },
  { path: '/campaigns/view/:id/dashboard', name: 'campaigns.dashboard', component: CampaignsDashboard },
  { path: '/campaigns/create', name: 'campaigns.create', component: CampaignsCreate },
  { path: '/campaigns/directory', name: 'campaigns.directory', component: CampaignsDirectory },


  // Member Profile Pages
  // Show all members -- alias for directory maybe?
  { path: '/u/:id', name: 'members.show.public', component: MembersProfileView },
  // Alias for above url
  { path: '/u/:username', name: 'members.show.public.username', component: MembersProfileView },
  // View public profile as auth'd user
  { path: '/members/profile', name: 'members.profile', component: MembersProfileView },
  // Edit profile as auth'd user
  { path: '/members/profile/edit', name: 'members.profile.edit', component: MembersProfileEdit },
  { path: '/members/directory', name: 'members.directory', component: MembersDirectory },
  { path: '/members/dashboard', name: 'members.dashboard', component: MembersDashboard },

  // User Account Paes
  { path: '/members/settings',
    component: MembersSettings,
    children: [
      { path: '', redirect: { name: 'members.settings.password' } },
      { path: '/members/settings/profile', name: 'members.settings.profile', component: MembersProfile },
      { path: '/members/settings/password', name: 'members.settings.password', component: MembersPassword }
    ],
    name: 'members.settings' },

    // { path: '/users', name: 'users', component: Users },

  { path: '*', component: NotFound }
]
