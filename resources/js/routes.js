import React from 'react'
import { Navigate } from 'react-router-dom'
const Dashboard = React.lazy(() => import('./views/Dashboard'))
const ItemMaster = React.lazy(() => import('./views/master/ItemMaster'))

const routes = [
  {
    path: '/dashboard',
    exact: true,
    name: 'Dashboard',
    element: Dashboard,
  },
  {
    path: '/master/item',
    exact: true,
    name: 'Item Master',
    element: ItemMaster,
  },
]
export default routes
