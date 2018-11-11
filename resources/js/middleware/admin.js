import store from '~/store'

export default (to, from, next) => {
  if (store.getters['auth/user'].role !== 'admin') {
	window.helpers.snackbar('You do not have the proper permissions to view this page!', 'error')
    next({ name: 'home' })
  } else {
    next()
  }
}
