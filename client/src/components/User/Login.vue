<template>
    <div class="row justify-content-center">
        <form class="col-4" v-on:submit.prevent="login">
            <h3>Login</h3>
            <div class="form-group">
                <label for="user-email">E-Mail Adresse:</label>
                <input type="email" class="form-control" v-model="email" required id="user-email" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="user-password">Passwort:</label>
                <input type="password" class="form-control" v-model="password" required id="user-password" placeholder="Enter password">
            </div>
            <button class="btn btn-primary form-button">Einloggen</button>
            <router-link class="register-link" to="register" active-class="active" exact>Registrieren</router-link>
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
    created(){
        if(this.$store.getters.getLoginStatus){
            this.$router.push('/');
        }
    },
    methods: {
        login() {
            this.$store.commit('toggleLoadingState')
            axios.post('http://localhost/api/login', {
                email: this.email,
                password: this.password
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
        }
    }
}
</script>

<style scoped>
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
        right: 120px;
        margin-top:7px
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