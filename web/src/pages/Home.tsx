import { Button } from "@mui/material";
import { LogoutService } from "../../http/services/logout-service"
export function Home() {


    async function handleGetNotices() {
        try {
            window.location.href = "http://localhost:5173/notices"
            // await axios.get("http://localhost:8000/api/notices", {
            //     // withCredentials: true,
            //     // headers: {
            //     //     Authorization: `Bearer ${token}`
            //     // }
            // }).then((res) => console.log(res))

        } catch (e) {
            console.log(e)
        }
    }


    async function handleLoggout() {
        try {
            localStorage.removeItem("accessToken")
            await LogoutService()//.then(res => res.message === "ok")
            window.location.href = "http://localhost:5173/login"
        } catch (e) {
            console.log(e)
        }
    }


    return (
        <div>Home

            <Button
                onClick={handleLoggout}
                variant="contained"
            >
                Sair
            </Button>

            <Button
                onClick={handleGetNotices}
            > Minhas Noticias</Button>



        </div >
    )
}

