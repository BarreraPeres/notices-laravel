import { axiosClient } from "../../src/lib/axios-client";

interface LogoutServiceResponse {
    message: string
}


export async function LogoutService(): Promise<LogoutServiceResponse> {
    const res = await axiosClient.post("/logout", {
        withCredentials: true
    })

    const { message } = res.data

    return {
        message
    }

}