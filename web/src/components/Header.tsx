import { Button } from "@mui/material"
import { Search } from "lucide-react"
import { LogoutService } from "../../http/services/logout-service"
import { useState } from "react";



export function Header() {
    const [isLoggingOut, setIsLoggingOut] = useState(false);

    async function handleLoggout() {
        try {
            setIsLoggingOut(true)
            localStorage.removeItem("accessToken")
            await LogoutService()//.then(res => res.message === "ok")
            window.location.href = "http://localhost:5173/login"
        } catch (e) {
            console.log(e)
        } finally {
            setIsLoggingOut(false)
        }
    }

    return (
        <header className="flex bg-slate-800 p-11 text-zinc-100 justify-between text-lg font-bold">
            Notices Laravel

            <div className="flex relative">
                <input
                    placeholder="Pesquisar"
                    className="flex bg-white p-2 pl-6 pr-24 rounded-md text-black text-sm items-start"
                >
                </input>

                <button className="flex justify-end absolute mt-1 ml-[277px]">
                    <Search className=" text-black " />
                </button>

            </div>


            <div className="flex gap-2 ">
                <div className="absolute right-32 -mt-8">
                    <img className="w-[100px] h-[100px] rounded-full object-cover"
                        src="https://placehold.co/100" />
                </div>

                <Button
                    onClick={handleLoggout}
                    variant="contained"
                >
                    {isLoggingOut ? "Saindo" : "Sair"}
                </Button>
            </div>
        </header>
    )
}