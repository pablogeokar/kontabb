import rateLimit from 'express-rate-limit'

import config from '../config/rateLimit.json'

const limiter = rateLimit({
    windowMs: config.minutes * 60 * 1000, // default 15 minutes
    max: config.max_requests, // Limit each IP to (default )100 requests per windowMS
    message: 'Too many connections from this ip, please try again after a minute'
})

export default limiter