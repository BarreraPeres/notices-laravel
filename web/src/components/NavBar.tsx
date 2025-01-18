import { Button } from "@mui/material"
import { HomeIcon } from "lucide-react"

export function NavBar() {
    return (
        <nav className="flex ml-72 items-start  p-2 gap-2">
            <Button
                className="flex gap-2"
                variant="contained"
            >
                Home
                <HomeIcon />

            </Button>
            <Button
                variant="outlined"
            >
                Sociedade
            </Button>
            <Button
                variant="outlined"
            >
                Técnologia
            </Button>
            <Button
                variant="outlined"
            >
                Música
            </Button>

        </nav>

    )
}