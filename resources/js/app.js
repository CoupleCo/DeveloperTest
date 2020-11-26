
require('./bootstrap')

window.Vue = require('vue')

import Router from 'vue-router'
import routes from './routes'

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
)

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
)

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
)

Vue.use(Router)

let app = new Vue({
    el: '#app',

    router: routes
})
