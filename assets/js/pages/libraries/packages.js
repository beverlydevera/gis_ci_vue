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
    },
    methods: {
        changePackageType(){
            if(this.newPackage.packagetype=="Regular"){
                this.newPackage.packagedetails = {
                    schedule: "Select Schedule",
                    sessions: ""
                };
                $('#regular_package').css({'display': '',});
                $('#unlimited_package').css({'display': 'none',});
                $('#summerpromo_package').css({'display': 'none',});
                $('#pricerate').prop('readonly', false);
            }
            else if(this.newPackage.packagetype=="Unlimited"){
                this.newPackage.packagedetails = "";
                $('#regular_package').css({'display': 'none',});
                $('#unlimited_package').css({'display': '',});
                $('#summerpromo_package').css({'display': 'none',});
                $('#pricerate').prop('readonly', false);
            }
            else if(this.newPackage.packagetype=="Summer Promo"){
                this.newPackage.packagedetails = [{
                    particular: "",
                    price: ""
                }];
                $('#regular_package').css({'display': 'none',});
                $('#unlimited_package').css({'display': 'none',});
                $('#summerpromo_package').css({'display': '',});
                $('#pricerate').prop('readonly', true);
            }
        },
        addnewParticular_item(){
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
        },
        cancelParticular_item(index){
            this.newPackage.packagedetails.splice(index, 1);
            package.newPackage.pricerate = 0;
            this.newPackage.packagedetails.forEach(e => {
                package.newPackage.pricerate += parseInt(e.price);
            });
        },
        addPriceRate(){
            package.newPackage.pricerate = 0;
            this.newPackage.packagedetails.forEach(e => {
                package.newPackage.pricerate += parseInt(e.price);
            });
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
                    $('#regular_package').css({'display': 'none',});
                    $('#unlimited_package').css({'display': 'none',});
                    $('#summerpromo_package').css({'display': 'none',});
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
        },
    }, mounted: function () {
        this.getPackageList();
    },
})