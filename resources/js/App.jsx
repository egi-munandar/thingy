import React, { Suspense, useEffect } from 'react'
import logo from './logo.svg'
import './App.css'
import axios from 'axios'
import { BrowserRouter, Navigate, Route, Routes } from 'react-router-dom'
import DefaultLayout from './components/DefaultLayout'
import routes from './routes'
import { useDispatch, useSelector } from 'react-redux'
import { login } from './redux/authSlice'
const loading = (
  <div className="pt-3 text-center">
    <div className="sk-spinner sk-spinner-pulse"></div>
  </div>
)
function App() {
  const auth = useSelector((s) => s.auth)
  const dispatch = useDispatch()
  useEffect(() => {
    axios.get('/api/user').then((d) => dispatch(login(d.data)))
  }, [])

  return (
    <BrowserRouter>
      <Suspense fallback={loading}>
        <Routes>
          <Route name="Home" path="*" element={<DefaultLayout />}>
            {/* {routes.map((route, idx) => {
              return (
                route.element && (
                  <Route
                    key={idx}
                    path={route.path}
                    exact={route.exact}
                    name={route.name}
                    element={<route.element />}
                  />
                )
              )
            })} */}
          </Route>
          {/* <Route path="/*" element={<Navigate to="/dashboard" />} /> */}
        </Routes>
      </Suspense>
    </BrowserRouter>
  )
}

export default App
