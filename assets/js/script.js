function showloading(message = '') {
	var message = (message.length > 0) ? message : "Submitting Data . . .";
	Swal.fire({
		text: message,
		showCloseButton: false,
		showCancelButton: false,
		showConfirmButton: false,
		allowOutsideClick: false,
		imageUrl: window.App.baseUrl + 'assets/img/loader.gif'
	});
}


function showAlert(message, type) {
	// type = ['', 'info', 'danger', 'success', 'warning', 'rose', 'primary'];
	$.notify({
		icon: "add_alert",
		message: message
	}, {
		type: type,
		timer: 2000,
		placement: {
			from: "top",
			align: "right"
		}
	});
}



function refreshpicker(timer = 1000) {
	setTimeout(function () {
		$('.selectpicker').selectpicker('refresh');
		$('.lods').removeClass('fa-spin');

	}, timer);
}

function frmdata(obj) {
	var formData = new FormData();
	var fd = new FormData();
	for (var key in obj) {
		formData.append(key, obj[key]);
	}
	return formData;
}

if ($('#navigationpanel').length) {
	var nav = new Vue({
		el: '#navigationpanel',
		data: {
			activenav: "",
			// activenav:$('#activenav').val(),
		},
		methods: {
			checkactive: function (page = '') {
				var path = window.location.pathname;
				var path = path.split("/", 3).slice(-1)[0];
				this.activenav = path;
				// console.log(path);
				return this.activenav == page ? "active" : '';
			}
		}
	});
}


