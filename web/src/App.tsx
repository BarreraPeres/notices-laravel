import { Navigate, Outlet, Route, Routes } from "react-router-dom";
import { Login } from "./pages/Login";
import { Home } from "./pages/Home";
import { CreateNotice } from "./pages/CreateNotice";
import { useQuery } from "@tanstack/react-query";
import { VerifyLoggedService } from "../http/services/verify-logged-service";
import { setupAxiosInterceptors } from "./lib/axios-client";
import { Notices } from "./pages/Notices";
import { useEffect } from "react";

export function App() {

  useEffect(() => {
    setupAxiosInterceptors()
  }, [])

  const { data, isLoading } = useQuery({
    queryKey: ["verify if user logged"],
    queryFn: VerifyLoggedService
  })

  const PrivateRoute = () => {
    if (isLoading) {
      return <div>Loading...</div>
    }

    const isAuthenticated = data

    return isAuthenticated ? <Outlet /> : <Navigate to="/login" />
  }

  return (
    <>
      <Routes>
        <Route path="/login" element={<Login />}></Route>

        <Route path="/" element={<PrivateRoute />} >
          <Route path="/home" element={<Home />}></Route>
          <Route path="/create-notice" element={<CreateNotice />}></Route>
          <Route path="/notices" element={<Notices />}></Route>
        </Route>
      </Routes >
    </>
  )
}

