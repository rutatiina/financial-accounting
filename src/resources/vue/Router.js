import AccountingAdvancedRoutes from './components/l-limitless-bs4/advanced/Router'
import AccountingReportsRoutes from './components/l-limitless-bs4/reports/Router'

const AccountingDashboard = () => import('./components/l-limitless-bs4/Dashboard.vue')
const AccountingSideBarLeftDashboard = () => import('./components/l-limitless-bs4/SideBarLeftDashboard.vue')

let routes = [
    {
        path: '/financial-accounts/dashboard:parameters?',
        alias: '',
        components: {
            default: AccountingDashboard,
            'sidebar-left': AccountingSideBarLeftDashboard
            //'sidebar-right': ComponentSidebarRight
        },
        meta: {
            title: 'Accounting Dashboard',
            metaTags: [
                {
                    name: 'description',
                    content: 'Accounting Dashboard'
                },
                {
                    property: 'og:description',
                    content: 'Accounting Dashboard'
                }
            ]
        }
    }
];

routes = routes.concat(
    routes,
    AccountingAdvancedRoutes,
    AccountingReportsRoutes
);

export default routes
