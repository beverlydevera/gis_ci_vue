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
        },
        newStock: {}
    },
    methods: {
        getBranches(){
            var datas = { status: 1 }
            var urls = window.App.baseUrl + "Libraries/getBranches";
            axios.post(urls, datas)
                .then(function (e) {
                    inventory.branchlist=e.data.data.brancheslist;
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        getInventoryList(){
            var datas = {
                condition: "",
                groupby: "item_no"
            };
            var urls = window.App.baseUrl + "Inventory/getInventoryList";
            showloading("Loading Data");
            axios.post(urls, datas)
                .then(function (e) {
                    Swal.close();
                    inventory.inventorylist=e.data.data.inventorylist;
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        saveNewInventoryItem(){
            var datas = this.newInventoryItem;
            var urls = window.App.baseUrl + "Inventory/saveNewInventoryItem";
            axios.post(urls, datas)
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
            var datas = {
                "s.inventory_id": inventory_id
            };
            var urls = window.App.baseUrl + "Inventory/getItemStockInfo";
            axios.post(urls, datas)
                .then(function (e) {
                    inventory.inventoryItemInfo.itemStockInfo=e.data.data.itemstockinfo;
                    inventory.inventoryItemInfo.itemInfo=e.data.data.iteminfo;
                })
                .catch(function (error) {
                    console.log(error)
                });
        },
        saveNewStock(){
            var datas = {
                inventory_id: this.inventoryItemInfo.itemInfo.inventory_id,
                newStockInfo: this.newStock
            };
            var urls = window.App.baseUrl + "Inventory/saveNewStockInfo";
            axios.post(urls, datas)
                .then(function (e) {
                    Toast.fire({
                        type: e.data.type,
                        title: e.data.message
                    })
                    $('#addNewStockModal').modal('hide');
                    inventory.getInventoryList();
                    inventory.newStock = {};
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