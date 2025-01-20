import { axiosClient } from "../../src/lib/axios-client"

export interface CreateNoticeBody {
    user_type: string
    title: string
    description: string
    author: string
    procedure: string
    brief_description: string
}

export async function CreateNoticeService({
    user_type,
    title,
    description,
    author,
    procedure,
    brief_description,
}: CreateNoticeBody) {
    await axiosClient.post("/api/notices", {
        user_type,
        title,
        description,
        author,
        procedure,
        brief_description,
    })
}