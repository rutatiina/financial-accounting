
//Import Routes
import AccountsRoutes from './accounts/Router'
import JournalsRoutes from './journals/Router'

let routes = []

routes = routes.concat(
    routes,
    JournalsRoutes,
    AccountsRoutes
)

export default routes
