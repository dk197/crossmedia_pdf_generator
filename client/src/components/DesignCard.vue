<template>
    <div>
        <h1>Erstelle deine Visitenkarte</h1>
        <p>Deine Kontaktdaten:</p>
        <div id="hallo">
            <input type="number" value="89" placeholder="Breite" id="cardWidth" @change="handleWidth" @>
            <input type="number" value="51" placeholder="Höhe" id="cardHeight" @change="handleHeight">
        </div>
        <div id="businessCardInput">
            <input v-model="name" placeholder="dein Name">
            <input v-model="adress" placeholder="deine Mail">
        </div>
        <div id="businessCardCanvas" class="parentElement" style="height: 51mm; width: 86mm;">
            <drag-it-dude id="visitcardParent">
            <div class="innerElement">{{ name }}</div>
            <div class="innerElement">{{ adress }}</div>
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
    },
    methods: {
        handleWidth() {
            var width = document.getElementById("cardWidth").value;
            document.getElementById('businessCardCanvas').style.width = width + 'mm';
        },
        handleHeight() {
            var height = document.getElementById("cardHeight").value;
            document.getElementById('businessCardCanvas').style.height = height +'mm';
        }
    }
};
</script>

<style>
    .innerElement{
        color: black;
        cursor: pointer;
        -webkit-touch-callout: none; /* iOS Safari */
        -webkit-user-select: none; /* Safari */
        -khtml-user-select: none; /* Konqueror HTML */
        -moz-user-select: none; /* Old versions of Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
            user-select: none; /* Non-prefixed version, currently
                                  supported by Chrome, Opera and Firefox */
    }
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
        background: white;
    }
</style>