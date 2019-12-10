import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export const store = new Vuex.Store ({
    state: {
        isLoggeddIn: false,
        isLoading: false
    },
    getters: {
        getLoginStatus(state) {
            return state.isLoggeddIn
        },
        getLoadingState(state){
            return state.isLoading
        }
    },
    mutations: {
        logUserIn(state) {
            state.isLoggeddIn = true
        },
        logUserOut(state) {
            state.isLoggeddIn = false
        },
        toggleLoadingState(state){
            state.isLoading = !state.isLoading
        }
    }
})