import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export const store = new Vuex.Store ({
    state: {
        isLoggeddIn: false
    },
    getters: {
        getLoginStatus(state) {
            return state.isLoggeddIn
        }
    },
    mutations: {
        logUserIn(state) {
            state.isLoggeddIn = true
        },
        logUserOut(state) {
            state.isLoggeddIn = false
        }
    }
})