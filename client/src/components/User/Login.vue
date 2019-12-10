<template>
    <div class="row justify-content-center">
        <form class="col-4" v-on:submit.prevent="login">
            <h3>Login</h3>
            <div class="form-group">
                <label for="user-email">Email address:</label>
                <input type="email" class="form-control" v-model="email" id="user-email" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="user-password">Password:</label>
                <input type="password" class="form-control" v-model="password" id="user-password" placeholder="Enter password">
            </div>
            <button class="btn btn-primary">Login</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {
            email: '',
            password: ''
        }
    },
    methods: {
        login() {
            axios.post('http://localhost/api/login', {
                email: this.email,
                password: this.password
            }).then(response  => {
                console.log(response.data);
                localStorage.setItem('token', response.data.token)
                this.$store.commit('logUserIn')
                console.log(this.$store.getters.getLoginStatus);
                this.$router.push('/')
            }).catch(function(error) {
                console.log(error);
            });
        }
    }
}
</script>