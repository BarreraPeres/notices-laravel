import { zodResolver } from "@hookform/resolvers/zod";
import { OutlinedInput } from "@mui/material";
import { useForm } from "react-hook-form";
import { z } from "zod";
import { Button } from "@mui/material";
import { LoginService } from "../../http/services/login-service"

interface LoginProps {
    permitted: (p: boolean) => void
}
export function Login({ permitted }: LoginProps) {

    const loginForm = z.object({
        email: z.string(),
        password: z.string()
    })

    type loginType = z.infer<typeof loginForm>

    const { handleSubmit, register } = useForm<loginType>({
        resolver: zodResolver(loginForm)
    })

    async function handleLogin({ email, password }: loginType) {
        try {
            const data = await LoginService({
                email,
                password
            })
            if (data) {
                permitted(true)
                localStorage.setItem("accessToken", data.token)
            }
        } catch (e) {
            alert("Dados Inválidos")
            console.log(e)
        }
    }


    return (
        <div className="flex flex-col items-center mt-10 h-screen">
            <h1 className="text-4xl font-mono text-blue-500/100">Notices Laravel</h1>
            <h2 className="font-mono ">Acesse Nosso Site De Notícias</h2>
            <div className="flex flex-col gap-4 h-[300px] w-[500px] mt-10">
                <form className="gap-4 flex flex-col"
                    onSubmit={handleSubmit(handleLogin)}
                >
                    <OutlinedInput
                        fullWidth
                        id="email"
                        type="email"
                        autoComplete="email"
                        required
                        placeholder="Email"
                        {...register('email')} />
                    <OutlinedInput
                        id="password"
                        required
                        placeholder="Password"
                        type="password"
                        {...register('password')} />
                    <br />
                    <div className="flex inset-y-0 justify-center -mt-4 h-[50px] ">
                        <Button fullWidth type="submit" variant="contained">Entrar</Button>
                    </div>

                    <a href="http://localhost:5173/register"> Não tem conta? </ a>
                </form>
            </div>
        </div >

    )
}

