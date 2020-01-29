// Vue.use(VueTables.ClientTable);
var package = new Vue({
    el: '#packages_page',
    data: {
        newPackage: {
            packagetype: "Select Package Type",
            packagedetails: {
                schedule: "",
                sessions: "",
                particular: "",
                price: "",
            },
            pricerate: 0,
        },
        packagelist: [],
        packagedetails: {
            package_id: "",
            package_data: []
        },
        packageinfo: {
            packagetype: "Select Package Type",
            packagedetails: {
                schedule: "",
                sessions: "",
                particular: "",
                price: "",
            },
            pricerate: 0,
        },
        disabled_showbtn: false,
        disabled_hidebtn: true,
    },
    methods: {
        changePackageType_addModal(){
            if(this.newPackage.packagetype=="Regular"){
                this.newPackage.packagedetails = {
                    schedule: "Select Schedule",
                    sessions: ""
                };
                $('#add_regular_package').css({'display': '',});
                $('#add_unlimited_package').css({'display': 'none',});
                $('#add_summerpromo_package').css({'display': 'none',});
                $('#add_pricerate').prop('readonly', false);
            }else if(this.newPackage.packagetype=="Unlimited"){
                this.newPackage.packagedetails = "";
                $('#add_regular_package').css({'display': 'none',});
                $('#add_unlimited_package').css({'display': '',});
                $('#add_summerpromo_package').css({'display': 'none',});
                $('#add_pricerate').prop('readonly', false);
            }else if(this.newPackage.packagetype=="Summer Promo"){
                this.newPackage.packagedetails = [{
                    particular: "",
                    price: ""
                }];
                $('#add_regular_package').css({'display': 'none',});
                $('#add_unlimited_package').css({'display': 'none',});
                $('#add_summerpromo_package').css({'display': '',});
                $('#add_pricerate').prop('readonly', true);
            }
        },
        addnewParticular_item(action){
            if(action=="add"){
                if(this.newPackage.packagedetails!=null){
                    var packagedetail = {
                        particular: null,
                        price: null,
                    };
                    this.newPackage.packagedetails.push(packagedetail);
                }else{
                    this.newPackage.packagedetails = [{
                        particular: null,
                        price: null,
                    }];
                }
            }else if(action=="edit"){
                if(this.packageinfo.packagedetails!=null){
                    var packagedetail = {
                        particular: null,
                        price: null,
                    };
                    this.packageinfo.packagedetails.push(packagedetail);
                }else{
                    this.packageinfo.packagedetails = [{
                        particular: null,
                        price: null,
                    }];
                }
            }
        },
        cancelParticular_item(action,index){
            if(action=="add"){
                this.newPackage.packagedetails.splice(index, 1);
                package.newPackage.pricerate = 0;
                this.newPackage.packagedetails.forEach(e => {
                    package.newPackage.pricerate += parseInt(e.price);
                });
            }else if(action=="edit"){
                this.packageinfo.packagedetails.splice(index, 1);
                package.packageinfo.pricerate = 0;
                this.packageinfo.packagedetails.forEach(e => {
                    package.packageinfo.pricerate += parseInt(e.price);
                });
            }
        },
        addPriceRate(action){
            if(action=="add"){
                package.newPackage.pricerate = 0;
                this.newPackage.packagedetails.forEach(e => {
                    package.newPackage.pricerate += parseInt(e.price);
                });
            }else if(action=="edit"){
                package.packageinfo.pricerate = 0;
                this.packageinfo.packagedetails.forEach(e => {
                    package.packageinfo.pricerate += parseInt(e.price);
                });
            }
        },
        getPackageList(){
            var urls = window.App.baseUrl + "Libraries/getPackageList";
            axios.post(urls, "")
                .then(function (e) {
                    e.data.data.packagelist.forEach(e => {
                        package.packagelist.push({
                            package_id: e.package_id,
                            packagetype: e.packagetype,
                            packagedetails: JSON.parse(e.packagedetails),
                            pricerate: e.pricerate,
                            year: e.year,
                            remarks: e.remarks,
                        })
                    });
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        saveNewPackage(){
            var urls = window.App.baseUrl + "Libraries/saveNewPackage";
            axios.post(urls, this.newPackage)
                .then(function (e) {
                    Toast.fire({
                        type: e.data.type,
                        title: e.data.message
                    })
                    $('#addNewPackageModal').modal('hide');
                    package.packagelist = [];
                    package.getPackageList();
                    package.newPackage = {
                        packagetype: "Select Package Type",
                        packagedetails: {
                            schedule: "",
                            sessions: "",
                            particular: "",
                            price: "",
                        },
                        pricerate: 0,
                    };
                    $('#add_regular_package').css({'display': 'none',});
                    $('#add_unlimited_package').css({'display': 'none',});
                    $('#add_summerpromo_package').css({'display': 'none',});
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        showDetails(package_id){
            var datas = {package_id:package_id}
            var urls = window.App.baseUrl + "Libraries/getPackageList";
            axios.post(urls, datas)
                .then(function (e) {
                    package.packagedetails.package_data = JSON.parse(e.data.data.packagelist.packagedetails);
                    package.packagedetails.package_id = package_id;
                    $('#summerpromodetails-'+package_id).css({'display': '',});
                    $('#showDetailsbtn-'+package_id).css({'display': 'none',});
                    $('#hideDetailsbtn-'+package_id).css({'display': '',});
                    package.disabled_showbtn = true;
                    package.disabled_hidebtn = false;
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        hideDetails(package_id){
            package.packagedetails = {
                package_id: "",
                package_data: []
            };
            $('#summerpromodetails-'+package_id).css({'display': 'none',});
            $('#showDetailsbtn-'+package_id).css({'display': '',});
            $('#hideDetailsbtn-'+package_id).css({'display': 'none',});
            package.disabled_showbtn = false;
            package.disabled_hidebtn = true;
        },
        editPackageModal(package_id){
            var datas = {package_id:package_id}
            var urls = window.App.baseUrl + "Libraries/getPackageList";
            axios.post(urls, datas)
                .then(function (e) {
                    package.packageinfo = e.data.data.packagelist;
                    package.packageinfo.packagedetails = JSON.parse(e.data.data.packagelist.packagedetails);
                    if(package.packageinfo.packagetype=="Regular"){
                        $('#edit_regular_package').css({'display': '',});
                        $('#edit_unlimited_package').css({'display': 'none',});
                        $('#edit_summerpromo_package').css({'display': 'none',});
                        $('#edit_pricerate').prop('readonly', false);
                    }else if(package.packageinfo.packagetype=="Unlimited"){
                        $('#edit_regular_package').css({'display': 'none',});
                        $('#edit_unlimited_package').css({'display': '',});
                        $('#edit_summerpromo_package').css({'display': 'none',});
                        $('#edit_pricerate').prop('readonly', false);
                    }else if(package.packageinfo.packagetype=="Summer Promo"){
                        $('#edit_regular_package').css({'display': 'none',});
                        $('#edit_unlimited_package').css({'display': 'none',});
                        $('#edit_summerpromo_package').css({'display': '',});
                        $('#edit_pricerate').prop('readonly', true);
                    }
                    $('#editPackageModal').modal('show');
                })
                .catch(function (error) {
                    console.log(error)
                }); 
        },
        savePackageChanges(){
            var urls = window.App.baseUrl + "Libraries/savePackageChanges";
            axios.post(urls, this.packageinfo)
                .then(function (e) {
                    Toast.fire({
                        type: e.data.type,
                        title: e.data.message
                    })
                    $('#editPackageModal').modal('hide');
                    package.packagelist = [];
                    package.getPackageList();
                    package.packageinfo = {
                        packagetype: "Select Package Type",
                        packagedetails: {
                            schedule: "",
                            sessions: "",
                            particular: "",
                            price: "",
                        },
                        pricerate: 0,
                    };
                    $('#edit_regular_package').css({'display': 'none',});
                    $('#edit_unlimited_package').css({'display': 'none',});
                    $('#edit_summerpromo_package').css({'display': 'none',});
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
    }, mounted: function () {
        this.getPackageList();
    },
})