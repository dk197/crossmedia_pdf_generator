<template>
    <div class="row">
        <p class="col-6">Dynamische VCards:</p>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {

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
                this.$store.commit('toggleLoadingState')
            }).catch(function(error) {
                console.log(error);
            });
        }
    }
}
</script>