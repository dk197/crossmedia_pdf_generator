<template>
    <div class="row wrapper">
        <div class="col-10">
            <div class="row">
                <h3 class="col-12">Dynamische VCards:</h3>
                <p class="col-12" v-if="vcards.length === 0">
                    Bisher wurden noch keine dynamischen VCards erstellt
                </p>
                <div class="col-12" v-else>
                    <table class="table table-dark" style="width:100%">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Position</th>
                            <th scope="col">Firma</th>
                            <th scope="col">Adresse</th>
                            <th scope="col">Telefon privat</th>
                            <th scope="col">Telefon geschäftlich</th>
                            <th scope="col">Email</th>
                            <th scope="col">Webseite</th>
                            <th scope="col"></th>
                        </tr>
                        <tr v-for="(vcard, index) in vcards" :key="index">
                            <td>
                                <input type="text" v-if="edit" v-model="vcard.name">
                                <span v-else>{{ vcard.name }}</span>
                            </td>
                            <td>
                                <input type="text" v-if="edit" v-model="vcard.position">
                                <span v-else>{{ vcard.position }}</span>
                            </td>
                            <td>
                                <input type="text" v-if="edit" v-model="vcard.firma">
                                <span v-else>{{ vcard.firma }}</span>
                            </td>
                            <td>
                                <input type="text" v-if="edit" v-model="vcard.adresse">
                                <span v-else>{{ vcard.adresse }}</span>
                            </td>
                            <td>
                                <input type="text" v-if="edit" v-model="vcard.telefon_privat">
                                <span v-else>{{ vcard.telefon_privat }}</span>
                            </td>
                            <td>
                                <input type="text" v-if="edit" v-model="vcard.telefon_geschaeftlich">
                                <span v-else>{{ vcard.telefon_geschaeftlich }}</span>
                            </td>
                            <td>
                                <input type="text" v-if="edit" v-model="vcard.email">
                                <span v-else>{{ vcard.email }}</span>
                            </td>
                            <td>
                                <input type="text" v-if="edit" v-model="vcard.webseite">
                                <span v-else>{{ vcard.webseite }}</span>
                            </td>
                            <td>
                                <button class="btn btn-primary" @click="handler(index)">{{ buttonText }}</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {
            vcards: [],
            edit: false,
            buttonText: 'Bearbeiten'
        }
    },
    mounted() {
        this.getUsersVCards()
    },
    methods: {
        getUsersVCards() {
            this.$store.commit('toggleLoadingState')
            axios.get('http://localhost/api/secured/getvcards', {
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('token')
                }
            }).then(response  => {
                console.log(response.data);
                console.log(response.data.length);
                if(response.data.length === 0) {
                    console.log('test');
                }else {
                    this.vcards = response.data
                }
                this.$store.commit('toggleLoadingState')
            }).catch(function(error) {
                console.log(error);
            });
        },
        handler(index) {
            console.log(index);
            // edit mode is active -> submit form
            if(this.edit) {
                // this.$store.commit('toggleLoadingState')

                const vcard = this.vcards[index]
                const inputData = {
                    name: vcard.name,
                    position: vcard.position,
                    firma: vcard.firma,
                    adresse: vcard.adresse,
                    telefon_privat: vcard.telefon_privat,
                    telefon_geschaeftlich: vcard.telefon_geschaeftlich,
                    email: vcard.email,
                    webseite: vcard.webseite
                }

                axios.post('http://localhost/api/secured/editvcard/', inputData, {
                    headers: {
                        Authorization: 'Bearer ' + localStorage.getItem('token')
                    }
                }).then(response  => {
                    console.log(response.data);             
                    // this.$store.commit('toggleLoadingState')
                }).catch(function(error) {
                    console.log(error);
                });

                this.edit = false
                this.buttonText = 'Bearbeiten'
            }else {
                this.edit = true
                this.buttonText = 'Speichern'
            }    
        }
    }
}
</script>

<style scoped>
.wrapper {
    justify-content: center;
}
td input {
    min-width: 30px;
    max-width: 100%;
    width: 100%;
}
</style>