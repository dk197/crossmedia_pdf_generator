<template>
    <div class="row justify-content-center">
        <form class="col-4" v-on:submit.prevent="login">
            <h3>Login</h3>
            <div class="form-group">
                <label for="user-email">Email address:</label>
                <input type="email" class="form-control" id="user-email" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="user-password">Password:</label>
                <input type="password" class="form-control" id="user-password" placeholder="Enter password">
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
            }).then(function (response) {
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });
        }
    }
}
</script>