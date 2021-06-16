

const Index = () => import('./Index')
const Form = () => import('./Form')


const routes = [
    {
        path: '/financial-accounts:parameters?',
        components: {
            default: Index
        },
        meta: {
            title: 'Accounting Chats Of Accounts',
            metaTags: [
                {
                    name: 'description',
                    content: 'Accounting Chats Of Accounts'
                },
                {
                    property: 'og:description',
                    content: 'Accounting Chats Of Accounts'
                }
            ]
        }
    },
    {
        path: '/financial-accounts/create',
        components: {
            default: Form
        },
        meta: {
            title: 'Accounting :: Advanced :: Account :: Create',
            metaTags: [
                {
                    name: 'description',
                    content: 'Create Account'
                },
                {
                    property: 'og:description',
                    content: 'Create Account'
                }
            ]
        }
    },
    {
        path: '/financial-accounts/:id/edit',
        components: {
            default: Form
        },
        meta: {
            title: 'Accounting :: Advanced :: Account :: Edit',
            metaTags: [
                {
                    name: 'description',
                    content: 'Edit Account'
                },
                {
                    property: 'og:description',
                    content: 'Edit Account'
                }
            ]
        }
    }

]

export default routes
