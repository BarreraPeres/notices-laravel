import { axiosClient } from "../../src/lib/axios-client"

interface VerifyLoggedServiceResponse {
    message: string
}

export async function VerifyLoggedService(): Promise<VerifyLoggedServiceResponse> {
    const res = await axiosClient.get("/verify/logged", {
        withCredentials: true
    })

    return {
        message: res.data.message
    }
}