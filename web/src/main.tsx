import { createRoot } from 'react-dom/client'
import './index.css'
import { App } from './App.tsx'
import { QueryClientProvider } from '@tanstack/react-query'
import { client } from './lib/tanstack-client.ts'
import { BrowserRouter } from 'react-router-dom'

createRoot(document.getElementById('root')!).render(
  <BrowserRouter>
    <QueryClientProvider client={client}>
      <App />
    </QueryClientProvider>
  </BrowserRouter>
)
