  // Campaigns Components
const CampaignsDirectory = () => import('~/pages/campaigns/directory').then(m => m.default || m)
const CampaignsView = () => import('~/pages/campaigns/view').then(m => m.default || m)
const CampaignsDashboard = () => import('~/pages/campaigns/dashboard').then(m => m.default || m)
const CampaignsCreate = () => import('~/pages/campaigns/create').then(m => m.default || m)

export default [
  { path: '/campaigns/view/:id', name: 'campaigns.view', component: CampaignsView },
  { path: '/campaigns/view/:id/dashboard', name: 'campaigns.dashboard', component: CampaignsDashboard },
  { path: '/campaigns/create', name: 'campaigns.create', component: CampaignsCreate },
  { path: '/campaigns/directory', name: 'campaigns.directory', component: CampaignsDirectory },
]