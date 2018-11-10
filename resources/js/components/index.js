import Vue from 'vue'
import Panel from './elements/Panel'
import Child from './elements/Child'
import Button from './elements/Button'
import Checkbox from './elements/Checkbox'
import { HasError, AlertError, AlertSuccess } from 'vform'

// Bakd Components
import BakdSiteStats from './layout/BakdSiteStats'
import BakdSectionTitle from '~/components/common/BakdSectionTitle'

// Sitewide Components
import BakdPageHeader from '~/components/layout/BakdPageHeader'
import BakdDevelopmentNotice from '~/components/common/BakdDevelopmentNotice'
import BackToTop from '~/components/elements/BackToTop'

// Vue.component('BakdDevelopmentNotice', BakdDevelopmentNotice)
// Vue.component('BackToTop', BackToTop)

// Components that are registered globaly.
[
  Panel,
  Child,
  Button,
  Checkbox,
  HasError,
  BackToTop,
  AlertError,
  AlertSuccess,
  BakdSiteStats,
  BakdPageHeader,
  BakdSectionTitle,
  BakdDevelopmentNotice,
].forEach(Component => {
  Vue.component(Component.name, Component)
})
