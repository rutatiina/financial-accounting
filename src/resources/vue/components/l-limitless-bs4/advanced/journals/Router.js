
const AccountingAdvancedJournals = () => import('./Index')
const AccountingAdvancedJournalsForm = () => import('./Form')
const AccountingAdvancedJournalsShow = () => import('./Show')
const AccountingAdvancedJournalsSideBarLeft = () => import('./SideBarLeft')

const routes = [

    {
        path: '/financial-accounts/advanced/journals',
        components: {
            default: AccountingAdvancedJournals,
            //'sidebar-left': ComponentSidebarLeft,
            //'sidebar-right': ComponentSidebarRight
        },
        meta: {
            title: 'Accounting :: Advanced :: Journals',
            metaTags: [
                {
                    name: 'description',
                    content: 'Journals'
                },
                {
                    property: 'og:description',
                    content: 'Journals'
                }
            ]
        }
    },
    {
        path: '/financial-accounts/advanced/journals/create',
        components: {
            default: AccountingAdvancedJournalsForm,
            //'sidebar-left': ComponentSidebarLeft,
            //'sidebar-right': ComponentSidebarRight
        },
        meta: {
            title: 'Accounting :: Advanced :: Journals :: Create',
            metaTags: [
                {
                    name: 'description',
                    content: 'Create Journals'
                },
                {
                    property: 'og:description',
                    content: 'Create Journals'
                }
            ]
        }
    },
    {
        path: '/financial-accounts/advanced/journals/:id',
        components: {
            default: AccountingAdvancedJournalsShow,
            'sidebar-left': AccountingAdvancedJournalsSideBarLeft
        },
        meta: {
            title: 'Accounting :: Advanced :: Journals',
            metaTags: [
                {
                    name: 'description',
                    content: 'Journal'
                },
                {
                    property: 'og:description',
                    content: 'Journal'
                }
            ]
        }
    },
    {
        path: '/financial-accounts/advanced/journals/:id/copy',
        components: {
            default: AccountingAdvancedJournalsForm,
        },
        meta: {
            title: 'Accounting :: Advanced :: Journals :: Copy',
            metaTags: [
                {
                    name: 'description',
                    content: 'Copy Estimate'
                },
                {
                    property: 'og:description',
                    content: 'Copy Estimate'
                }
            ]
        }
    },
    {
        path: '/financial-accounts/advanced/journals/:id/edit',
        components: {
            default: AccountingAdvancedJournalsForm,
        },
        meta: {
            title: 'Accounting :: Advanced :: Journals :: Edit',
            metaTags: [
                {
                    name: 'description',
                    content: 'Edit Journals'
                },
                {
                    property: 'og:description',
                    content: 'Edit Journals'
                }
            ]
        }
    }

]

export default routes
