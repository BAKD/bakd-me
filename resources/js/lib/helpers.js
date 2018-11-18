import Vue from 'vue'

export default {
	_vm : new Vue,

	snackbar: function (message, status) {
		if (typeof status === 'undefined') status = 'is-success'
		if (status === 'error') status = 'is-error'

		this._vm.$snackbar.open({
	        duration: 5000,
	        queue: false,
	        message: message || 'Please check the form and try again.',
	        position: 'is-bottom-right',
	        type: status
	    })
	},

	toast: function (...options) {
		return swal({
		  toast: true,
		  position: options[0].hasOwnProperty('position') ? options[0].position : 'bottom-end',
		  showConfirmButton: false,
		  timer: options[0].hasOwnProperty('timer') ? options[0].timer : 5000,
		  title: options[0].title,  
		  type: options[0].type
		});
	},

	confirm: function (options) {
		let alertConfig = {
			text: options.text,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: options.confirmText || 'Yes',
			cancelButtonText: options.cancelText || 'No',
			confirmButtonClass: 'button is-danger is-medium is-pulled-right',
			cancelButtonClass: 'button is-secondary is-medium is-pulled-right',
			showCancelButton: true,
			buttonsStyling: false,
			reverseButtons: true,
			showCloseButton: true
		}
		
		if (options.hasOwnProperty('title')) {
			alertConfig.title = options.title
		}
		
		if (options.hasOwnProperty('type')) {
			alertConfig.type = options.type
		}

		swal(alertConfig).then(function(data) {
			if (data && data.value === true) {
				typeof options.success === 'function' && options.success(data, 'confirmed')
			} else if (data && data.dismiss) {
				typeof options.success === 'function' && options.success(data, 'dismissed')
			}
		}).catch(function(err) {
			typeof options.failed === 'function' && options.failed(err, 'exception')
		});
	},

	alert: function (...options) {
		return swal({
		  toast: false,
		  position: options[0].hasOwnProperty('position') ? options[0].position : 'center',
		  showConfirmButton: options[0].hasOwnProperty('showConfirmButton') ? options[0].showConfirmButton : false,
		  timer: options[0].hasOwnProperty('timer') ? options[0].timer : 5000,
		  title: options[0].title,  
		  type: options[0].type
		});
	}
}