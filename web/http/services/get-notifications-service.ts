import { axiosClient } from "../../src/lib/axios-client"

export type GetNotificationsServiceResponse = {
    notifications: {
        id: number,
        id_notice: number,
        created_at: Date,
        updated_at: Date,
        title: string,
        alias: string,
    }[],
}

export async function GetNotificationsService(): Promise<GetNotificationsServiceResponse> {
    const res = await axiosClient.get("/notifications", {
        withCredentials: true,
    })

    console.log("notifications", res)

    const data = res.data.notifications.data
    console.log("data", data)
    return {
        notifications: data,
    }
}
