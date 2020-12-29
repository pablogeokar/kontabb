import { Router } from 'express'
import multer from 'multer'

const routes = Router()

import uploadConfigMiddleware from './middlewares/multer'
const upload = multer(uploadConfigMiddleware)

import CieloController from './controllers/CieloController'

routes.get('/', (req, res) => {
    return res.json({ active: true })
})

routes.post('/upload', upload.array('extratos'), CieloController.create)

export default routes