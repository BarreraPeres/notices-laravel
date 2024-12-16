import { axiosClient } from "../../src/lib/axios-client"

export interface LoginBody {
    email: string
    password: string

}

interface LoginRes {
    token: string,
    user: Record<
        string,
        {
            user: string
            created_at: Date
            email: string
            email_verified_at: Date
            id: number
            name: string
            updated_at: Date
            user_type: string
        }>,
    status: number
}

export async function LoginService({
    email,
    password
}: LoginBody): Promise<LoginRes> {
    const res = await axiosClient.post("/login", {
        email,
        password
    }, {
        withCredentials: true
    })

    return {
        token: res.data.token,
        user: res.data.user,
        status: res.status
    }
}