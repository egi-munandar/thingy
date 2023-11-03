import { CNavItem } from '@coreui/react'
import { faBoxes, faDashboard } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'

export const _nav = [
  {
    component: CNavItem,
    name: 'Dashboard',
    to: '/dashboard',
    perms: [],
    icon: <FontAwesomeIcon icon={faDashboard} className="nav-icon" />,
  },
  {
    component: CNavItem,
    name: 'Item Master',
    to: '/master/item',
    perms: [],
    icon: <FontAwesomeIcon icon={faBoxes} className="nav-icon" />,
  },
]
export default _nav
