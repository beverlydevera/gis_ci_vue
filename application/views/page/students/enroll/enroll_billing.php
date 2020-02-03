<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <h5>Date: <?=date(" F d, Y")?>
            <a href="" class="btn btn-primary btn-sm" style="float:right; color:#fff;">Print Invoice</a>
        </h5>
        <hr>
        <h5>Billing Summary</h5>
        <table class="table table-bordered table-responsive-sm table-sm billing-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{otherinfo.invoiceno}}</td>
                    <td class="billing-desc">Membership Fee ({{otherinfo.invoicedetails.studmembership.year}})</td>
                    <td>500.00</td>
                </tr>
                <tr v-if="otherinfo.invoicedetails.studmembership.insurance_avail!=0">
                    <td>{{otherinfo.invoiceno+1}}</td>
                    <td class="billing-desc">Insurance Fee ({{otherinfo.invoicedetails.studmembership.year}})</td>
                    <td>1,000.00</td>
                </tr>
                <tr v-if="otherinfo.invoicedetails.studpackages!=''">
                    <th class="billing-desc" colspan="5">Packages Availed</th>
                </tr>
                <template v-for="(list,index) in otherinfo.invoicedetails.studpackages">
                    <tr>
                        <td v-if="otherinfo.invoicedetails.studmembership.insurance_avail!=0">{{otherinfo.invoiceno+index+1+1}}</td>
                        <td class="billing-desc" v-if="list.packagetype=='Regular'">
                            Package Type: <u>{{list.packagetype}}</u> <br>
                            Branch: <u>{{list.details.branch}}</u> <br>
                            Class: <u>{{list.details.class}}</u> <br>
                            Schedule: <u>{{list.details.sched_day}} / {{list.details.sched_time}}</u> <br>
                            Sessions: <u>{{list.details.sessions}}
                        </td>
                        <td class="billing-desc" v-else-if="list.packagetype=='Unlimited'">
                            Package Type: <u>{{list.packagetype}}</u> <br>
                            Details: <u>{{list.details}}</u>
                        </td>
                        <td class="billing-desc" v-else-if="list.packagetype=='Summer Promo'">
                            Package Type: <u>{{list.packagetype}}</u> <br>
                            <table class="table table-bordered table-responsive-sm table-sm">
                                <tr>
                                    <td>PARTICULAR</td>
                                    <td>PRICE</td>
                                </tr>
                            <template v-for="(ll,ii) in list.details">
                                <tr v-if="ll.type=='input'">
                                    <td>{{ll.particular}}</td>
                                    <td>{{ll.price}}</td>
                                </tr>
                            </template>
                            </table>
                        </td>
                        <td>{{list.pricerate}}</td>
                    </tr>
                </template>
                <tr>
                    <td colspan="5"></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2">Total</th>
                    <th>2,000.00</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="col-md-2"></div>
</div>