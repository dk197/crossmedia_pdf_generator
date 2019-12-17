<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <!-- <a class="navbar-brand" href="#">Fancy PDF-Generator</a> -->
    <img src="../assets/logo.svg" class="logo">
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <router-link class="nav-link" to="/" active-class="active" exact>Home</router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link" to="login" active-class="active" exact>Login</router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link" to="register" active-class="active" exact>Register</router-link>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" @click="logout">Logout</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">{{ showLoginStatus }}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" @click="testAuth">test auth</a>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
import axios from 'axios'
export default {
    computed: {
        showLoginStatus() {
            return this.$store.getters.getLoginStatus
        }
    },
    methods: {
        logout() {
            localStorage.removeItem("token");
            this.$store.commit("logUserOut");
            this.$router.push("/");
        },
        testAuth() {
            axios.get('http://localhost:80/api/secured', { 
                    headers: {
                        Authorization: 'Bearer ' + localStorage.getItem('token')
                    }
                }).then(response => {
                    // If request is good...
                    console.log(response.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        }
    }
};
</script>

<style>
.navbar {
  border-bottom: 1px solid grey;
}

.logo{
  margin-right: 30px;
  fill: white;
}
</style>