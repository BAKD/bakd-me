// Route imports
import bountyRoutes from './bounty'
import organizationRoutes from './organization'
import memberRoutes from './member'
import campaignRoutes from './campaign'

// Home
const Homepage = () => import('~/pages/homepage').then(m => m.default || m)

// Auth Routes
const Login = () => import('~/pages/auth/login').then(m => m.default || m)
const Register = () => import('~/pages/auth/register').then(m => m.default || m)
const PasswordEmail = () => import('~/pages/auth/password/email').then(m => m.default || m)
const PasswordReset = () => import('~/pages/auth/password/reset').then(m => m.default || m)
const NotFound = () => import('~/pages/errors/404').then(m => m.default || m)

// Static Page Routes
const ContactUs = () => import('~/pages/static/contact').then(m => m.default || m)
const PrivacyPolicy = () => import('~/pages/static/privacy').then(m => m.default || m)
const TermsAndConditions = () => import('~/pages/static/terms').then(m => m.default || m)
const HowItWorks = () => import('~/pages/static/how-it-works').then(m => m.default || m)

// Resources Routes
const Resources = () => import('~/pages/resources/index').then(m => m.default || m)

// Base route definitions
const baseRoutes = [
  { path: '/', name: 'homepage', component: Homepage },

  // Auth Pages
  { path: '/login', name: 'login', component: Login },
  { path: '/register', name: 'register', component: Register },
  { path: '/password/reset', name: 'password.request', component: PasswordEmail },
  { path: '/password/reset/:token', name: 'password.reset', component: PasswordReset },

  // Static Pages
  { path: '/contact', name: 'contact', component: ContactUs },
  { path: '/terms-and-conditions', name: 'terms', component: TermsAndConditions },
  { path: '/privacy-policy', name: 'privacy', component: PrivacyPolicy },
  { path: '/how-it-works', name: 'how-it-works', component: HowItWorks },

  // Resources Index
  { path: '/resources', name: 'resources.index', component: Resources },

  // 404 Page
  { path: '*', component: NotFound, name: '404' },
]

// Create complete routes array
const appRoutes = [
  ...baseRoutes, 
  ...bountyRoutes,
  ...organizationRoutes,
  ...campaignRoutes,
  ...memberRoutes
]

export default appRoutes