<template>

    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <h4>
                        <i class="icon-file-plus"></i>
                        {{pageTitle}}
                    </h4>
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
                        <span class="breadcrumb-item">Journals</span>
                        <span class="breadcrumb-item active">{{pageAction}}</span>
                    </div>

                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>

                <div class="header-elements">
                    <div class="breadcrumb justify-content-center">
                        <router-link to="/financial-accounts/advanced/journals" class=" btn btn-danger btn-sm rounded-round font-weight-bold">
                            <i class="icon-drawer3 mr-2"></i>
                            Journals
                        </router-link>
                    </div>
                </div>

            </div>

        </div>
        <!-- /page header -->

        <!-- Content area -->
        <div class="content border-0 padding-0">

            <!-- Form horizontal -->
            <div class="card shadow-none rounded-0 border-0">

                <div class="card-body p-0">

                    <loading-animation></loading-animation>

                    <form v-if="!this.$root.loading"
                          @submit="txnFormSubmit"
                          action=""
                          method="post"
                          class="max-width-1040"
                          style="margin-bottom: 100px;"
                          autocomplete="off">

                        <fieldset id="fieldset_select_contact" class="select_contact_required">

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label font-weight-bold">
                                    Date & Currency:
                                </label>
                                <div class="col-lg-2">
                                    <date-picker v-model="txnAttributes.date"
                                                 valueType="format"
                                                 :lang="vue2DatePicker.lang"
                                                 class="font-weight-bold w-100 h-100"
                                                 placeholder="Choose date">
                                    </date-picker>
                                </div>
                                <div class="col-lg-4">
                                    <model-list-select :list="globalsCurrencies"
                                                       v-model="txnAttributes.base_currency"
                                                       option-value="value"
                                                       option-text="text"
                                                       placeholder="Select currency">
                                    </model-list-select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label font-weight-bold">
                                    Reference:
                                </label>
                                <div class="col-lg-6">
                                    <input type="text" name="reference" v-model="txnAttributes.reference" class="form-control input-roundless" placeholder="Reference">
                                </div>
                            </div>

                        </fieldset>
                        <!--<div class="max-width-1040 clearfix ml-20" style="border-bottom: 1px solid #ddd;"></div>-->


                        <fieldset class="">
                            <div class="form-group row">
                                <table class="table table-bordered border-left-0 border-right-0 border-bottom-0">
                                    <thead class="thead-default bg-light">
                                        <tr>
                                            <th width="25%" class="font-weight-bold">Account</th>
                                            <th width="27%" class="font-weight-bold">Description</th>
                                            <th width="24%" class="font-weight-bold">Contact</th>
                                            <th width="12%" class="font-weight-bold">Debit</th>
                                            <th width="12%" class="text-right font-weight-bold p-0">
                                                <div class="input-group">
                                                    <input type="text"
                                                           value="Credit"
                                                           readonly
                                                           class="rg-txn-item-row-total form-control border-0 text-right font-weight-bold bg-transparent"
                                                           placeholder="0.00">
                                                    <span class="input-group-append border-0 rounded-0">
                                                        <button type="button"
                                                                @click="txnItemsClearAll"
                                                                class="btn bg-danger bg-transparent text-danger btn-icon"
                                                                title="Clear all items">
                                                            <i class="icon-cross3"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="items_field_rows">

                                        <tr v-for="(item, index) in txnAttributes.items">
                                            <td class="td_item_selector p-0 rg_select2_border_none">
                                                <model-list-select :list="txnAccounts"
                                                                   v-model="item.type_id"
                                                                   option-value="id"
                                                                   option-text="name"
                                                                   :option-item-row="index"
                                                                   option-tag
                                                                   @searchchange="txnFetchAccounts"
                                                                   class="border-0"
                                                                   placeholder="Select Account">
                                                </model-list-select>
                                            </td>
                                            <td class="p-0">
                                                <input type="text"
                                                       v-model="item.description"
                                                       :data-row="index"
                                                       class="form-control border-0"
                                                       placeholder="Description">
                                            </td>
                                            <td class="p-0">
                                                <model-list-select :list="txnContacts"
                                                                   v-model="item.contact_id"
                                                                   @searchchange="txnFetchCustomers"
                                                                   @input="txnContactSelect"
                                                                   option-value="id"
                                                                   option-text="display_name"
                                                                   class="border-0"
                                                                   placeholder="select contact">
                                                </model-list-select>
                                            </td>
                                            <td class="p-0">
                                                <input type="text"
                                                       v-model.number="item.debit"
                                                       @change="itemDebit(index)"
                                                       class="form-control border-0 text-right bg-transparent">

                                            </td>
                                            <td class="p-0">
                                                <div style="position: relative">
                                                    <div class="input-group">
                                                        <input type="text"
                                                               v-model.number="item.credit"
                                                               @change="itemCredit(index)"
                                                               class="form-control border-0 text-right bg-transparent">
                                                        <span class="input-group-append border-0 rounded-0">
                                                            <button type="button"
                                                                    @click="txnItemsRemove(index)"
                                                                    class="btn bg-danger bg-transparent text-danger btn-icon"
                                                                    title="Delete row">
                                                                <i class="icon-cross3"></i>
                                                            </button>
                                                        </span>
                                                    </div>

                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <td class="border-0" colspan="2">
                                                <button type="button" class="btn btn-link pt-0 pb-0 font-weight-bold" @click="txnItemsCreate">
                                                    <i class="icon-plus2 mr-2"></i> Add another line
                                                </button>
                                            </td>
                                            <td class="p-15 border-left-0 border-top-0 border-right-0 font-weight-bold size4of5">
                                                TOTAL
                                                <span v-if="txnAttributes.base_currency"
                                                      class="badge badge-primary badge-pill font-weight-bold rg-breadcrumb-item-tenant-name">
                                                    {{txnAttributes.base_currency}}
                                                </span>
                                            </td>
                                            <td class="border-left-0 border-top-0 border-right-0 font-weight-bold size4of5 text-right pr-3">
                                                {{rgNumberFormat(txnAttributes.totalDebit, 2)}}
                                            </td>
                                            <td class="border-left-0 border-top-0 border-right-0 font-weight-bold size4of5 text-right pr-5">
                                                {{rgNumberFormat(txnAttributes.totalCredit, 2)}}
                                            </td>
                                        </tr>
                                    </tfoot>

                                </table>
                            </div>
                        </fieldset>


                        <fieldset class="">

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">
                                    Notes:
                                </label>
                                <div class="col-lg-10">
                                    <textarea v-model="txnAttributes.contact_notes" class="form-control input-roundless" rows="2" placeholder="Notes"></textarea>
                                </div>
                            </div>

                            <!--https://stackoverflow.com/questions/53409139/how-to-upload-multiple-images-files-with-javascript-and-axios-formdata-->
                            <!--https://laracasts.com/discuss/channels/vue/upload-multiple-files-and-relate-them-to-post-model-->
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">Attach files</label>
                                <div class="col-lg-10">
                                    <input ref="filesAttached" type="file" multiple class="form-control border-0 p-1 h-auto">
                                </div>
                            </div>

                        </fieldset>

                        <div class="text-left col-md-10 offset-md-2 p-0">

                            <div class="btn-group ml-1">
                                <button type="button" class="btn btn-outline bg-purple-300 border-purple-300 text-purple-800 btn-icon border-2 dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-cog"></i>
                                </button>

                                <div class="dropdown-menu dropdown-menu-left">
                                    <a href="/" class="dropdown-item" v-on:click.prevent="txnOnSave('draft', false)">
                                        <i class="icon-file-text3"></i> Save as draft
                                    </a>
                                    <a href="/" class="dropdown-item" v-on:click.prevent="txnOnSave('Approved', false)">
                                        <i class="icon-file-check2"></i> Save and approve
                                    </a>
                                    <a href="/" class="dropdown-item" v-on:click.prevent="txnOnSave('Approved', true)">
                                        <i class="icon-mention"></i> Save, Approve and Send
                                    </a>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-danger font-weight-bold">
                                <i class="icon-file-plus2 mr-1"></i> {{txnSubmitBtnText}}
                            </button>

                        </div>

                    </form>

                </div>
            </div>
            <!-- /form horizontal -->


        </div>
        <!-- /content area -->

    </div>
    <!-- /main content -->

</template>

<script>

    export default {
        created: function () {
            this.pageTitle = 'Create Journal'
            this.pageAction = 'Create'
        },
        mounted() {

            //console.log(this.$route.fullPath)
            this.appFetchGlobalsCurrencies()
            this.txnCreateData()
            this.txnFetchCustomers('-initiate-')
            this.txnFetchItems('-initiate-')
            this.txnFetchTaxes()
            this.txnFetchAccounts()
        },
        methods: {
            itemDebit(index) {
                if (isNaN(this.txnAttributes.items[index].debit)) {
                    this.txnAttributes.items[index].debit = null
                }
                this.txnAttributes.items[index].credit = null
                this.journalTotals()
            },
            itemCredit(index) {
                if (isNaN(this.txnAttributes.items[index].credit)) {
                    this.txnAttributes.items[index].credit = null
                }
                this.txnAttributes.items[index].debit = null
                this.journalTotals()
            },
            journalTotals() {
                //console.log(this.txnAttributes.items)

                this.txnAttributes.total = 0;
                this.txnAttributes.totalDebit = 0;
                this.txnAttributes.totalCredit = 0;

                this.txnAttributes.items.forEach((item) => {

                    item.type = 'account' //always
                    item.quantity = 1 //always

                    if (item.debit > 0 && item.credit > 0) {
                        //console.log('item has both dr & cr')
                        this.txnAttributes.totalDebit = 'Error!'
                        this.txnAttributes.totalCredit = 'Error!'
                        return false;
                    }

                    if (item.debit > 0) {

                        item.effect = 'debit'
                        item.rate = item.debit
                        item.total = item.debit
                        this.txnAttributes.totalDebit += item.debit

                        this.txnAttributes.total += item.debit

                    } else {

                        item.effect = 'credit'
                        item.rate = item.credit
                        item.total = item.credit
                        this.txnAttributes.totalCredit += item.credit

                    }

                    item.displayTotal = item.total

                    this.txnAttributes.total += item.total

                })

            },
        }
    }
</script>
