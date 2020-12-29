import { Request } from 'express'
import multer from 'multer'
import path from 'path'

export default {
    storage: multer.diskStorage({
        destination: path.join(__dirname, '..', '..', 'uploads'),
        filename: (request: Request, file, cb) => {
            if (!file.originalname.match(/\.(xls|xlsx|csv)$/)) {
                cb(new Error( 'Por favor envie um arquivo do excel válido'), file.filename)
                return
            }

            const filename = `${Date.now()}-${file.originalname}`

            cb(null, filename);
        }
    })
}