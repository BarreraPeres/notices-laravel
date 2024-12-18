import { axiosClient } from "../../src/lib/axios-client"

interface RefreshTokenResponse {
    token: string
    user: Record<
        string,
        {
            id: number
            name: string
            email: string
            email_verified_at: string
            user_type: string
            created_at: Date
            updated_at: Date
        }
    >
}

export async function RefreshTokenService(): Promise<RefreshTokenResponse> {

    const res = await axiosClient.patch("/refresh/token", {
        withCredentials: true
    })

    const { token, user } = res.data

    return { token, user }

}