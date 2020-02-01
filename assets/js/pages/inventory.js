// Vue.use(VueTables.ClientTable);
var inventory = new Vue({
    el: '#inventory_page',
    data: {
        inventorylist: [],
        branchlist: [],
        newInventoryItem: {
            inventory: {},
            stocks: {}
        }
    },
    methods: {
        getBranches(){
            $datas = { status: 1 }
            var urls = window.App.baseUrl + "Libraries/getBranches";
            axios.post(urls, $datas)
                .then(function (e) {
                    inventory.branchlist=e.data.data.brancheslist;
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        saveNewInventoryItem(){
            $datas = this.newInventoryItem;
            var urls = window.App.baseUrl + "Inventory/saveNewInventoryItem";
            axios.post(urls, $datas)
                .then(function (e) {
                    Toast.fire({
                        type: e.data.type,
                        title: e.data.message
                    })
                    $('#addNewInventoryItemModal').modal('hide');
                })
                .catch(function (error) {
                    console.log(error)
                });
        }
    }, mounted: function () {
        this.getBranches();
    },
})