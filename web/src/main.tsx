import { createRoot } from 'react-dom/client'
import './index.css'
import { App } from './App.tsx'
import { QueryClientProvider } from '@tanstack/react-query'
import { client } from './lib/tanstack-client.ts'

createRoot(document.getElementById('root')!).render(
  <QueryClientProvider client={client}>
    <App />
  </QueryClientProvider>
)
