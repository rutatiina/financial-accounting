import DatePicker from 'vue2-datepicker'
import {
    ModelSelect,
    ModelListSelect,
    MultiListSelect,
    ListSelect
} from '../../../../../../rutatiina/vue/vue-search-select/src/lib'
import 'vue-search-select/dist/VueSearchSelect.css'
import TxnRecurringFields from '../components/l-limitless-bs4/TxnRecurringFields';

const RgTxn = {
    install(Vue, options)
    {
        /*/ 1. add global method or property
        Vue.myGlobalMethod = function () {
            // some logic ...
        }

        // 2. add a global asset
        Vue.directive('my-directive', {
            bind(el, binding, vnode, oldVnode) {
                // some logic ...
            }
        })
        */

        // 3. inject some component options
        Vue.mixin({
            components: {
                ModelSelect,
                ModelListSelect,
                MultiListSelect,
                ListSelect,
                DatePicker,
                'txn-recurring-fields': TxnRecurringFields
            },
            data()
            {
                return {

                    //data source urls
                    sourceUrls: {
                        items: '/items/vue-search-select-sales',
                        contacts: '/contacts/search',
                    },

                    pageTitle: '',
                    txnSubmitBtnText: 'Save and approve',
                    pageAction: '',
                    txnUrlStore: '',
                    txnShowId: 0, //id of txn being shown
                    txnData: {}, //the details of the transaction
                    txnDataOriginal: {}, //copy of txnData but always remains unchanged for comparison of data changes
                    txnPaymentTerms: [
                        {value: 'Net7', text: 'Net 7'},
                        {value: 'Net10', text: 'Net 10'},
                        {value: 'Net30', text: 'Net 30'},
                        {value: 'Net60', text: 'Net 60'},
                        {value: 'Net90', text: 'Net 90'},
                        {value: 'EOM', text: 'EOM'}
                    ],
                    txnAttributes: {
                        status: 'approved',
                        send: false,
                        isRecurring: false,
                        contact_id: '',
                        contact: {
                            currencies: []
                        },
                        items: [
                            {
                                invoice: {}, //used by receipt and payment entries
                                selectedItem: {},
                                selectedTaxes: [],
                                displayTotal: 0,
                                taxes: [],
                                total: 87
                            }
                        ],
                        recordings: [],
                        recurring: {
                            date_range: [], //used by vue
                            frequency: 'monthly',
                            start_date: '',
                            end_date: '',
                            day_of_month: '*',
                            month: '*',
                            day_of_week: '*',
                        }
                    },
                    txnTaxesAllInclusive: false,
                    txnContacts: [],
                    txnContactsSalespersons: [],
                    txnAccounts: [],
                    txnAccountsIncome: [],
                    txnAccountsAssets: [],
                    txnAccountsEquity: [],
                    txnAccountsPayment: [],
                    txnAccountsExpenses: [],
                    txnTaxes: [],
                    txnItems: [
                        {
                            id: 0,
                            name: "tag input name",
                            description: "",
                            rate: 0
                        }
                    ],
                    txnPaymentModes: [],

                    // start:: vue2-datepicker
                    vue2DatePicker: {
                        // custom lang
                        lang: {
                            days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                            months: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                            pickers: ['next 7 days', 'next 30 days', 'previous 7 days', 'previous 30 days'],
                            placeholder: {
                                date: 'Select Date',
                                dateRange: 'Select Date Range'
                            }
                        },
                        // custom range shortcuts
                        shortcuts: [
                            {
                                text: 'Today',
                                onClick: () =>
                                {
                                    this.time3 = [new Date(), new Date()]
                                }
                            }
                        ],
                        timePickerOptions: {
                            start: '00:00',
                            step: '00:30',
                            end: '23:30'
                        }
                    },
                    // end:: vue2-datepicker
                }

            },
            watch: {
                'txnAttributes.contact.currency': function ()
                {
                    try
                    {
                        let contact = this.txnAttributes.contact
                        this.txnAttributes.base_currency = contact.currency.code
                        this.txnAttributes.exchange_rate = contact.currency.exchangeRate
                        //console.log('contact.currency', contact.currency)
                    } catch (e)
                    {
                        //
                        console.log(e)
                    }
                }
            },
            created: function ()
            {
                // some logic ...
                //console.log('#rg-tables plugin: created');
            },
            methods: {
                async txnFetchData()
                {

                    try
                    {

                        this.$root.loadingTxn = true

                        return await axios.get(this.$route.fullPath)
                            .then(response =>
                            {
                                this.txnData = response.data
                                this.txnDataOriginal = JSON.parse(JSON.stringify(response.data));
                                this.$root.loadingTxn = false
                                return response.data
                            })
                            .catch(function (error)
                            {
                                // handle error
                                console.log(error); //test
                            })
                            .finally(function (response)
                            {
                                // always executed this is supposed
                            })

                    } catch (e)
                    {
                        console.log(e); //test
                    }
                },

                //used to get txn data for create, edit, copy
                async txnCreateData()
                {

                    try
                    {

                        return await axios.get(this.$route.fullPath)
                            .then(response =>
                            {
                                this.pageTitle = response.data.pageTitle
                                this.pageAction = response.data.pageAction
                                this.txnAttributes = response.data.txnAttributes
                                this.txnUrlStore = response.data.txnUrlStore
                                //this.$root.loading = false

                                this.txnTotal()
                            })
                            .catch(function (error)
                            {
                                // handle error
                                console.log(error); //test
                            })
                            .finally(response =>
                            {
                                // always executed this is supposed
                            })

                    } catch (e)
                    {
                        console.log(e); //test
                    }
                },
                async txnFetchTaxes()
                {

                    try
                    {

                        return await axios.get('/taxes/select-options')
                            .then(response =>
                            {
                                this.txnTaxes = response.data.data
                            })
                            .catch(function (error)
                            {
                                // handle error
                                console.log(error); //test
                            })
                            .finally(function (response)
                            {
                                // always executed this is supposed
                            })

                    } catch (e)
                    {
                        console.log(e); //test
                    }
                },
                async txnFetchAccounts()
                {

                    try
                    {

                        return await axios.get('/financial-accounts')
                            .then(response =>
                            {
                                //console.log(response.data.tableData)
                                this.txnAccounts = response.data.tableData.data
                            })
                            .catch(function (error)
                            {
                                // handle error
                                console.log(error); //test
                            })
                            .finally(function (response)
                            {
                                // always executed this is supposed
                            })

                    } catch (e)
                    {
                        console.log(e); //test
                    }
                },
                async txnFetchAccountsAssets()
                {

                    try
                    {

                        return await axios.get('/financial-accounts/accounts/by-type/asset')
                            .then(response =>
                            {
                                this.txnAccountsAssets = response.data.data
                            })
                            .catch(function (error)
                            {
                                // handle error
                                console.log(error); //test
                            })
                            .finally(function (response)
                            {
                                // always executed this is supposed
                            })

                    } catch (e)
                    {
                        console.log(e); //test
                    }
                },
                async txnFetchAccountsIncome()
                {

                    try
                    {

                        return await axios.get('/financial-accounts/accounts/by-type/revenue')
                            .then(response =>
                            {
                                this.txnAccountsIncome = response.data.data
                            })
                            .catch(function (error)
                            {
                                // handle error
                                console.log(error); //test
                            })
                            .finally(function (response)
                            {
                                // always executed this is supposed
                            })

                    } catch (e)
                    {
                        console.log(e); //test
                    }
                },
                async txnFetchAccountsEquity()
                {

                    try
                    {

                        return await axios.get('/financial-accounts/accounts/by-type/equity')
                            .then(response =>
                            {
                                this.txnAccountsEquity = response.data.data
                            })
                            .catch(function (error)
                            {
                                // handle error
                                console.log(error); //test
                            })
                            .finally(function (response)
                            {
                                // always executed this is supposed
                            })

                    } catch (e)
                    {
                        console.log(e); //test
                    }
                },
                async txnFetchAccountsExpenses()
                {

                    try
                    {

                        return await axios.get('/financial-accounts/accounts/by-type/expense')
                            .then(response =>
                            {
                                this.txnAccountsExpenses = response.data.data
                            })
                            .catch(function (error)
                            {
                                // handle error
                                console.log(error); //test
                            })
                            .finally(function (response)
                            {
                                // always executed this is supposed
                            })

                    } catch (e)
                    {
                        console.log(e); //test
                    }
                },
                async txnFetchAccountsPayment()
                {

                    try
                    {

                        return await axios.get('/financial-accounts/accounts/is-payment')
                            .then(response =>
                            {
                                this.txnAccountsPayment = response.data.data
                            })
                            .catch(function (error)
                            {
                                // handle error
                                console.log(error); //test
                            })
                            .finally(function (response)
                            {
                                // always executed this is supposed
                            })

                    } catch (e)
                    {
                        console.log(e); //test
                    }
                },
                async txnFetchContacts(searchText)
                {

                    if (!searchText)
                    {
                        return false
                    }

                    searchText = (searchText === '-initiate-') ? '' : searchText

                    let data = {
                        search: [
                            {
                                column: 'name',
                                value: searchText
                            },
                            {
                                column: 'display_name',
                                value: searchText
                            }
                        ]
                    }

                    try
                    {

                        return await axios.post(
                            this.sourceUrls.contacts, //'/contacts/search',
                            data
                        )
                            .then(response =>
                            {
                                this.txnContacts = response.data.data
                            })
                            .catch(function (error)
                            {
                                // handle error
                                console.log(error); //test
                            })
                            .finally(function (response)
                            {
                                // always executed this is supposed
                            })

                    } catch (e)
                    {
                        console.log(e); //test
                    }

                },
                async txnFetchCustomers(searchText)
                {

                    if (!searchText)
                    {
                        return false
                    }

                    searchText = (searchText === '-initiate-') ? '' : searchText

                    let data = {
                        search: [
                            {
                                column: 'name',
                                value: searchText
                            },
                            {
                                column: 'display_name',
                                value: searchText
                            },
                            {
                                column: 'types',
                                value: 'customer'
                            }
                        ]
                    }

                    try
                    {

                        return await axios.post(
                            this.sourceUrls.contacts, //'/contacts/search',
                            data
                        )
                            .then(response =>
                            {
                                this.txnContacts = response.data.data
                            })
                            .catch(function (error)
                            {
                                // handle error
                                console.log(error); //test
                            })
                            .finally(function (response)
                            {
                                // always executed this is supposed
                            })

                    } catch (e)
                    {
                        console.log(e); //test
                    }

                },
                async txnFetchSalespersons(searchText)
                {

                    if (!searchText)
                    {
                        return false
                    }

                    searchText = (searchText === '-initiate-') ? '' : searchText

                    let data = {
                        search: [
                            {
                                column: 'name',
                                value: searchText
                            },
                            {
                                column: 'display_name',
                                value: searchText
                            },
                            {
                                column: 'types',
                                value: 'customer'
                            }
                        ]
                    }

                    try
                    {

                        return await axios.post(
                            '/contacts/search/salespersons',
                            data
                        )
                            .then(response =>
                            {
                                this.txnContactsSalespersons = response.data.data
                            })
                            .catch(function (error)
                            {
                                // handle error
                                console.log(error); //test
                            })
                            .finally(function (response)
                            {
                                // always executed this is supposed
                            })

                    } catch (e)
                    {
                        console.log(e); //test
                    }

                },
                async txnFetchSuppliers(searchText)
                {

                    if (!searchText)
                    {
                        return false
                    }

                    searchText = (searchText === '-initiate-') ? '' : searchText

                    let data = {
                        search: [
                            {
                                column: 'name',
                                value: searchText
                            },
                            {
                                column: 'display_name',
                                value: searchText
                            },
                            {
                                column: 'types',
                                value: 'supplier'
                            }
                        ]
                    }

                    try
                    {

                        return await axios.post(
                            this.sourceUrls.contacts, //'/contacts/search',
                            data
                        )
                            .then(response =>
                            {
                                this.txnContacts = response.data.data
                            })
                            .catch(function (error)
                            {
                                // handle error
                                console.log(error); //test
                            })
                            .finally(function (response)
                            {
                                // always executed this is supposed
                            })

                    } catch (e)
                    {
                        console.log(e); //test
                    }

                },
                async txnFetchItems(searchText)
                {

                    this.txnItems[0].name = (searchText === '-initiate-') ? '' : searchText

                    if (!searchText)
                    {
                        return false
                    }

                    let data = {
                        search_text: searchText,
                        search: [
                            {
                                column: 'name',
                                value: searchText
                            }
                        ]
                    }

                    try
                    {

                        return await axios.post(
                            this.sourceUrls.items, //'/items/vue-search-select-sales',
                            data
                        )
                            .then(response =>
                            {
                                response.data[0].name = (searchText === '-initiate-') ? '' : searchText
                                this.txnItems = response.data

                            })
                            .catch(function (error)
                            {
                                // handle error
                                console.log(error); //test
                            })
                            .finally(function (response)
                            {
                                // always executed this is supposed
                            })

                    } catch (e)
                    {
                        console.log(e); //test
                    }

                },
                async txnFetchPaymentModes()
                {

                    try
                    {

                        return await axios.get('/financial-accounts/advanced/payment-modes')
                            .then(response =>
                            {
                                this.txnPaymentModes = response.data
                            })
                            .catch(function (error)
                            {
                                // handle error
                                console.log(error); //test error
                            })
                            .finally(function (response)
                            {
                                // always executed this is supposed
                            })

                    } catch (e)
                    {
                        console.log(e); //test
                    }

                },
                txnOnSave(status, send)
                {

                    this.txnAttributes.status = status
                    this.txnAttributes.send = send

                    if (send === true)
                    {
                        this.txnSubmitBtnText = 'Save, approve and send'
                        return
                    }

                    if (status === 'draft')
                    {
                        this.txnSubmitBtnText = 'Save as draft'
                    } else if (status === 'approved')
                    {
                        this.txnSubmitBtnText = 'Save and approve'
                    }
                },
                txnDateStringPad(n)
                {
                    //add leading 0 where needed for date month and day
                    return String("0" + n).slice(-2);
                },
                txnItemTaxes(options, option, row)
                {
                    //console.log(row)
                    //console.log(options)
                    //console.log(option)
                    //console.log(this.txnAttributes.items[row])
                    this.txnAttributes.items[row].selectedTaxes = options
                    this.txnTotal()
                },
                txnFormData()
                {

                    //console.log('generating form data');
                    let currentObj = this;
                    let formData = new FormData();

                    //console.log(currentObj.txnAttributes)

                    //#level 1
                    Object.keys(currentObj.txnAttributes).forEach(function (key)
                    {

                        if (typeof currentObj.txnAttributes[key] == 'object')
                        {

                            if (currentObj.txnAttributes[key] === null)
                            {

                                //formData.append(key, currentObj.txnAttributes[key])
                                formData.append(key, '')

                            } else
                            {

                                //#level 2
                                Object.keys(currentObj.txnAttributes[key]).forEach(function (_key)
                                {

                                    if (typeof currentObj.txnAttributes[key][_key] == 'object')
                                    {

                                        if (currentObj.txnAttributes[key][_key] === null)
                                        {
                                            //formData.append(key + '[' + _key + ']', currentObj.txnAttributes[key][_key])
                                            formData.append(key + '[' + _key + ']', '')
                                        } else
                                        {

                                            //#level 3
                                            Object.keys(currentObj.txnAttributes[key][_key]).forEach(function (__key)
                                            {

                                                if (typeof currentObj.txnAttributes[key][_key][__key] == 'object')
                                                {

                                                    if (currentObj.txnAttributes[key][_key][__key] === null)
                                                    {
                                                        //formData.append(key + '[' + _key + '][' + __key + ']', currentObj.txnAttributes[key][_key][__key])
                                                        formData.append(key + '[' + _key + '][' + __key + ']', '')
                                                    } else
                                                    {

                                                        //#level 4
                                                        /*Object.keys(currentObj.txnAttributes[key][_key][__key]).forEach(function (___key) {
                                                            formData.append(key + '[' + _key + '][' + __key + '][' + ___key + ']', currentObj.txnAttributes[key][_key][__key][___key])
                                                        })*/

                                                        Object.keys(currentObj.txnAttributes[key][_key][__key]).forEach(function (___key)
                                                        {

                                                            if (typeof currentObj.txnAttributes[key][_key][__key][___key] == 'object')
                                                            {

                                                                if (currentObj.txnAttributes[key][_key][__key][___key] === null)
                                                                {
                                                                    //formData.append(key + '[' + _key + '][' + __key + ']', currentObj.txnAttributes[key][_key][__key][___key])
                                                                    formData.append(key + '[' + _key + '][' + __key + '][' + ___key + ']', '')
                                                                } else
                                                                {

                                                                    //#level 5
                                                                    Object.keys(currentObj.txnAttributes[key][_key][__key][___key]).forEach(function (____key)
                                                                    {
                                                                        formData.append(key + '[' + _key + '][' + __key + '][' + ___key + '][' + ____key + ']', currentObj.txnAttributes[key][_key][__key][___key][____key])
                                                                    })
                                                                    //#level 5
                                                                }
                                                            } else
                                                            {
                                                                formData.append(key + '[' + _key + '][' + __key + ']', currentObj.txnAttributes[key][_key][__key][___key])
                                                            }

                                                            //formData.append(key + '[' + _key + '][' + __key + ']', currentObj.txnAttributes[key][_key][__key][___key])
                                                        })

                                                        //#level 4
                                                    }
                                                } else
                                                {
                                                    formData.append(key + '[' + _key + '][' + __key + ']', currentObj.txnAttributes[key][_key][__key])
                                                }

                                                //formData.append(key + '[' + _key + '][' + __key + ']', currentObj.txnAttributes[key][_key][__key])
                                            })
                                            //#level 3
                                        }
                                    } else
                                    {
                                        formData.append(key + '[' + _key + ']', currentObj.txnAttributes[key][_key])
                                    }
                                })
                                //#level 2 one

                            }

                        } else
                        {
                            formData.append(key, currentObj.txnAttributes[key])
                        }
                    })
                    //#level 1 one

                    /*
                    for (var key of formData.entries()) {
                        console.log(key[0] + ', ' + key[1]);
                    }
                    */

                    return formData;

                },
                txnTaxValue(taxRateOrValue, taxableAmount, taxInclusive)
                {
                    //console.log(tax_value);
                    console.log('taxInclusive', taxInclusive);
                    //console.log('type of tax: ' + inclusive);
                    if (typeof taxRateOrValue === 'undefined') return 0;

                    if (taxRateOrValue.length > 0)
                    {

                        if (taxRateOrValue.substr(-1, 1) === '%')
                        {

                            var tax = taxRateOrValue.substr(0, taxRateOrValue.length - 1);

                            if (isNaN(tax))
                            {
                                return 0;
                            }

                            if (taxInclusive === 1 || this.txnTaxesAllInclusive === true)
                            {
                                return (taxableAmount - (taxableAmount / (1 + (rg_number(tax) / 100))));
                            }

                            return (taxableAmount * (rg_number(tax) / 100));
                        } else
                        {
                            return rg_number(taxRateOrValue);
                        }

                    }

                    return 0;
                },
                txnTotal()
                {
                    //console.log(this.txnAttributes.items)

                    this.txnAttributes.total = 0;
                    this.txnAttributes.taxes = {} //reset all the taxation data

                    this.txnAttributes.items.forEach((item) =>
                    {

                        item.taxes = [] //remove all previous tax details

                        //this.txnAttributes.items[row].total = (this.txnAttributes.items[row].rate * this.txnAttributes.items[row].quantity);
                        item.total = (item.rate * item.quantity);
                        item.displayTotal = item.total

                        this.txnAttributes.total += item.total

                        item.selectedTaxes.forEach((tax, index) =>
                        {

                            // item.taxes.push(tax.id) //todo this is to be removed

                            let taxKey = 'tax_' + tax.id
                            //console.log(tax)
                            //console.log(taxKey)
                            let taxableAmount = item.total
                            let taxValue = this.txnTaxValue(tax.value, taxableAmount, tax.inclusive)
                            taxValue = taxValue.toFixed(2)

                            //console.log(this.txnAttributes.taxes[taxKey])

                            if (tax.inclusive === 1 || this.txnTaxesAllInclusive === true)
                            {

                                if (typeof this.txnAttributes.taxes[taxKey] !== 'undefined')
                                {
                                    //console.log('does exist')
                                    this.txnAttributes.taxes[taxKey].total = (rg_number(this.txnAttributes.taxes[taxKey].total) + rg_number(taxValue)).toFixed(2);
                                    this.txnAttributes.taxes[taxKey].inclusive = (rg_number(this.txnAttributes.taxes[taxKey].inclusive) + rg_number(taxValue)).toFixed(2);
                                } else
                                {
                                    //console.log('inclusive:: does not exist')
                                    this.txnAttributes.taxes[taxKey] = {
                                        code: tax.code,
                                        name: tax.display_name,
                                        total: taxValue,
                                        inclusive: taxValue,
                                        exclusive: 0,
                                    }
                                    item.taxable_amount = item.total - taxValue
                                }

                                item.taxes.push(this.txnAttributes.taxes[taxKey])

                            } else
                            {

                                item.displayTotal = item.displayTotal + rg_number(taxValue)
                                this.txnAttributes.total += rg_number(taxValue)

                                if (typeof this.txnAttributes.taxes[taxKey] !== 'undefined')
                                {
                                    this.txnAttributes.taxes[taxKey].total = (rg_number(this.txnAttributes.taxes[taxKey].total) + rg_number(taxValue)).toFixed(2);
                                    this.txnAttributes.taxes[taxKey].exclusive = (rg_number(this.txnAttributes.taxes[taxKey].exclusive) + rg_number(taxValue)).toFixed(2);
                                } else
                                {
                                    //console.log('exclusive:: does not exist')
                                    this.txnAttributes.taxes[taxKey] = {
                                        code: tax.code,
                                        name: tax.display_name,
                                        total: taxValue,
                                        inclusive: 0,
                                        exclusive: taxValue,
                                    }
                                    item.taxable_amount = item.total
                                }

                                item.taxes.push(this.txnAttributes.taxes[taxKey])

                            }

                        })

                    })
                    //console.log(this.txnAttributes.taxes)
                    this.txnAttributes.taxable_amount = this.txnAttributes.total
                },
                txnContactSelect(contact, row)
                {
                    try
                    {
                        // console.log(contact)
                        this.txnAttributes.contact_id = contact.id
                        this.txnAttributes.base_currency = contact.currency.value
                        this.txnAttributes.exchange_rate = contact.currency.exchangeRate
                    } catch (e)
                    {
                        //console.log(e)
                    }
                },
                txnItemsSelect(itemData, row)
                {
                    //console.log('txnItemsRate', itemData)
                    if (typeof itemData.rate !== 'undefined')
                    {
                        this.txnAttributes.items[row].type_id = itemData.id;
                        this.txnAttributes.items[row].name = itemData.name;
                        this.txnAttributes.items[row].description = itemData.description;
                        this.txnAttributes.items[row].rate = itemData.rate;
                        this.txnTotal()
                    }
                },
                txnItemsRemove(index)
                {
                    this.$delete(this.txnAttributes.items, index);
                    if (this.txnAttributes.items.length === 0)
                    {
                        this.txnItemsCreate()
                    }
                    //console.log('deleted: '+index)
                    this.txnTotal()
                },
                txnItemsClearAll()
                {
                    let currentObj = this;
                    this.txnAttributes.items = []
                    //setTimeout cz the 1st row was retaining the previous values
                    setTimeout(function ()
                    {
                        currentObj.txnItemsCreate()
                    }, 10);
                    this.txnTotal()
                    this.txnAttributes.taxes = {}
                },
                txnItemsTaxRemove(code)
                {

                    //loop through all items
                    this.txnAttributes.items.forEach((item, index) =>
                    {
                        //find the items with the tax
                        item.selectedTaxes.forEach((tax, _index) =>
                        {
                            if (code === tax.code)
                            {
                                this.$delete(this.txnAttributes.items[index].selectedTaxes, _index)
                            }
                        })
                    })

                    this.txnTotal()
                },
                txnItemsCreate()
                {
                    this.txnAttributes.items.push({
                        selectedItem: {},
                        selectedTaxes: [],
                        type: '',
                        type_id: '',
                        contact_id: '',
                        name: '',
                        description: '',
                        rate: 0,
                        quantity: 1,
                        total: 0,
                        taxes: [],
                        tax_id: '',
                        units: '',
                        batch: '',
                        expiry: '',
                    });
                },
                txnFormSubmit(e)
                {

                    e.preventDefault();

                    let currentObj = this;

                    PNotify.removeAll();

                    let PNotifySettings = {
                        title: false, //'Processing',
                        text: 'Please wait as we do our thing',
                        addclass: 'bg-warning-400 border-warning-400',
                        delay: 10000, // 10 seconds
                        hide: true,
                        buttons: {
                            closer: false,
                            sticker: false
                        }
                    };

                    let notice = new PNotify(PNotifySettings);

                    //console.log(Object.assign({}, currentObj.txnAttributes))

                    let formData = currentObj.txnFormData();

                    for (let key in currentObj.$refs.filesAttached.files)
                    {
                        if (typeof currentObj.$refs.filesAttached.files[key].size !== 'undefined')
                        {
                            //console.log('start: appending file')
                            //console.log(currentObj.$refs.filesAttached.files[key].size)
                            //console.log(currentObj.$refs.filesAttached.files[key])
                            //console.log('end: appending file')
                            formData.append('files[]', currentObj.$refs.filesAttached.files[key]);
                        }

                    }

                    //console.log('sending post request');
                    axios.post(
                        currentObj.txnUrlStore,
                        formData,
                        {
                            headers: {'Content-Type': 'multipart/form-data'}
                        }
                    )
                        .then(function (response)
                        {

                            //PNotify.removeAll();
                            //console.log(response.data);
                            //console.log(response.data.callback);

                            PNotifySettings.text = response.data.messages.join("\n");

                            if (response.data.status === true)
                            {
                                PNotifySettings.title = 'Success';
                                PNotifySettings.type = 'success';
                                PNotifySettings.addclass = 'bg-success-400 border-success-400';

                                currentObj.$router.push({path: response.data.callback})

                                notice.update(PNotifySettings);

                            } else
                            {
                                PNotifySettings.title = '! Error';
                                PNotifySettings.type = 'error';
                                PNotifySettings.addclass = 'bg-warning-400 border-warning-400';

                                notice.update(PNotifySettings);
                            }

                            notice.get().click(function ()
                            {
                                notice.remove();
                            });

                        })
                        .catch(function (error)
                        {
                            //currentObj.response = error;
                        });
                },
                txnApprove(url)
                {

                    let currentObj = this;

                    //PNotify.removeAll();

                    let PNotifySettings = {
                        title: false, //'Processing',
                        text: 'Please wait as we do our thing',
                        addclass: 'bg-warning-400 border-warning-400',
                        delay: 10000, // 10 seconds
                        hide: true,
                        buttons: {
                            closer: false,
                            sticker: false
                        }
                    };

                    let notice = new PNotify(PNotifySettings);

                    //console.log('sending post request');
                    axios.post(url)
                        .then(function (response)
                        {

                            //PNotify.removeAll();
                            console.log('txnApprove:' + response.data.callback);

                            PNotifySettings.text = response.data.messages.join("\n");

                            if (response.data.status === true)
                            {
                                PNotifySettings.title = 'Success';
                                PNotifySettings.type = 'success';
                                PNotifySettings.addclass = 'bg-success-400 border-success-400';

                                currentObj.$router.push({path: response.data.callback})

                                notice.update(PNotifySettings);

                                setTimeout(function ()
                                {
                                    currentObj.$router.go()
                                }, 1500);

                            } else
                            {
                                PNotifySettings.title = '! Error';
                                PNotifySettings.type = 'error';
                                PNotifySettings.addclass = 'bg-warning-400 border-warning-400';

                                notice.update(PNotifySettings);
                            }

                            notice.get().click(function ()
                            {
                                notice.remove();
                            });

                        })
                        .catch(function (error)
                        {
                            //currentObj.response = error;
                        });
                },
            },
            mounted()
            {
                //console.log('RgTxn mounted ')
            }
        })

        /*/ 4. add an instance method
        Vue.prototype.$myMethod = function (methodOptions) {
            // some logic ...
        }*/
    }
}

export default RgTxn;

