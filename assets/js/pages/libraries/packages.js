// Vue.use(VueTables.ClientTable);
var students = new Vue({
    el: '#packages_page',
    data: {
        newPackage: {
            packagetype: "Select Package Type",
        }
    },
    methods: {
        changePackageType(){
            if(this.newPackage.packagetype=="Regular"){
                $('#regular_package').css({'display': '',});
                $('#unlimited_package').css({'display': 'none',});
                $('#summerpromo_package').css({'display': 'none',});
                $('#pricerate').prop('readonly', false);
            }
            else if(this.newPackage.packagetype=="Unlimited"){
                $('#regular_package').css({'display': 'none',});
                $('#unlimited_package').css({'display': '',});
                $('#summerpromo_package').css({'display': 'none',});
                $('#pricerate').prop('readonly', false);
            }
            else if(this.newPackage.packagetype=="Summer Promo"){
                $('#regular_package').css({'display': 'none',});
                $('#unlimited_package').css({'display': 'none',});
                $('#summerpromo_package').css({'display': '',});
                $('#pricerate').prop('readonly', true);
            }
        },
    }, mounted: function () {
        
    },
})