// Organizations Routes
const OrganizationView = () => import('~/pages/organizations/view').then(m => m.default || m)
const OrganizationCreate = () => import('~/pages/organizations/create').then(m => m.default || m)
const OrganizationEdit = () => import('~/pages/organizations/edit').then(m => m.default || m)
const OrganizationAll = () => import('~/pages/organizations/all').then(m => m.default || m)
const OrganizationMember = () => import('~/pages/organizations/member').then(m => m.default || m)

export default [
  // Organizations Pages
  { path: '/organizations/:id', name: 'organizations.view', component: OrganizationView },
  { path: '/organizations/create', name: 'organizations.create', component: OrganizationCreate },
  { path: '/organizations/:id/edit', name: 'organizations.edit', component: OrganizationEdit },
  { path: '/organizations/all', name: 'organizations.all', component: OrganizationAll },
  { path: '/organizations/member', name: 'organizations.member', component: OrganizationMember },
]