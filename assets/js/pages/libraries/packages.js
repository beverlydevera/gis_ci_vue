// Vue.use(VueTables.ClientTable);
var students = new Vue({
    el: '#packages_page',
    data: {
        newPackage: {
            packagetype: "Select Package Type",
            packagedetails: {
                classes: "",
                sessions: "",
                particular: "",
                price: "",
            }
        }
    },
    methods: {
        changePackageType(){
            if(this.newPackage.packagetype=="Regular"){
                this.newPackage.packagedetails = {
                    classes: "",
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
            this.newPackage.packagedetails.splice(index, 1)
        },
    }, mounted: function () {
        
    },
})