<template>

    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <h4>
                        <i class="icon-file-plus2"></i>
                        {{pageTitle}}
                    </h4>
                </div>

            </div>

            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="breadcrumb">
                        <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                        <span class="breadcrumb-item">Accounting</span>
                        <span class="breadcrumb-item">Advanced</span>
                        <span class="breadcrumb-item active">Accounts</span>
                        <span class="breadcrumb-item active">{{pageAction}}</span>
                    </div>

                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>

                <div class="header-elements">
                    <div class="breadcrumb justify-content-center">
                        <router-link to="/financial-accounts" class=" btn btn-danger btn-sm rounded-round font-weight-bold">
                            <i class="icon-files-empty2 mr-1"></i>
                            Accounts
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
                          @submit="formSubmit"
                          method="post"
                          class="max-width-1040"
                          autocomplete="off">

                        <fieldset>

                            <div class="form-group row">
                                <div class="offset-md-1 col-lg-6">
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text">Name</span>
                                        </span>
                                        <input type="text" v-model="attributes.name" class="form-control input-roundless" placeholder="Account Name">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="offset-md-1 col-lg-6">
                                    <div class="form-group row mr-0 ml-0">
                                        <label class="col-auto col-form-label text-right bg-light border rounded-left border-right-0"
                                               style="white-space: nowrap;">
                                            Type
                                        </label>
                                        <div class="col pl-0 pr-0">
                                            <model-list-select :list="accountTypes"
                                                               v-model="attributes.type"
                                                               option-value="value"
                                                               option-text="text"
                                                               class="rounded-left-0"
                                                               placeholder="Select Account type">
                                            </model-list-select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="offset-md-1 col-lg-6">
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text">Code</span>
                                        </span>
                                        <input type="text" v-model="attributes.code" class="form-control input-roundless" placeholder="Account Code">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="offset-md-1 col-lg-6">
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text">Description</span>
                                        </span>
                                        <textarea v-model="attributes.description" class="form-control input-roundless"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="offset-md-1 col-lg-6">
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" v-model="attributes.payment" value="1" class="custom-control-input" id="is_payment_account">
                                        <label class="custom-control-label" for="is_payment_account">This is a payments account.</label>
                                    </div>
                                </div>
                            </div>

                        </fieldset>

                        <div class="text-left col-md-10 offset-md-1 p-0">
                            <button type="submit" class="btn btn-danger font-weight-bold">
                                <i class="icon-file-plus2 mr-1"></i> Create Account
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
        components: {},
        data() {
            return {
                pageTitle: 'Create Account',
                urlPost: '/financial-accounts',
                pageAction: 'Create',
                attributes: {},
                accountTypes: [
                    { value: 'asset', text: 'Asset' },
                    { value: 'equity', text: 'Equity' },
                    { value: 'expense', text: 'Expense' },
                    { value: 'income', text: 'Income / Revenue' },
                    { value: 'liability', text: 'Liability' },
                    { value: 'inventory', text: 'Inventory' },
                    { value: 'cost_of_sales', text: 'Cost of sales' },
                    { value: 'none', text: 'None' }
                ]
            }
        },
        mounted() {
            this.$root.appMenu('accounting')
            this.$root.appFetchGlobalsCountries()

            this.fetchAttributes()

        },
        watch: {
            $route: function () {
                this.fetchAttributes()
            }
        },
        methods: {
            async fetchAttributes() {

                try {

                    return await axios.get(this.$route.fullPath)
                        .then(response => {
                            this.attributes = response.data.attributes
                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error); //test
                        })
                        .finally(function (response) {
                            // always executed this is supposed
                        })

                } catch (e) {
                    console.log(e); //test
                }
            },
            formSubmit(e) {

                e.preventDefault();

                let currentObj = this;

                PNotify.removeAll();

                let PNotifySettings = {
                    title: false, //'Processing',
                    text: 'Please wait as we do our thing',
                    addclass: 'bg-warning-400 border-warning-400',
                    hide: false,
                    buttons: {
                        closer: false,
                        sticker: false
                    }
                };

                let notice = new PNotify(PNotifySettings);

                //console.log(this.attributes);

                axios.post(currentObj.urlPost, this.attributes)
                    .then(function (response) {

                        //PNotify.removeAll();

                        PNotifySettings.text = response.data.messages.join("\n");

                        if(response.data.status === true) {
                            PNotifySettings.title = 'Success';
                            PNotifySettings.type = 'success';
                            PNotifySettings.addclass = 'bg-success-400 border-success-400';

                            currentObj.fetchAttributes()

                        } else {
                            PNotifySettings.title = '! Error';
                            PNotifySettings.type = 'error';
                            PNotifySettings.addclass = 'bg-warning-400 border-warning-400';
                        }

                        //let notice = new PNotify(PNotifySettings);
                        notice.update(PNotifySettings);

                        notice.get().click(function() {
                            notice.remove();
                        });

                        //currentObj.response = response.data;
                    })
                    .catch(function (error) {
                        currentObj.response = error;
                    });
            },
        },
        ready:function(){},
        beforeUpdate: function () {},
        updated: function () {},
        destroyed: function () {}
    }
</script>
