<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <!-- <a class="navbar-brand" href="#">Fancy PDF-Generator</a> -->
    <a class="logo-link" href="/#/"><img class="logo" src="../assets/logo.svg" ></a>
    <!-- <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button> -->

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav">
        <li v-if="!showLoginStatus" class="nav-item">
          <router-link class="nav-link" to="login" active-class="active" exact>Einloggen</router-link>
        </li>
        <li v-if="!showLoginStatus" class="nav-item">
          <router-link class="nav-link" to="register" active-class="active" exact>Registrieren</router-link>
        </li>
        <li v-if="showLoginStatus" class="nav-item">
          <router-link class="nav-link" to="designcard" active-class="active" exact>Zum Editor</router-link>
        </li>
        <li v-if="showLoginStatus" class="nav-item">
          <a class="nav-link" href="#" @click="logout">Ausloggen</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="#">{{ showLoginStatus }}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" @click="testAuth">test auth</a>
        </li> -->
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
  display: flex;
  padding: 0.5rem 10%;
  
}

.navbar-nav {
    position: absolute;
    right: 10%;
}

.navbar-dark .navbar-nav .nav-link {
    color: white;
}

.nav-link {
	border-bottom: 2px solid rgb(1, 1, 1, 0);
}

.nav-link.router-link-exact-active, .nav-link:hover {
	border-bottom: 2px solid #42b883;
}

.nav-item {
  font-size: 18px;
}

.logo {
  margin: 10px 30px 10px 0;
  fill: white;
  width: 200px;
}
</style>