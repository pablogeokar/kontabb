import config from '../config/cors.json'

const corsOptions = {
    origin: function (origin, callback) {
        // Se a requisição de origem ou o caracter '*' estiver na whitelist então a barreira 
        // do cors permitirá prosseguir com o acesso
        if (config.whitelist.indexOf(origin) !== -1 || config.whitelist.indexOf('*') !== -1) {
            callback(null, true)
        } else {
            callback(new Error('Not allowed by CORS'))
        }
    }
}

export default corsOptions