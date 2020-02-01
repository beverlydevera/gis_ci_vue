<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Inventory</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="input-group mb-3">
                                <div class="input-group-prepend smallerinput">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <input type="text" class="form-control smallerinput" placeholder="Search Inventory">
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-3">
                                <a style="float:right;" data-target="#addNewInventoryItemModal" data-toggle="modal" class="btn bg-gradient-primary btn-xs">Add New Inventory Item</a>
                            </div>
                        </div>
                        <table class="table table-bordered table-responsive-sm table-sm">
                            <thead>                  
                                <tr>
                                    <th>#</th>
                                    <th>Item No.</th>
                                    <th>Item Name</th>
                                    <th>Description</th>
                                    <th>Remaining Stocks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="(list,index) in inventorylist">
                                <tr>
                                    <td>{{index+1}}</td>
                                    <td>{{list.item_no}}</td>
                                    <td>{{list.item_name}}</td>
                                    <td>{{list.item_desc}}</td>
                                    <td>
                                        <span v-if="list.totalstocks>0" class="badge bg-success">{{list.totalstocks}}</span>
                                        <span v-else class="badge bg-danger">OUT OF STOCK</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-xs"><i class="fas fa-eye"></i></button>
                                        <button type="button" class="btn btn-success btn-xs"><i class="fas fa-plus"></i></button>
                                    </td>
                                </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="addNewInventoryItemModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                    <table class="table table-bordered table-responsive-sm table-sm billing-table">
                        <tr>
                            <th width="20%">Date:</th>
                            <th>January 30, 2020</th>
                        </tr>
                        <tr>
                            <th width="20%">Item Name:</th>
                            <th><input type="text" class="form-control smallerinput" required v-model="newInventoryItem.inventory.item_name"></th>
                        </tr>
                        <tr>
                            <th width="20%">Description:</th>
                            <th><input type="text" class="form-control smallerinput" required v-model="newInventoryItem.inventory.item_desc"></th>
                        </tr>
                        <tr>
                            <th width="20%">Unit Price:</th>
                            <th><input type="text" class="form-control smallerinput" required v-model="newInventoryItem.stocks.item_unitprice"></th>
                        </tr>
                        <tr>
                            <th width="20%">Quantity:</th>
                            <th><input type="number" class="form-control smallerinput" required v-model="newInventoryItem.stocks.stocks"></th>
                        </tr>
                        <tr>
                            <th width="20%">Branch:</th>
                            <th>
                                <select class="form-control smallerinput" v-model="newInventoryItem.stocks.branch_id">
                                    <option disabled selected>Select Branch</option>
                                    <template v-for="(ll,ii) in branchlist">
                                        <option :value="ll.branch_id">{{ll.branch_name}}</option>
                                    </template>
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th width="20%">Supplier:</th>
                            <th><input type="text" class="form-control smallerinput" v-model="newInventoryItem.stocks.supplier"></th>
                        </tr>
                        <tr>
                            <th width="20%">Remarks:</th>
                            <th><textarea class="form-control" rows=2 v-model="newInventoryItem.inventory.remarks"></textarea></th>
                        </tr>
                    </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" @click="saveNewInventoryItem()">Save Item</button>
            </div>
        </div>
    </div>
</div>