import { axiosClient } from "../../src/lib/axios-client"

export async function VerifyLoggedService(): Promise<boolean> {
    const res = await axiosClient.get("/verify/logged", {
        withCredentials: true
    })

    const { data } = res

    return data

}