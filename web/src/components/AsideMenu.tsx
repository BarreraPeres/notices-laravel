import { Button, } from "@mui/material";

export function AsideMenu() {

    async function handleGetNotices() {
        try {
            window.location.href = "http://localhost:5173/notices"
        } catch (e) {
            console.log(e)
        }
    }

    return (
        <aside className="flex w-56 p-6">
            <nav
                className="flex flex-col text-zinc-300 text-sm font-semibold"
            >
                <div className="mb-6 w-[200px] bg-blue-600 h-[1px]"> </div>

                <Button
                    className="hover:text-blue-600"
                    variant="text"
                    onClick={handleGetNotices}
                >
                    Minhas Noticias
                </Button>

                <Button
                    className="hover:text-blue-600"
                    href=""
                    variant="text"
                >
                    Sair
                </Button>
            </nav>

        </aside>
    )
}