import Vue from 'vue'
import Vuex from 'vuex'
import VueRouter from 'vue-router'
import App from './App.vue'
import { routes } from './routes'
import { store } from './store'

Vue.config.productionTip = false

Vue.use(Vuex)
Vue.use(VueRouter)

const router = new VueRouter({
    routes
})

new Vue({
    router,
    store,
    render: h => h(App),
}).$mount('#app')
