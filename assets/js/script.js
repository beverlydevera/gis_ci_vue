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

function computeTimeInterval(date_added) {
	var d = new Date(date_added);
	var d_year = d.getFullYear();
	var d_month = '' + (d.getMonth() + 1);
	var d_day = '' + d.getDate();
	var d_hr = d.getHours();
	var d_min = d.getMinutes();
	var d_sec = d.getSeconds();

	var n = new Date();
	var n_year = n.getFullYear();
	var n_month = '' + (n.getMonth() + 1);
	var n_day = '' + n.getDate();
	var n_hr = n.getHours();
	var n_min = n.getMinutes();
	var n_sec = n.getSeconds();

	if(n_year-d_year > 0){
		var time = n_year-d_year > 1 ? " years ago" : " year ago";
		return n_year-d_year + time;
	}else if(n_month-d_month > 0){
		var time = n_month-d_month > 1 ? " months ago" : " month ago";
		return n_month-d_month + time;
	}else if(n_day-d_day > 0){
		var time = n_day-d_day > 1 ? " days ago" : " day ago";
		return n_day-d_day + time;
	}else if(n_hr-d_hr > 0){
		var time = n_hr-d_hr > 1 ? " hrs ago" : " hr ago";
		return n_hr-d_hr + time;
	}else if(n_min-d_min > 0){
		var time = n_min-d_min > 1 ? " mins ago" : " min ago";
		return n_min-d_min + time;
	}else if(n_sec-d_sec > 0){
		var time = n_sec-d_sec > 1 ? " secs ago" : " sec ago";
		return n_sec-d_sec + time;
	}
};

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
			chatlist: [],
			preregisteredlist: []
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
			getProfileData(){
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
						$('#editProfileImage1')
							.attr('src', e.target.result);
						$('#editProfileImage2')
							.attr('src', e.target.result);
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
					})
	
				})
				.catch(function (error) {
					console.log(error);
				});
			},
			getNewRegistrations(){
				var urls = window.App.baseUrl + "Notifications/getNewRegistrations";
				axios.post(urls, "")
					.then(function (e) {

						if(e.data.data!=""){
							if(systemconfigs.preregisteredlist.length==0){
								systemconfigs.preregisteredlist = e.data.data.preregisteredlist;
								systemconfigs.preregisteredlist.forEach((el,index) => {
									systemconfigs.preregisteredlist[index].timeinterval = computeTimeInterval(el.date_added);
								});
							}else{
								e.data.data.preregisteredlist.forEach((el,index) => {
									e.data.data.preregisteredlist[index].timeinterval = computeTimeInterval(el.date_added);
		
									if(systemconfigs.preregisteredlist!=null){
										if(systemconfigs.preregisteredlist.length!=e.data.data.preregisteredlist.length){	

											systemconfigs.preregisteredlist.filter(elem => {
												if(elem.walkin_id == el.walkin_id){
													e.data.data.preregisteredlist.splice(index, 1);
												}
											});

											var audio = new Audio(window.App.baseUrl + "assets/audio/insight.mp3");
											audio.play();
											toastr.success('New Pre-Pregistration in Website (Name: '+el.lastname+', '+el.firstname+')');
											systemconfigs.preregisteredlist.unshift(el);
										}
									}
								});
							}
						}
					})
					.catch(function (error) {
						console.log(error)
					});
			},
			setStatusRead(index,action){
					var notification_id = this.preregisteredlist[index].notification_id;
					var datas = { notification_id: notification_id };
					var urls = window.App.baseUrl + "Notifications/changeWalkinNotifStatus";
					axios.post(urls, datas)
						.then(function (e) {
							systemconfigs.preregisteredlist.splice(index, 1);
							if(action=='view'){
								var urls = window.App.baseUrl + "Walkin";
								window.open(urls, "_self");
							}
						})
						.catch(function (error) {
							console.log(error)
						});
			}
		}, mounted: function () {
			this.getProfileData();
			this.getNewRegistrations();
		}, created() {
			this.interval = setInterval(() => this.getNewRegistrations(), 10000);
		},
	});
}