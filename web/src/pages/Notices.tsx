import { useQuery } from "@tanstack/react-query"
import { GetNoticesService } from "../../http/services/get-notice-service"
import { Button, Paper, Switch, Table, TableBody, TableCell, TableContainer, TableHead, TableRow } from "@mui/material"
export function Notices() {

    const { data } = useQuery({
        queryKey: ["get notices"],
        queryFn: GetNoticesService,
        staleTime: 1000 * 60, //60  seconds
    })

    if (!data) {
        return null
    }

    interface Column {
        id: string;
        format?: (value: number) => string;
    }


    const colunms: Column[] = [
        { id: '🔃', },
        { id: 'Título', },
        { id: 'Publição', },
        { id: 'Publicado?', },
        { id: 'Data Limite do POP-UP', },
        { id: 'Editar', },
        { id: 'Ativo?', },
        { id: 'Data da inativação' },
        { id: 'Motivo da inativação' },
        { id: 'Republicar', },
    ]


    console.log("salve", data)
    return (
        <div className="overflow-hidden max-w-full ">
            <Paper
            //  style={{ width: "100%" }}
            >
                <TableContainer>
                    <Table stickyHeader aria-label="sticky table"
                        size="small"
                    >
                        <TableHead>
                            <TableRow
                            >
                                {colunms.map((col) => (
                                    <TableCell
                                        key={col.id}
                                        onClick={() => {
                                            //handleSortChange(col.id)
                                        }}
                                        align="center"

                                    >
                                        {col.id}
                                    </TableCell>
                                ))}
                            </TableRow>
                        </TableHead>
                        <TableBody>
                            {
                                data.notices.map((n) => {
                                    return (
                                        <TableRow
                                            hover role="checkbox"
                                            tabIndex={-1}
                                            key={n.id}
                                        >

                                            <TableCell
                                                align="center"
                                                scope="row"
                                                key={n.id}
                                            >
                                                {
                                                    n.id
                                                }
                                            </TableCell>

                                            <TableCell
                                                align="center"
                                                key={n.id}
                                            >
                                                {
                                                    n.title
                                                }
                                            </TableCell>

                                            <TableCell

                                                align="center"
                                                key={n.id}
                                            >
                                                {
                                                    n.created_at
                                                }
                                            </TableCell>

                                            <TableCell

                                                align="center"
                                                key={n.id}
                                            >
                                                Sim
                                                {/* // here i need to get if status of notification exists, so is TRUE(published) or FALSE(not published) */}
                                            </TableCell>
                                            <TableCell

                                                align="center"
                                                key={n.id}
                                            >
                                                {
                                                    n.pop_up_expiration.toString()
                                                }
                                            </TableCell>
                                            <TableCell

                                                align="center"
                                                key={n.id}
                                            >
                                                <Button> Editar </Button>
                                            </TableCell>
                                            <TableCell

                                                align="center"
                                                key={n.id}
                                            >

                                                <Switch></Switch>

                                            </TableCell>
                                            <TableCell

                                                align="center"
                                                key={n.id}
                                            >
                                                {
                                                    n.date_inactive
                                                }
                                            </TableCell>
                                            <TableCell

                                                align="center"
                                                key={n.id}
                                            >
                                                {
                                                    n.motive_inactive
                                                }
                                            </TableCell>
                                            <TableCell

                                                align="center"
                                                key={n.id}
                                            >
                                                <Button> Republicar </Button>
                                            </TableCell>

                                        </TableRow>
                                    )
                                })
                            }
                        </TableBody>
                    </Table>
                </TableContainer>
            </Paper >

            <div className="flex flex-1 p-5 justify-between">
                <span className="text-lg font-bold"> Total De Registros: {data.total} </span>

                <div className="flex ">
                    <Button> Primeira
                    </Button>
                    <Button> Anterior
                    </Button>
                    <Button> Próxima </Button>
                </div>
            </div>
        </div >
    )

}