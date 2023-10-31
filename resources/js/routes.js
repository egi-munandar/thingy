import React from 'react'
const Dashboard = React.lazy(() => import('./views/Dashboard'))

const routes = [
    {
        path: '/', exact: true, name: 'Home'
    },
    {
        path: '/dashboard', exact: true, name: 'Dashboard', element: Dashboard
    },
]
export default routes;
