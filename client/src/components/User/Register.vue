<template>
    <div class="row justify-content-center">
        <form class="col-4" v-on:submit.prevent="register">
            <h3>Register</h3>
            <div class="form-group">
                <label for="user-name">Benutzername:</label>
                <input type="name" class="form-control" v-model="name" id="user-name" required placeholder="Username">
            </div>
            <div class="form-group">
                <label for="user-email">E-Mail Addresse:</label>
                <input type="email" class="form-control" v-model="email" id="user-email" required aria-describedby="emailHelp" placeholder="E-Mail">
            </div>
            <div class="form-group">
                <label for="user-password">Passwort:</label>
                <input type="password" class="form-control" v-model="password" required id="user-password" placeholder="Password">
            </div><div class="form-group">
                <label for="user-password-confirmation">Passwort wiederholen:</label> 
                <input type="password" class="form-control" v-model="passwordConfirmation" required id="user-password-confirmation" placeholder="Confirm Password">
            </div>
            <button class="btn btn-primary form-button">Register</button>
            <router-link class="login-link" to="login" active-class="active" exact>Einloggen</router-link>
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
    .login-link {
        margin-left: 20px;
        color: white;
        text-transform: none;
        position: absolute;
        right: 100px;
        margin-top: 7px;
    }
    .login-link:hover {
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
            name: '',
            email: '',
            password: '',
            passwordConfirmation: ''
        }
    },
    created(){
        if(this.$store.getters.getLoginStatus){
            this.$router.push('/');
        }
    },
    methods: {
        register() {
            if(this.password === this.passwordConfirmation) {
                this.$store.commit('toggleLoadingState')
                axios.post('http://localhost/api/register', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.passwordConfirmation
                }).then(response  => {
                    console.log(response.data);
                    localStorage.setItem('token', response.data.token)
                    this.$store.commit('logUserIn')
                    console.log(this.$store.getters.getLoginStatus);
                    this.$store.commit('toggleLoadingState')
                    this.$router.push('/')
                }).catch(function(error) {
                    console.log(error);
                });
            }else {
                alert('The passwords don\'t match!')
            }
        }
    }
    
}
</script>