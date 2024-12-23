import { axiosClient } from "../../src/lib/axios-client"

export type GetNoticesServiceResponse = {
    notices: {
        id: number,
        title: string,
        procedure: string,
        brief_description: string,
        author: string,
        generate_pop_up: boolean,
        pop_up_expiration: Date,
        description: string,
        notice_active: boolean,
        date_inactive: string,
        motive_inactive: string,
        created_at: string,
        updated_at: string
    }[],
    total: number
}

export async function GetNoticesService(): Promise<GetNoticesServiceResponse> {
    const res = await axiosClient.get("/notices", {
        withCredentials: true,
    })

    console.log("notices", res)
    const data = res.data.notices.data

    const { total } = res.data.notices
    console.log("total", total)

    return {
        notices: data,
        total
    }
}
