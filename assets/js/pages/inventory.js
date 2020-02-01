// Vue.use(VueTables.ClientTable);
var inventory = new Vue({
    el: '#inventory_page',
    data: {
        inventorylist: [],
        branchlist: [],
        newInventoryItem: {
            inventory: {},
            stocks: {}
        },
        inventoryItemInfo: {
            itemStockInfo: [],
            itemInfo: {}
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
        getInventoryList(){
            $datas = {
                condition: "",
                groupby: "item_no"
            };
            var urls = window.App.baseUrl + "Inventory/getInventoryList";
            axios.post(urls, $datas)
                .then(function (e) {
                    inventory.inventorylist=e.data.data.inventorylist;
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
                    inventory.getInventoryList();
                    inventory.newInventoryItem = {
                        inventory: {},
                        stocks: {}
                    };
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        viewItemStockInfoModal(inventory_id){
            $datas = {
                "s.inventory_id": inventory_id
            };
            var urls = window.App.baseUrl + "Inventory/getItemStockInfo";
            axios.post(urls, $datas)
                .then(function (e) {
                    inventory.inventoryItemInfo.itemStockInfo=e.data.data.itemstockinfo;
                    inventory.inventoryItemInfo.itemInfo=e.data.data.iteminfo;
                })
                .catch(function (error) {
                    console.log(error)
                });
        }
    }, mounted: function () {
        this.getBranches();
        this.getInventoryList();
    },
})