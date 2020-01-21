import Vue from 'vue'
import Vuex from 'vuex'
import VueRouter from 'vue-router'
import App from './App.vue'
import { routes } from './routes'
import { store } from './store'
import VueChannelColorPicker from 'vue-channel-color-picker';

Vue.config.productionTip = false

Vue.use(Vuex)
Vue.use(VueRouter)
Vue.use(VueChannelColorPicker);

const router = new VueRouter({
    routes
})

new Vue({
    router,
    store,
    render: h => h(App),
}).$mount('#app')
