import { Router } from 'express'

const routes = Router()

routes.get('/', (req, res) => {
    return res.json({ active: true })
})

export default routes