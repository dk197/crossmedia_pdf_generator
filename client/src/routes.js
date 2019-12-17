import Home from './components/Home.vue'
import Login from './components/User/Login.vue'
import Register from './components/User/Register.vue'
import Test from './components/Test.vue'
import DesignCard from './components/DesignCard.vue'

export const routes = [
    {
        path: '',
        component: Home
    },
    {
        path: '/login',
        component: Login
    },
    {
        path: '/register',
        component: Register
    },
    {
        path: '/test',
        component: Test
    },
    {
        path: '/designcard',
        component: DesignCard
    }
]