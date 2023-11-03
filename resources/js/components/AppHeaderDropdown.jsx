import {
  CAvatar,
  CDropdown,
  CDropdownHeader,
  CDropdownItem,
  CDropdownMenu,
  CDropdownToggle,
} from '@coreui/react'
import { faLock } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import axios from 'axios'
import React from 'react'
import { useSelector } from 'react-redux'
import { toast } from 'react-toastify'

export default function AppHeaderDropdown() {
  const auth = useSelector((s) => s.auth)
  const submitLogout = () => {
    axios.post('/logout').then(() => {
      toast.success('Logout Success!')
      setTimeout(() => {
        window.location.href = '/login'
      }, 100)
    })
  }
  return (
    <CDropdown variant="nav-item">
      <CDropdownToggle placement="bottom-end" className="py-0" caret={false}>
        <CAvatar src="https://picsum.photos/64/64" size="md" />
      </CDropdownToggle>
      <CDropdownMenu className="pt-0" placement="bottom-end">
        <CDropdownHeader className="bg-light fw-semibold py-2">
          {auth.loggedIn ? auth.user.name : ''}
        </CDropdownHeader>
        <CDropdownItem onClick={submitLogout} href="#">
          <FontAwesomeIcon icon={faLock} className="me-2" />
          Logout
        </CDropdownItem>
      </CDropdownMenu>
    </CDropdown>
  )
}
