// Member Profile Pages
const MembersProfileView = () => import('~/pages/members/profile/view').then(m => m.default || m)
const MembersProfileEdit = () => import('~/pages/members/profile/edit').then(m => m.default || m)
const MembersSettings = () => import('~/pages/members/settings/index').then(m => m.default || m)
const MembersProfile = () => import('~/pages/members/settings/profile').then(m => m.default || m)
const MembersPassword = () => import('~/pages/members/settings/password').then(m => m.default || m)
const MembersDashboard = () => import('~/pages/members/dashboard').then(m => m.default || m)
const MembersDirectory = () => import('~/pages/members/directory').then(m => m.default || m)

export default [
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

  // Member settings
  { path: '/members/settings', name: 'members.settings', component: MembersSettings },
  { path: '/members/settings/profile', name: 'members.settings.profile', component: MembersProfile },
  { path: '/members/settings/password', name: 'members.settings.password', component: MembersPassword },
]