<template>
    <!-- Secondary sidebar -->
    <div class="sidebar sidebar-light sidebar-secondary sidebar-expand-md d-print-none" style="width: 350px">

        <!-- Sidebar mobile toggler -->
        <div class="sidebar-mobile-toggler text-center">
            <a href="#" class="sidebar-mobile-secondary-toggle">
                <i class="icon-arrow-left8"></i>
            </a>
            <span class="font-weight-semibold">Secondary sidebar</span>
            <a href="#" class="sidebar-mobile-expand">
                <i class="icon-screen-full"></i>
                <i class="icon-screen-normal"></i>
            </a>
        </div>
        <!-- /sidebar mobile toggler -->


        <!-- Sidebar content -->
        <div class="sidebar-content ">
            <div id="rg-sidebar-secondary-fixed-content-scroll"
                 class="position-fixed h-100"
                 style="width: 350px; overflow: hidden; padding-bottom:80px !important;">
                <div>

                    <!-- Sub navigation -->
                    <div class="card mb-2">

                        <div class="card-body p-0">
                            <ul class="nav nav-sidebar" data-nav-type="accordion">
                                <li class="nav-item-header">
                                    Journals
                                    <span class="badge bg-primary badge-pill ml-auto float-right">{{tableData.payload.total}}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /sub navigation -->

                    <div class="card shadow-none rounded-0 border-0">

                        <loading-txn-side-bar-left-animation></loading-txn-side-bar-left-animation>

                        <div class="table-responsive">

                            <table class="table table-hover">
                                <tbody>
                                <tr v-for="txn in tableData.payload.data"
                                    @click="onRowClick(txn)"
                                    :class="[txn.id == $route.params.id ? 'table-warning border-left-3 border-warning' : '']">
                                        <td class="col-md-6 cursor-pointer">
                                            <h6 class="m-0">
                                                <div class="rg-nowrap-ellipsis">{{txn.contact_name}}</div>
                                                <small class="display-block text-muted">
                                                    {{txn.date}} -
                                                    <span class="text-primary">{{txn.number_string}}</span>
                                                </small>
                                            </h6>
                                        </td>
                                        <td class="col-md-6 cursor-pointer">
                                            <div class="text-right">
                                                <div class="rg-nowrap-ellipsis">
                                                    {{rgNumberFormat(txn.total, 2)}} <small>{{txn.base_currency}}</small>
                                                </div>
                                                <small v-bind:class="'display-block text-size-small text-uppercase font-weight-bold '+[txn.status === 'draft' ? 'text-danger' : 'text-success']">
                                                    {{txn.status}}
                                                </small>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <rg-tables-pagination v-bind:table-data-prop="tableData"></rg-tables-pagination>

                        </div>

                    </div>

                </div>
            </div>

        </div>
        <!-- /sidebar content -->

    </div>
    <!-- /secondary sidebar -->
</template>

<script>

    export default {
        name: 'SideBarLeftTransactions',
        data() {
            return {
                PerfectScrollbar: null
            }
        },
        watch: {
            '$route.query.page': function (page) {
                this.tableData.url = '/financial-accounts/advanced/journals' + '?page=' + page;
                this.$root.LoadingTxnSideBarLeft = true
            }
        },
        mounted() {

            let rgTableDataUrl = '/financial-accounts/advanced/journals'

            if (this.$route.query.page === undefined) {
                this.tableData.url = rgTableDataUrl;
            } else {
                this.tableData.url = rgTableDataUrl + '?page=' + this.$route.query.page;
            }

            this.tableData.recordsPerPage = Math.floor((window.innerHeight - 70 - 70 -70) /70)
            this.tableData.paginationLength = 1

            this.tableData.initiate = true

            //make the secondary sidebar scrollable
            this.PerfectScrollbar = new PerfectScrollbar('#rg-sidebar-secondary-fixed-content-scroll');

            //console.log(this.tableData)
            //console.log(this.$route.params.id)


        },
        methods: {
            onRowClick(txn) {
                //console.log(this.$route)
                let path = '/financial-accounts/advanced/journals/' + txn.id
                if (this.$route.path === path) {
                    // do nothing this is a duplicate
                } else {
                    this.$router.push({
                        path: path,
                        query: {page: this.$route.query.page}
                    })
                }
            }
        },
        updated: function () {
            //update scrollable are on data change
            this.PerfectScrollbar.update();
        }
    }
</script>
