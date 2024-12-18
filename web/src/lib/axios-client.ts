import axios, { AxiosError } from "axios";
import { RefreshTokenService } from "../../http/services/refresh-token-service"

export const axiosClient = axios.create({
    baseURL: "http://localhost:8000/api",
    headers: {
        'Content-Type': 'application/json',
    },
    withCredentials: true
})

export function setupAxiosInterceptors() {
    // Add a request interceptor

    axiosClient.interceptors.request.use(
        async (config) => {

            const accessToken = localStorage.getItem("accessToken")
            if (accessToken) {
                config.headers.Authorization = `Bearer ${accessToken}`
            }

            return config;
        },
        (error) => {
            console.error(error)
        }
    )

    // Add a response interceptor
    axiosClient.interceptors.response.use(
        (response) => response,
        async (error: AxiosError) => {
            if (error.response?.status === 401 && error.config) {
                const originalConfig = error.config

                const { token } = await RefreshTokenService()
                localStorage.setItem("accessToken", token)
                axios.defaults.headers.common["Authorization"] = `Bearer ${token}`

                return axiosClient(originalConfig)
            }

            return Promise.reject(error)
        })
}