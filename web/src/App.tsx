import { Navigate, Outlet, Route, Routes, useNavigate } from "react-router-dom";
import { Login } from "./pages/Login";
import { Home } from "./pages/Home";
import { CreateNotice } from "./pages/CreateNotice";
import { useQuery } from "@tanstack/react-query";
import { VerifyLoggedService } from "../http/services/verify-logged-service";
import { setupAxiosInterceptors } from "./lib/axios-client";
import { useEffect } from "react";
import { Notices } from "./pages/Notices";

export function App() {
  const navigate = useNavigate()

  useEffect(() => {
    setupAxiosInterceptors()
  }, [])

  function login(permitted: boolean) {
    console.log("permitted", permitted)
    if (permitted === true) {
      navigate("/home")
    }
  }

  const { data, isLoading } = useQuery({
    queryKey: ["verify if user logged"],
    queryFn: VerifyLoggedService
  })

  const PrivateRoute = () => {
    if (isLoading) {
      return <div>Loading...</div>
    }

    console.log("data!.message", data!.message)

    const user = data!.message
    console.log("user", user)

    return user === "User logged" ? <Outlet /> : <Navigate to="/login" />
  }

  return (
    <>
      <Routes>
        <Route path="/login" element={<Login permitted={login} />}></Route>

        <Route path="/" element={<PrivateRoute />} >
          <Route path="/home" element={<Home />}></Route>
          <Route path="/create-notice" element={<CreateNotice />}></Route>
          <Route path="/notices" element={<Notices />}></Route>
        </Route>
      </Routes >
    </>
  )
}

