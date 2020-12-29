import express from 'express'
import cors from 'cors'
import path from 'path'
import morgan from 'morgan'
import helmet from 'helmet'

import routes from './routes'
import corsOptions from './middlewares/cors'
import limiter from './middlewares/rateLimit'

const app = express()

app.use(morgan('common'))
app.use(helmet())
app.use(cors(corsOptions))
app.use(limiter)
app.use(express.json())
app.use(routes)
app.use('/uploads', express.static(path.resolve(__dirname, '..', 'uploads')))

app.listen(3333)