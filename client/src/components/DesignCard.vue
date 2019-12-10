<template>
    <div>
        <h1>Erstelle deine Visitenkarte</h1>
        <p>Deine Kontaktdaten:</p>
            <div id="businessCardInput">
                <input v-model="name" placeholder="dein Name">
                <input v-model="adress" placeholder="deine Mail">
            </div>
            <div id="businessCardCanvas" class="parentElement">
                <drag-it-dude :parent-width="500">
                <div class="innerElement">{{ text }}</div>
                </drag-it-dude>
            </div>
    </div>
</template>

<script>
import Vue from 'vue';
import DragItDude from 'vue-drag-it-dude';
new Vue({
  el: '#businessCardInput',
  data: {
    name: '',
    adress: '',
    text: name
  }
})
export default {
    name: 'bc-input',
    data () {
        return{
          name: '',
          adress: ''
        }
    },
    components: {
        DragItDude
    }
};
</script>

<style>
    .parentElement{
        position: relative;
        background: white;
    }
    #businessCardInput{
        float: left;
    }
    #businessCardCanvas{
        float: left;
        left: 10%;
    }
</style>