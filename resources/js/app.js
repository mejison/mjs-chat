import Echo from "laravel-echo"
import router from './router'
import store from './store'
import Vue from 'vue'
import VueCookie from 'vue-cookie'
import App from './App.vue'
import VeeValidate from 'vee-validate'
import Toasted from 'vue-toasted';

Vue.use(VeeValidate)
Vue.use(VueCookie)
Vue.use(Toasted)

window.Vue = require('vue')
window.axios = require('axios')
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
let token_csrf = document.head.querySelector('meta[name="csrf-token"]')

if (token_csrf) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token_csrf.content        
}

let token = VueCookie.get('token')
if (token) {    
    window.axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
}

window.io = require('socket.io-client')

window.Echo = new Echo({
    auth: {
        headers: {
            Authorization: `Bearer ${token}`,
        },
    },
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
})

new Vue({
    store,
    router,
    render: h => h(App),
}).$mount('#app')