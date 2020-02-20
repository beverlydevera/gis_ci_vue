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

if ($('#header_nav').length) {
	var systemconfigs = new Vue({
		el: '#header_nav',
		data: {
			user_id:$('#user_id').val(),
			userdata: {
				photo: null
			},
			notifications: [],
			chatlist: []
		},
		methods: {
			changePassword(){
				Swal.fire({
					title: "Password Change",
					input: 'password',
					inputPlaceholder: 'Enter new password',
					inputAttributes: {
						maxlength: 15,
						autocapitalize: 'off',
						autocorrect: 'off'
					},
					showCancelButton: true,
				}).then((result) => {
					if(result.value){
						Swal.fire({
							title: "Password Change",
							input: 'password',
							inputPlaceholder: 'Confirm password',
							inputAttributes: {
								maxlength: 15,
								autocapitalize: 'off',
								autocorrect: 'off'
							},
							showCancelButton: true,
						}).then((result1) => {
							if(result1.value){
								if (result.value==result1.value) {
									Swal.fire({
										title: "Are you sure you want to change your password?",
										text: "You will be logged out after changing your password.",
										type: 'warning',
										showCancelButton: true,
										confirmButtonColor: '#3085d6',
										cancelButtonColor: '#d33',
										confirmButtonText: 'Yes, change password and proceed',
										}).then((e) => {
											if(e.value){
												var datas = {
													user_id: this.user_id,
													password: result.value
												};
												var urls = window.App.baseUrl + "users/resetUserPassword";
												showloading();
												axios.post(urls, datas)
													.then(function (e) {
														Swal.close();
														Toast.fire({
															type: e.data.type,
															title: e.data.message
														})
														window.location.replace(window.App.baseUrl + "users/logout");
													})
													.catch(function (error) {
														console.log(error)
													});
											}
										})
								}else{
									Swal.fire({
										type: "error",
										title: "Passwords do not match"
									})
								}
							}else{
								Swal.fire({
									type: "error",
									title: "Change Password cancelled"
								})
							}
						})
					}
				})
			},
			viewProfileDetails(){
				var user_id = this.user_id;
				var datas = {
					condition: {
						"user_id": user_id,
						"u.status": 1
					},
					type: "row",
					join: {
						table: "tbl_branches b",
						key: "b.branch_id=u.branch_id",
						jointype: "left",
					}
				};
				var urls = window.App.baseUrl + "Users/getUsersList";
				showloading("Loading Data");
				axios.post(urls, datas)
					.then(function (e) {
						swal.close();
						systemconfigs.userdata=e.data.data;
						$('#editUserProfileModal').modal('show');
					})
					.catch(function (error) {
						console.log(error)
					});
			},
			editProfileImageSelect(event){
				if (event.target.files && event.target.files[0]) {
					var reader = new FileReader();
	
					reader.onload = function (e) {
						$('#editProfileImage')
							.attr('src', e.target.result)
							.width("40%");
							// .height(200);
					};
	
					reader.readAsDataURL(event.target.files[0]);
				}
			},
			saveUserProfileChanges(){
					
				let formData = new FormData();
				formData.append('user_id', this.user_id);
				formData.append('lastname', this.userdata.lastname);
				formData.append('firstname', this.userdata.firstname);
				formData.append('middlename', this.userdata.middlename);
				formData.append('contactno', this.userdata.contactno);
				formData.append('emailadd', this.userdata.emailadd);
				formData.append('file', this.$refs.userprofileimage.files[0]);
	
				var urls = window.App.baseUrl + "Users/saveUserDetails";
				showloading();
				axios.post(urls, formData, { headers: { 'Content-Type': 'multipart/form-data' } })
				.then(function (e) {
					Swal.close();
					Swal.fire({
						type: e.data.type,
						title: e.data.message
					}).then(function (e) {
						$('#editUserProfileModal').modal('hide');
						systemconfigs.userdata = {
							title: "",
							text: "",
							photo: null
						};
					})
	
				})
				.catch(function (error) {
					console.log(error);
				});
			},
		}
	});
}