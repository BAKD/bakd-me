// Bounty Routes
const BountyView = () => import('~/pages/bounty/view').then(m => m.default || m)
const BountyAll = () => import('~/pages/bounty/all').then(m => m.default || m)
const BountyClaim = () => import('~/pages/bounty/claim').then(m => m.default || m)
const BountyClaimEdit = () => import('~/pages/bounty/claim_edit').then(m => m.default || m)
const BountyDashboard = () => import('~/pages/bounty/dashboard').then(m => m.default || m)

export default [
	// Bounty Dashboard Pages
	{ path: '/bounty', name: 'bounty.all', component: BountyAll },
	{ path: '/bounty/view/:id', name: 'bounty.view', component: BountyView },
	{ path: '/bounty/:id/claim', name: 'bounty.claim', component: BountyClaim },
	{ path: '/bounty/:id/claim/:claim_id', name: 'bounty.claim.edit', component: BountyClaimEdit },
	{ 
		path: '/bounty/dashboard', 
		name: 'bounty.dashboard', 
		component: BountyDashboard,
		meta: { 
		  breadcrumbs: [
	        {
	          name: 'Home',
	          to: 'homepage',
	          active: false
	        },
	        {
	          name: 'Members',
	          to: 'members.dashboard',
	          active: false
	        },
	        {
	          name: 'Bounty Dashboard',
	          active: true
	        }
	      ],
  		}
	}
]