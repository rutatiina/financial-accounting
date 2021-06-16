const AccountingReportsIndex = () => import('./Index')

//business overview
const ProfitAndLoss = () => import('./ProfitAndLoss')
const BalanceSheet = () => import('./BalanceSheet')

//sales
const SalesByCustomer = () => import('./SalesByCustomer')
const SalesByItem = () => import('./SalesByItem')
const SalesBySalesperson = () => import('./SalesBySalesperson')

//Receivables
const InvoiceDetails = () => import('./InvoiceDetails')
const RetainerInvoiceDetails = () => import('./RetainerInvoiceDetails')
const SalesOrderDetails = () => import('./SalesOrderDetails')
const EstimateDetails = () => import('./EstimateDetails')

//Payments Received
const PaymentsReceived = () => import('./PaymentsReceived')
const CreditNoteDetails = () => import('./CreditNoteDetails')

//Recurring Invoices
const RecurringInvoiceDetails = () => import('./RecurringInvoiceDetails')

//Payables
const BillsDetails = () => import('./BillsDetails')
const VendorCreditsDetails = () => import('./VendorCreditsDetails')
const PurchaseOrderDetails = () => import('./PurchaseOrderDetails')

//Purchases and Expenses
const ExpenseDetails = () => import('./ExpenseDetails')

//accountant
const TrialBalance = () => import('./TrialBalance')

const routes = [

    {
        path: '/accounting/reports',
        components: {
            default: AccountingReportsIndex,
        },
        meta: {
            title: 'Accounting Reports',
            metaTags: [
                {
                    name: 'description',
                    content: 'Accounting Reports'
                },
                {
                    property: 'og:description',
                    content: 'Accounting Reports'
                }
            ]
        }
    },
    {
        path: '/accounting/reports/trial-balance',
        components: {
            default: TrialBalance,
        },
        meta: {
            title: 'Accounting Reports :: Trial Balance',
            metaTags: [
                {
                    name: 'description',
                    content: 'Trial Balance'
                },
                {
                    property: 'og:description',
                    content: 'Trial Balance'
                }
            ]
        }
    },
    {
        path: '/accounting/reports/profit-and-loss',
        components: {
            default: ProfitAndLoss,
        },
        meta: {
            title: 'Accounting Reports :: Profit And Loss',
            metaTags: [
                {
                    name: 'description',
                    content: 'Profit And Loss'
                },
                {
                    property: 'og:description',
                    content: 'Profit And Loss'
                }
            ]
        }
    },
    {
        path: '/accounting/reports/balance-sheet',
        components: {
            default: BalanceSheet,
        },
        meta: {
            title: 'Accounting Reports :: Balance Sheet',
            metaTags: [
                {
                    name: 'description',
                    content: 'Balance Sheet'
                },
                {
                    property: 'og:description',
                    content: 'Balance Sheet'
                }
            ]
        }
    },

    //sales
    {
        path: '/accounting/reports/sales-by-customer',
        components: {
            default: SalesByCustomer,
        },
        meta: {
            title: 'Accounting Reports :: Sales by Customer',
            metaTags: [
                {
                    name: 'description',
                    content: 'Sales by Customer'
                },
                {
                    property: 'og:description',
                    content: 'Sales by Customer'
                }
            ]
        }
    },
    {
        path: '/accounting/reports/sales-by-item',
        components: {
            default: SalesByItem,
        },
        meta: {
            title: 'Accounting Reports :: Sales by Item',
            metaTags: [
                {
                    name: 'description',
                    content: 'Sales by Item'
                },
                {
                    property: 'og:description',
                    content: 'Sales by Item'
                }
            ]
        }
    },
    {
        path: '/accounting/reports/sales-by-salesperson',
        components: {
            default: SalesBySalesperson,
        },
        meta: {
            title: 'Accounting Reports :: Sales by Salesperson',
            metaTags: [
                {
                    name: 'description',
                    content: 'Sales by Salesperson'
                },
                {
                    property: 'og:description',
                    content: 'Sales by Salesperson'
                }
            ]
        }
    },

    //Receivables
    {
        path: '/accounting/reports/invoice-details',
        components: {
            default: InvoiceDetails,
        },
        meta: {
            title: 'Accounting Reports :: Invoice Details',
            metaTags: [
                {
                    name: 'description',
                    content: 'Invoice Details'
                },
                {
                    property: 'og:description',
                    content: 'Invoice Details'
                }
            ]
        }
    },
    {
        path: '/accounting/reports/retainer-invoice-details',
        components: {
            default: RetainerInvoiceDetails,
        },
        meta: {
            title: 'Accounting Reports :: Retainer Invoice Details',
            metaTags: [
                {
                    name: 'description',
                    content: 'Retainer Invoice Details'
                },
                {
                    property: 'og:description',
                    content: 'Retainer Invoice Details'
                }
            ]
        }
    },
    {
        path: '/accounting/reports/sales-order-details',
        components: {
            default: SalesOrderDetails,
        },
        meta: {
            title: 'Accounting Reports :: Sales Order Details',
            metaTags: [
                {
                    name: 'description',
                    content: 'Sales Order Details'
                },
                {
                    property: 'og:description',
                    content: 'Sales Order Details'
                }
            ]
        }
    },
    {
        path: '/accounting/reports/estimate-details',
        components: {
            default: EstimateDetails,
        },
        meta: {
            title: 'Accounting Reports :: Estimate Details',
            metaTags: [
                {
                    name: 'description',
                    content: 'Estimate Details'
                },
                {
                    property: 'og:description',
                    content: 'Estimate Details'
                }
            ]
        }
    },

    //Payments Received
    {
        path: '/accounting/reports/payments-received',
        components: {
            default: PaymentsReceived,
        },
        meta: {
            title: 'Accounting Reports :: Payments Received',
            metaTags: [
                {
                    name: 'description',
                    content: 'Payments Received'
                },
                {
                    property: 'og:description',
                    content: 'Payments Received'
                }
            ]
        }
    },
    {
        path: '/accounting/reports/credit-note-details',
        components: {
            default: CreditNoteDetails,
        },
        meta: {
            title: 'Accounting Reports :: Credit Note Details',
            metaTags: [
                {
                    name: 'description',
                    content: 'Credit Note Details'
                },
                {
                    property: 'og:description',
                    content: 'Credit Note Details'
                }
            ]
        }
    },

    //Recurring Invoices
    {
        path: '/accounting/reports/recurring-invoice-details',
        components: {
            default: RecurringInvoiceDetails,
        },
        meta: {
            title: 'Accounting Reports :: Credit Note Details',
            metaTags: [
                {
                    name: 'description',
                    content: 'Recurring Invoice Details'
                },
                {
                    property: 'og:description',
                    content: 'Recurring Invoice Details'
                }
            ]
        }
    },

    //Payables
    {
        path: '/accounting/reports/bills-details',
        components: {
            default: BillsDetails,
        },
        meta: {
            title: 'Accounting Reports :: Bills Details',
            metaTags: [
                {
                    name: 'description',
                    content: 'Bills Details'
                },
                {
                    property: 'og:description',
                    content: 'Bills Details'
                }
            ]
        }
    },
    {
        path: '/accounting/reports/vendor-credits-details',
        components: {
            default: VendorCreditsDetails,
        },
        meta: {
            title: 'Accounting Reports :: Vendor Credits Details',
            metaTags: [
                {
                    name: 'description',
                    content: 'Vendor Credits Details'
                },
                {
                    property: 'og:description',
                    content: 'Vendor Credits Details'
                }
            ]
        }
    },
    {
        path: '/accounting/reports/purchase-order-details',
        components: {
            default: PurchaseOrderDetails,
        },
        meta: {
            title: 'Accounting Reports :: Purchase Order Details',
            metaTags: [
                {
                    name: 'description',
                    content: 'Purchase Order Details'
                },
                {
                    property: 'og:description',
                    content: 'Purchase Order Details'
                }
            ]
        }
    },

    //Purchases and Expenses
    {
        path: '/accounting/reports/expense-details',
        components: {
            default: ExpenseDetails,
        },
        meta: {
            title: 'Accounting Reports :: Expense Details',
            metaTags: [
                {
                    name: 'description',
                    content: 'Expense Details'
                },
                {
                    property: 'og:description',
                    content: 'Expense Details'
                }
            ]
        }
    },

]

export default routes
