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
            <button class="btn btn-primary form-button">Login</button>
            <router-link class="nav-link register-link" to="register" active-class="active" exact>No Account? Register here</router-link>
        </form>
    </div>
</template>

<style>
    label {
        padding-top: 5px;
    }
    .form-control {
        display: inline-block;
        position: absolute;
        right: 0;
        width: 400px;
    }
    .register-link {
        margin-left: 20px;
        color: white;
        text-transform: none;
        position: absolute;
        right: 10%;
    }
    .register-link:hover {
        color: lightgrey;
        text-transform: none;
    }
    .form-button {
        position: absolute;
        right: 0;
    }
</style>

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