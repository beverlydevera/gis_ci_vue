var currentdate = formatDate(new Date());
var currenttime = formatTime(new Date());

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
}

function formatTime(date) {
    var d = new Date(date);
    var hr = d.getHours();
    var min = d.getMinutes();
    var sec = d.getSeconds();

    if (hr < 10)
        hr = "0" + hr;
    if (min < 10)
        min = "0" + min;
    if (sec < 10)
        sec = "0" + sec;

    return [hr, min, sec].join(':');
}

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