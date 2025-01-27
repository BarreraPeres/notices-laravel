import { useQuery } from "@tanstack/react-query";
import { GetNotificationsService } from "../../http/services/get-notifications-service";
import { AsideMenu } from "../components/AsideMenu";
import { Header } from "../components/Header";
import { NavBar } from "../components/NavBar";
export function Home() {

    const { data } = useQuery({
        queryKey: ["get notifications"],
        queryFn: GetNotificationsService,
        staleTime: 1000 * 60, //60  seconds
    })
    if (!data) {
        return <div>Carregando...</div>
    }

    return (
        <div>
            <Header />

            <NavBar />

            <main className="flex h-screen">

                <AsideMenu />

                <div className="flex flex-col w-[500px] h-full">
                    <h1 className="flex text-lg ml-20 mt-2"> Destaques </h1>
                    <div
                        className="
                                    grid 
                                    grid-cols-1
                                   bg-zinc-100 
                                    rounded-md
                                    ml-20
                                    p-2
                                    gap-2
                                    w-[600px]
                                    items-center
                                    justify-center">

                        {data.notifications.map((n) => {
                            return (
                                <div
                                    className="flex p-2 gap-2 "
                                    key={n.id}
                                >
                                    <div className=" h-[200px] w-[300px]">
                                        <img
                                            className="flex rounded-md"
                                            src="https://placehold.co/300x200"></img>
                                    </div>
                                    <div>
                                        <h1
                                            className="
                                            text-3xl 
                                            text-gray-700 
                                            font-bold
                                            items-center
                                            justify-center
                                            ">
                                            {n.title}
                                        </h1>
                                        <div
                                            className="
                                        flex items-center justify-center gap-2 mt-2
                                        ">
                                            <div
                                                className="
                                              bg-gray-600
                                                h-1
                                                w-1
                                                rounded-full
                                                "></div>
                                            <p
                                                className="
                                            text-gray-600 
                                            font-normal
                                            ">
                                                {n.alias}</p>

                                        </div>
                                    </div>
                                </div>
                            )
                        })}
                    </div>
                </div>


                <div className="flex flex-col ml-auto mr-24">
                    <h1
                        className="
                                flex
                                text-lg
                                p-2
                                ml-20 
                                mt-2 
                                bg-zinc-100 
                                rounded-md
                                -mb-2
                                ">
                        Útimas Notícias
                    </h1>
                    <div
                        className="
                                grid    
                                grid-cols-2
                                rounded-md
                              bg-zinc-100   
                                ml-20
                                p-2 
                                gap-2 
                                w-[300px]
                                items-center
                                justify-center">
                        {data.notifications.map((n) => {
                            return (
                                <div
                                    className="flex flex-col p-2 "
                                    key={n.id}
                                >
                                    <img
                                        className="flex rounded-md"
                                        src="https://placehold.co/100x100"></img>
                                    <h1>{n.title}</h1>
                                    <p>{n.alias}</p>
                                </div>
                            )
                        })}
                    </div>
                </div>
            </main >

        </div >
    )
}

