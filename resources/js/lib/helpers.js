import Vue from 'vue'

export default {
	_vm : new Vue,

	snackbar: function (message, status) {
		if (typeof status !== 'undefined') {
			switch (status) {
				case 'error':
				case 'failure':
					status = 'is-danger'
					break
				case 'success':
				default:
					status = 'is-success'
					return
			}
		}

		this._vm.$snackbar.open({
	        duration: 5000,
	        queue: false,
	        message: message || 'Please check the form and try again.',
	        position: 'is-bottom-right',
	        type: status
	    })
	}
}
