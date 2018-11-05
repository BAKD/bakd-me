import Vue from 'vue'
import Panel from './elements/Panel'
import Child from './elements/Child'
import Button from './elements/Button'
import Checkbox from './elements/Checkbox'
import { HasError, AlertError, AlertSuccess } from 'vform'

// Components that are registered globaly.
[
  Panel,
  Child,
  Button,
  Checkbox,
  HasError,
  AlertError,
  AlertSuccess
].forEach(Component => {
  Vue.component(Component.name, Component)
})
