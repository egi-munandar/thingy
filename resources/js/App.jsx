import React, { Suspense, useEffect } from "react";
import logo from "./logo.svg";
import "./App.css";
import axios from "axios";
import {BrowserRouter, Route, Routes} from 'react-router-dom'
import DefaultLayout from "./components/DefaultLayout";
import routes from "./routes";
import { useDispatch } from "react-redux";
import { login } from "./redux/authSlice";
const loading = (
    <div className="pt-3 text-center">
      <div className="sk-spinner sk-spinner-pulse"></div>
    </div>
  )
function App() {
    const dispatch = useDispatch()
    const logout = () => {
        axios
            .post("/logout")
            .then((d) => (window.location.href = "/login"))
            .catch((e) => console.log(e));
    };
    useEffect(() => {
        axios.get("/api/user").then((d) => dispatch(login(d.data)));
    }, [])

    return (
        <BrowserRouter>
            <Suspense fallback={loading}>
                <Routes>
                    <Route name="Home" element={<DefaultLayout />}>
                        {
                            routes.map((route, idx) => {
                                return (
                                    route.element && (
                                        <Route
                                            key={idx}
                                            path={route.path}
                                            exact={route.exact}
                                            name={route.name}
                                            element={<route.element />} />
                                    )
                                )
                            })
                        }
                    </Route>
                </Routes>
            </Suspense>
        </BrowserRouter>
    );
}

export default App;
