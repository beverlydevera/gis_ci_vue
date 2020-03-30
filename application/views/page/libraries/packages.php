<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Packages</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <select class="form-control smallerinput" v-model="searchFilter.packagetype" @change="searchTable('filter')">
                                    <option value="0" disabled selected>Select Package Type</option>
                                    <option>Regular</option>
                                    <option>Unlimited</option>
                                    <option>Summer Promo</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select class="form-control smallerinput" v-model="searchFilter.year" @change="searchTable('filter')">
                                    <option value="0" disabled selected>Select Year</option>
                                    <option>2020</option>
                                    <option>2019</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-primary btn-xs" @click="searchTable('clearfilter')">Clear Filter</button>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addNewPackageModal" style="float:right;">Add a New Package</button>
                            </div>
                        </div>
                        <br>
                        <table class="table table-bordered table-responsive-sm table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Package Type</th>
                                    <th>Details</th>
                                    <th>Price Rate</th>
                                    <th>Year</th>
                                    <th>Remarks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody v-if="packagelist.length>0">
                                <tr v-for="(list,index) in packagelist">
                                    <td>{{index+1}}</td>
                                    <template v-if="list.packagetype=='Regular'">
                                        <td><span class="badge bg-success">{{list.packagetype}}</span></td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-8" style="border-right:1px solid #000;">{{list.packagedetails.class}}</div>
                                                <div class="col-md-4">{{list.packagedetails.sessions}} Session/s</div>
                                            </div>
                                        </td>
                                    </template>
                                    <template v-else-if="list.packagetype=='Unlimited'">
                                        <td><span class="badge bg-info">{{list.packagetype}}</span></td>
                                        <td>{{list.packagedetails}}</td>
                                    </template>
                                    <template v-else-if="list.packagetype=='Summer Promo'">
                                        <td><span class="badge bg-warning">{{list.packagetype}}</span></td>
                                        <td>
                                            <button v-bind:id="'showDetailsbtn-'+list.package_id" :disabled="disabled_showbtn" class="btn btn-warning btn-xs" @click="showDetails(list.package_id)">Show Details</button>
                                            <button v-bind:id="'hideDetailsbtn-'+list.package_id" :disabled="disabled_hidebtn" style="display:none;" class="btn btn-warning btn-xs" @click="hideDetails(list.package_id)">Hide Details</button>
                                            <template v-if="packagedetails.package_data.length>0">
                                                <table class="table table-bordered table-responsive-sm table-sm" v-if="list.package_id==packagedetails.package_id">
                                                    <tr>
                                                        <th>PARTICULAR</th>
                                                        <th>PRICE</th>
                                                    </tr>
                                                <template id="summerpromodetails" v-for="(ll,ii) in packagedetails.package_data" style="display:none;">
                                                    <tr>
                                                        <td>{{ll.particular}}</td>
                                                        <td>{{ll.price}}</td>
                                                    </tr>
                                                </template>
                                                </table>
                                            </template>
                                        </td>
                                    </template>
                                    <td>{{list.pricerate}}</td>
                                    <td>{{list.year}}</td>
                                    <td>{{list.remarks}}</td>
                                    <td><button type="button" class="btn btn-primary btn-xs" @click="editPackageModal(list.package_id)"><i class="fas fa-edit"></i></button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="addNewPackageModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Package</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                    <table class="table table-bordered table-responsive-sm table-sm billing-table">
                        <tr>
                            <th width="25%">Package Type:</th>
                            <th>
                                <select class="form-control smallerinput" @change="changePackageType_addModal()" v-model="newPackage.packagetype" required>
                                    <option disabled selected>Select Package Type</option>
                                    <option>Regular</option>
                                    <option>Unlimited</option>
                                    <option>Summer Promo</option>
                                </select>
                            </th>
                        </tr>
                        <tr id="add_regular_package" style="display:none;">
                            <th width="25%">Package Details:</th>
                            <th>
                                <div class="row">
                                    <div class="col-md-12">
                                        <select class="form-control smallerinput" v-model="newPackage.packagedetails.class">
                                            <option disabled selected>Select Class</option>
                                            <template v-for="(list,index) in classeslist">
                                                <option :value="list.class_id">{{list.class_title}}</option>
                                            </template>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 smallerinput" style="padding-top:2%;">
                                        No. of Sessions:
                                    </div>
                                    <div class="col-md-8" style="padding-top:1%;">
                                        <input type="text" class="form-control smallerinput" placeholder="Input Number of Sessions"  v-model="newPackage.packagedetails.sessions">
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr id="add_unlimited_package" style="display:none;">
                            <th width="25%">Package Details:</th>
                            <th><input type="text" class="form-control smallerinput" v-model="newPackage.packagedetails"></th>
                        </tr>
                        <tr id="add_summerpromo_package" style="display:none;">
                            <th width="25%">Package Details:</th>
                            <th>
                                <div class="row" v-for="(list,index) in newPackage.packagedetails">
                                    <div class="col-md-8">
                                        <input v-if="list.type=='input'" type="text" class="form-control smallerinput" v-model="list.particular" placeholder="Particular">
                                        <select v-if="list.type=='inventory'" class="form-control smallerinput" v-model="list.particular" @change="getItemDetails('add',index)">
                                                <option disabled selected>Select From Inventory</option>
                                            <template v-for="(inv,invindex) in inventorylist">
                                                <option :value="inv.stock_id" v-if="inv.remaining_stocks>1">{{inv.item_name}} | ₱{{inv.item_unitprice}} | stocks: {{inv.totalremainingstocks}}</option>
                                                <option v-else-if="inv.stocks<1" disabled>{{inv.item_name}} | ₱{{inv.item_unitprice}} | stocks: {{inv.totalremainingstocks}}</option>
                                            </template>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <input v-if="list.type=='input'" type="text" class="form-control smallerinput" v-model="list.price" @blur="addPriceRate('add')" placeholder="Price">
                                        <input v-if="list.type=='inventory'" type="number" readonly class="form-control smallerinput" v-model="list.price">
                                    </div>
                                    <div class="col-md-1" style="padding:0;">
                                        <button v-if="index==0 && list.type=='input'" type="button" class="btn btn-primary btn-xs" @click="addnewParticular_item('add','input')"><i class="fas fa-plus"></i></button>
                                        <button v-if="index==1 && list.type=='inventory'" type="button" class="btn btn-primary btn-xs" @click="addnewParticular_item('add','inventory')"><i class="fas fa-plus"></i></button>
                                        <button v-if="index>1" type="button" class="btn btn-danger btn-xs" @click="cancelParticular_item('add',index)"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th width="25%">Price Rate:</th>
                            <th><input type="number" id="add_pricerate" v-model="newPackage.pricerate" class="form-control smallerinput" required></th>
                        </tr>
                        <tr>
                            <th width="25%">Year:</th>
                            <th><input type="text" class="form-control smallerinput" v-model="newPackage.year" required></th>
                        </tr>
                        <tr>
                            <th width="25%">Remarks:</th>
                            <th><input type="text" class="form-control smallerinput" v-model="newPackage.remarks"></th>
                        </tr>
                    </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" @click="saveNewPackage()">Save Package</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editPackageModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Package</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                    <table class="table table-bordered table-responsive-sm table-sm billing-table">
                        <tr>
                            <th width="25%">Package Type:</th>
                            <th>
                                <input type="text" class="form-control smallerinput"v-model="packageinfo.packagetype" required readonly>
                            </th>
                        </tr>
                        <tr id="edit_regular_package" style="display:none;">
                            <th width="25%">Package Details:</th>
                            <th>
                                <div class="row">
                                    <div class="col-md-12">
                                        <select class="form-control smallerinput" v-model="packageinfo.packagedetails.class">
                                            <option disabled selected>Select Class</option>
                                            <template v-for="(list,index) in classeslist">
                                                <option :value="list.class_id">{{list.class_title}}</option>
                                            </template>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 smallerinput" style="padding-top:2%;">
                                        No. of Sessions:
                                    </div>
                                    <div class="col-md-8" style="padding-top:1%;">
                                        <input type="text" class="form-control smallerinput" placeholder="Input Number of Sessions"  v-model="packageinfo.packagedetails.sessions">
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr id="edit_unlimited_package" style="display:none;">
                            <th width="25%">Package Details:</th>
                            <th><input type="text" class="form-control smallerinput" v-model="packageinfo.packagedetails"></th>
                        </tr>
                        <tr id="edit_summerpromo_package" style="display:none;">
                            <th width="25%">Package Details:</th>
                            <th>
                                <div class="row" v-for="(list,index) in packageinfo.packagedetails">
                                    <div class="col-md-7">
                                        <input v-if="list.type=='input'" type="text" class="form-control smallerinput" v-model="list.particular" placeholder="Particular">
                                        <select v-if="list.type=='inventory'" class="form-control smallerinput" v-model="list.particular" @change="getItemDetails('edit',index)">
                                                <option disabled selected>Select From Inventory</option>
                                            <template v-for="(inv,invindex) in inventorylist">
                                                <option :value="inv.stock_id" v-if="inv.remaining_stocks>1">{{inv.item_name}} | ₱{{inv.item_unitprice}} | stocks: {{inv.totalremainingstocks}}</option>
                                                <option v-else-if="inv.stocks<1" disabled>{{inv.item_name}} | ₱{{inv.item_unitprice}} | stocks: {{inv.totalremainingstocks}}</option>
                                            </template>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input v-if="list.type=='input'" type="text" class="form-control smallerinput" v-model="list.price" @blur="addPriceRate('edit')" placeholder="Price">
                                        <input v-if="list.type=='inventory'" type="number" readonly class="form-control smallerinput" v-model="list.price">
                                    </div>
                                    <div class="col-md-1" style="padding:0;">
                                        <button v-if="index==0 && list.type=='input'" type="button" class="btn btn-primary btn-xs" @click="addnewParticular_item('edit','input')"><i class="fas fa-plus"></i></button>
                                        <button v-if="index==1 && list.type=='inventory'" type="button" class="btn btn-primary btn-xs" @click="addnewParticular_item('edit','inventory')"><i class="fas fa-plus"></i></button>
                                        <button v-if="index>1" type="button" class="btn btn-danger btn-xs" @click="cancelParticular_item('edit',index)"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th width="25%">Price Rate:</th>
                            <th><input type="number" id="edit_pricerate" v-model="packageinfo.pricerate" class="form-control smallerinput" required></th>
                        </tr>
                        <tr>
                            <th width="25%">Year:</th>
                            <th><input type="text" class="form-control smallerinput" v-model="packageinfo.year" required readonly></th>
                        </tr>
                        <tr>
                            <th width="25%">Remarks:</th>
                            <th><input type="text" class="form-control smallerinput" v-model="packageinfo.remarks"></th>
                        </tr>
                    </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" @click="savePackageChanges()">Save Changes</button>
            </div>
        </div>
    </div>
</div>