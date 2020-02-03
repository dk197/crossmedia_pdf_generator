<template>
    <div class="row">
        <p class="col-12">VCard bearbeiten</p>
        <div class="col-12">
            <div class="form-group">
                <label for="vcard-name">Name</label>
                <input type="text" v-model="vname" class="form-control" id="vcard-name" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="vcard-position">Position</label>
                <input type="text" v-model="vposition" class="form-control" id="vcard-position" placeholder="Position">
            </div>
            <div class="form-group">
                <label for="vcard-firma">Firma</label>
                <input type="text" v-model="vfirma" class="form-control" id="vcard-firma" placeholder="Firma">
            </div>
            <div class="form-group">
                <label for="vcard-adresse">Adresse</label>
                <input type="text" v-model="vadresse" class="form-control" id="vcard-adresse" placeholder="Adresse">
            </div>
            <div class="form-group">
                <label for="vcard-telefon-privat">Telefon privat</label>
                <input type="text" v-model="vtelefon_privat" class="form-control" id="vcard-telefon-privat" placeholder="Telefon privat">
            </div>
            <div class="form-group">
                <label for="vcard-telefon-geschaeftlich">Telefon geschäftlich</label>
                <input type="text" v-model="vtelefon_geschaeftlich" class="form-control" id="vcard-telefon-geschaeftlich" placeholder="Telefon geschäftlich">
            </div>
            <div class="form-group">
                <label for="vcard-email">Email</label>
                <input type="text" v-model="vemail" class="form-control" id="vcard-email" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="vcard-website">Webseite</label>
                <input type="text" v-model="vwebseite" class="form-control" id="vcard-website" placeholder="Webseite">
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {
            vname: '', 
            vposition: '',
            vfirma: '',
            vadresse: '',
            vtelefon_privat: '',
            vtelefon_geschaeftlich: '',
            vemail: '',
            vwebseite: ''
        }
    },
    mounted() {
        this.getVCard()
    },
    methods: {
        getVCard() {
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