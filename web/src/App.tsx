import { Autocomplete, FormControlLabel, OutlinedInput, Switch, TextareaAutosize, TextField, } from '@mui/material'
import { useState } from 'react';

export function App() {
  const [checkedPopUp, setCheckedPopUp] = useState(true);


  return (

    <div className='flex justify-center  items-center '>
      <div className='flex flex-col items-start w-[1280px] gap-2  '>
        <h1 className='mt-4 font-bold '> Criação de Comunicado</h1>
        <h2 className="font-bold"> Operações</h2>
        <label>Selecione operações para carregar as respectivas carteiras: </label>
        <Autocomplete id=""
          fullWidth
          options={["1", "2", "3"]}
          renderInput={(params) => <TextField {...params} />} />
        <h2 className="font-bold"> Detalhes do Comunicado</h2>
        <OutlinedInput id=""
          fullWidth
          placeholder="insira um título para o comunicado" />
        <h2 className="font-bold"> Tipo do Usuário</h2>
        <Autocomplete id=""
          fullWidth
          options={["1", "2", "3"]}
          renderInput={(params) => <TextField {...params}
            placeholder='Selecione os tipos de usuário'
          />}
        />
        <h2 className="font-bold"> Tipo de Procedimento</h2>
        <Autocomplete id=""
          fullWidth
          options={["1", "2", "3"]}
          renderInput={(params) => <TextField {...params}
            placeholder='Selecione os tipos de procedimentos'
          />}
        />
        <h2 className="font-bold"> Conteúdo do Comunicado</h2>
        <TextareaAutosize
          className="w-[1280px] h-[350px] border-2 border-black rounded-md"
          maxRows={350}
          minRows={6}
          placeholder="Insira o texto do comunicado"
        >
        </TextareaAutosize >
        <h2 className="font-bold"> Breve Descrição</h2>
        <TextareaAutosize
          className="w-[1280px]  border-2 border-black rounded-md"
          maxRows={350}
          minRows={6}
          placeholder="Insira uma breve descrição para o comunicado"
        >
        </TextareaAutosize >

        <h2 className="font-bold"> O conteúdo irá gerar POP-UP? </h2>
        <FormControlLabel
          label={checkedPopUp ? 'Sim' : 'Não'}
          control={<Switch defaultChecked onChange={() => setCheckedPopUp(!checkedPopUp)} />}
        >
        </FormControlLabel>
      </div>

    </div >

  )
}

