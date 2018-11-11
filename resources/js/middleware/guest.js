import store from '~/store'

export default (to, from, next) => {
  if (store.getters['auth/check']) {
	window.helpers.snackbar('You are already logged in!', 'error')
    next({ name: 'homepage' })
  } else {
    next()
  }
}
