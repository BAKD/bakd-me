import store from '~/store'

export default async (to, from, next) => {
  if (!store.getters['auth/check']) {
	window.helpers.snackbar('You need to be logged in to view this page!', 'error')
    next({ name: 'login' })
  } else {
    next()
  }
}
