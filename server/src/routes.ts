import { Router } from 'express'
import multer from 'multer'

const routes = Router()

import uploadConfigMiddleware from './middlewares/multerXLS'
import uploadMulterPDF from './middlewares/multerPDF'


const uploadXLS = multer(uploadConfigMiddleware)
const uploadPDF = multer(uploadMulterPDF)

import CieloController from './controllers/CieloController'
const INSSController = require('./controllers/INSSController')

routes.get('/', function (req, res) {
    //res.render('home', {layout: false});
    res.render('home');
});

routes.get('/inss', function (req, res) {
    if (req.query.sintetico === 'sim') {
        return res.render('inss', { sintetico: 'sim' });
    }
    return res.render('inss');
});

routes.post('/upload', uploadXLS.array('extratos'), CieloController.create)
routes.post('/upload/pdf', uploadPDF.single('pdf'), INSSController.processaArquivo)

export default routes