<template>

    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <h4><i class="icon-drawer3 mr-2"></i> <span class="font-weight-semibold">Chats Of Accounts</span></h4>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>

            </div>

            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="breadcrumb">
                        <a href="/" class="breadcrumb-item">
                            <i class="icon-home2 mr-2"></i>
                            <span class="badge badge-primary badge-pill font-weight-bold rg-breadcrumb-item-tenant-name"> {{this.$root.tenant.name | truncate(30) }} </span>
                        </a>
                        <span class="breadcrumb-item">Accounting</span>
                        <span class="breadcrumb-item">Advanced</span>
                        <span class="breadcrumb-item active">Chats Of Accounts</span>
                    </div>

                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>

                <div class="header-elements">
                    <div class="breadcrumb justify-content-center">
                        <router-link to="/financial-accounts/create"
                                     class="btn btn-outline btn-primary border-primary text-primary-800 border-2 btn-sm rounded font-weight-bold mr-2">
                            <i class="icon-files-empty2 mr-1"></i>
                            Create Account
                        </router-link>

                        <button type="button"
                                v-on:click="tableData.settingsDisplay = !tableData.settingsDisplay"
                                class="btn btn-danger btn-sm rounded border-2 border-danger-400 btn-icon pl-2 pr-2">
                            <i class="icon-cog"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page header -->


        <!-- Content area -->
        <div class="content border-0 p-0">

            <loading-animation></loading-animation>

            <!-- Basic table -->
            <div class="card shadow-none rounded-0 border-0">

                <div class="card-body" v-if="!this.$root.loading && tableData.settingsDisplay">

                    <div class="form-group row mb-0">
                        <label class="col-lg-1 col-form-label text-right bg-light border rounded-left border-right-0"
                               style="white-space: nowrap;">
                            Search by column:
                        </label>
                        <div class="col-lg-2 pl-0">
                            <model-select
                                :options="tableData.searchColumnOptions"
                                v-model="tableData.searchColumn"
                                class="rounded-left-0"
                                placeholder="Choose column">
                            </model-select>
                        </div>
                        <div class="col-lg-6">
                            <input type="text"
                                   v-model="tableData.searchValue"
                                   class="form-control h-100 input-roundless"
                                   placeholder="Search by column">
                        </div>

                        <label class="col-lg-1 col-form-label text-right bg-light border rounded-left border-right-0"
                               style="white-space: nowrap;">
                            Records per page:
                        </label>
                        <div class="col-lg-1 pl-0">
                            <model-select
                                :options="tableData.recordsPerPageOptions"
                                v-model="tableData.recordsPerPage"
                                class="rounded-left-0"
                                placeholder="...">
                            </model-select>
                        </div>
                        <div class="col-lg-1">
                            <button type="button"
                                    @click="tableDataUpdate"
                                    class="btn btn-danger rounded border-2 border-danger-400 w-100 h-100 pl-2 pr-2">
                                <i class="icon-cog"></i> Search
                            </button>
                        </div>
                    </div>

                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="table-active">
                                <th scope="col" class="font-weight-bold" style="width: 20px;">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox"
                                               v-model="rgTableSelectAll"
                                               class="custom-control-input"
                                               id="row-checkbox-all">
                                        <label class="custom-control-label" for="row-checkbox-all"> </label>
                                    </div>
                                </th>
                                <th scope="col" class="font-weight-bold">Name</th>
                                <th scope="col" class="font-weight-bold" nowrap="">Code</th>
                                <th scope="col" class="font-weight-bold" nowrap="">Type</th>
                                <th scope="col" class="font-weight-bold" nowrap="">Sub type</th>
                                <th scope="col" class="font-weight-bold">Description</th>
                                <th scope="col" class="font-weight-bold text-right" nowrap>Debit Balance</th>
                                <th scope="col" class="font-weight-bold text-right" nowrap>Credit Balance</th>
                            </tr>
                        </thead>

                        <rg-tables-state></rg-tables-state>

                        <tbody>
                            <tr v-for="row in tableData.payload.data"
                                @click="onRowClick(row)">
                                <td v-on:click.stop="" class="pr-0">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox"
                                               v-model="tableData.selected"
                                               :value="row.id"
                                               number
                                               class="custom-control-input"
                                               :id="'row-checkbox-'+row.id"
                                               isabled>
                                        <label class="custom-control-label" :for="'row-checkbox-'+row.id"> </label>
                                    </div>
                                </td>
                                <td class="cursor-pointer font-weight-semibold" nowrap >{{row.name}}</td>
                                <td class="cursor-pointer">{{row.code}}</td>
                                <td class="cursor-pointer">{{row.type}}</td>
                                <td class="cursor-pointer">{{row.sub_type}}</td>
                                <td class="cursor-pointer">{{row.description}}</td>
                                <td class="cursor-pointer font-weight-bold text-right">
                                    <span class="text-danger-800">{{rgNumberFormat(row.balance.debit, 2)}}</span>
                                    <small>{{row.balance.currency}}</small>
                                </td>
                                <td class="cursor-pointer font-weight-bold text-right">
                                    <span class="text-danger-800">{{rgNumberFormat(row.balance.credit, 2)}}</span>
                                    <small>{{row.balance.currency}}</small>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <rg-tables-pagination v-bind:table-data-prop="tableData"></rg-tables-pagination>

                </div>

            </div>
            <!-- /basic table -->

        </div>
        <!-- /content area -->


        <!-- Footer -->

        <!-- /footer -->

    </div>
    <!-- /main content -->

</template>

<style>

</style>

<script>

    export default {
        name: 'AccountingSalesInvoices',
        //components: {},
        data() {
            return {}
        },
        watch: {
            '$route.query.page': function (page) {
                this.tableData.url = this.$router.currentRoute.path + '?page='+page;
            }
        },
        mounted() {
            this.$root.appMenu('accounting')

            this.tableData.searchColumnOptions = [
                { value: 'date', text: 'Date' },
                { value: 'number', text: 'Document No' },
                { value: 'reference', text: 'Reference' },
                { value: 'contact_name', text: 'Contact name' },
                { value: 'status', text: 'Status' },
                { value: 'expiry_date', text: 'Expiry date' },
                { value: 'total', text: 'Total' }
            ]

            this.tableData.initiate = true

            let currentObj = this;

            if (currentObj.$route.query.page === undefined) {
                currentObj.tableData.url = this.$router.currentRoute.path; //'/crbt/transactions';
            } else {
                currentObj.tableData.url = this.$router.currentRoute.path + '?page='+currentObj.$route.query.page;
            }


        },
        methods: {
            onRowClick(row) {
                //console.log(txn)
                this.$router.push({ path: '/financial-accounts/reports/account-statement/'+row.id })
            }
        },
        ready:function(){},
        beforeUpdate: function () {},
        updated: function () {
            InputsCheckboxesRadios.initComponents();
        }
    }
</script>
