import React from 'react'
import AppSidebar from './AppSidebar'

export default function DefaultLayout() {
  return (
    <div>
        <div>
            <AppSidebar />
            <div className="wrapper d-flex flex-column min-vh-100 bg-light">
                {/* <AppHeader /> */}
                <div className="body flex-grow-1 px-3">
                    {/* <AppContent /> */}
                </div>
                {/* <AppFooter /> */}
            </div>
        </div>
    </div>
  )
}
