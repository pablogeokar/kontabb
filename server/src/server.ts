import express from 'express'
import cors from 'cors'
import path from 'path'
import morgan from 'morgan'
import helmet from 'helmet'
import handlebars from 'express-handlebars'

import routes from './routes'
import corsOptions from './middlewares/cors'
import limiter from './middlewares/rateLimit'

const app = express()

// VIEWS
app.engine('.html', handlebars({ extname: '.html' }));
app.set('view engine', '.html');
app.set('views', path.join(__dirname, 'views/'))

// MIDDLEWARES
app.use(morgan('common'))
app.use(helmet())
app.use(cors(corsOptions))
app.use(limiter)
app.use(express.json())
app.use(express.urlencoded({ extended: false }))
app.use(routes)
app.use('/uploads', express.static(path.resolve(__dirname, '..', 'uploads')))
app.use('/assets', express.static(path.resolve(__dirname, '..', 'assets')))
app.use('/public', express.static(path.resolve(__dirname, '..', 'public')))

app.listen(3333)