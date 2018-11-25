import axios from 'axios'
import store from '~/store'
import router from '~/router'
import swal from 'sweetalert2'
import i18n from '~/plugins/i18n'

// Request interceptor
axios.interceptors.request.use(request => {
  const token = store.getters['auth/token']
  if (token) {
    request.headers.common['Authorization'] = `Bearer ${token}`
  }
  
  // const csrftoken = document.head.querySelector('meta[name="csrf-token"]')

  // if (csrftoken) {
  //     request.headers.common['X-CSRF-TOKEN'] = csrftoken.content;
  // } else {
  //     console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
  // }

  const locale = store.getters['lang/locale']
  if (locale) {
    request.headers.common['Accept-Language'] = locale
  }

  request.headers['X-Socket-Id'] = router.app.$echo.socketId()

  return request
})

const NotFound = () => import('~/pages/errors/404').then(m => m.default || m)

// Response interceptor
axios.interceptors.response.use(response => response, error => {
  const { status } = error.response

  // Server error interceptor
  if (status >= 500) {
    swal({
      type: 'error',
      title: i18n.t('error_alert_title'),
      text: i18n.t('error_alert_text'),
      reverseButtons: true,
      confirmButtonText: i18n.t('ok'),
      cancelButtonText: i18n.t('cancel')
    })
  }

  // Throttle exception interceptor
  if (status === 429) {
    swal({
      type: 'error',
      title: i18n.t('error_alert_title'),
      text: 'You\'ve sent too many requests. Give it a few minutes and you\'ll be able to use the site again.',
      confirmButtonText: i18n.t('ok'),
    })
  }

  // Api 404 interceptor
  if (status === 404) {
    router.to({ component: NotFound })
  }

  // Auth check interceptor
  if (status === 401 && store.getters['auth/check']) {
    swal({
      type: 'warning',
      title: i18n.t('token_expired_alert_title'),
      text: i18n.t('token_expired_alert_text'),
      reverseButtons: true,
      confirmButtonText: i18n.t('ok'),
      cancelButtonText: i18n.t('cancel')
    }).then(() => {
      store.commit('auth/LOGOUT')

      router.push({ name: 'login' })
    })
  }

  return Promise.reject(error)
})
