<template>
    <div>
        <h1>Erstelle deine Visitenkarte</h1>
        <form method="post" action="http://localhost:80/generate/pdf" target="_blank">
            <input type="hidden" name="name1" value="value1">
            <input type="hidden" name="name2" value="value2">
            <input type="submit" class="btn btn-primary" value="Open results in a new window"> 
        </form>
        <p>Deine Kontaktdaten:</p>
        <form method="post" action="http://localhost:80/generate/pdf" target="_blank">
            <h3>Deine Daten:</h3>
            <div>
                <input type="number" v-model="cardWidth" name="cardWidth" placeholder="Breite" id="cardWidth" @change="handleWidth">
                <input type="number" v-model="cardHeight" name="cardHeight" placeholder="Höhe" id="cardHeight" @change="handleHeight">
            </div>
            <div id="businessCardInput">
                <input v-model="name" name="name"  placeholder="dein Name">
                <input v-model="adress" name="adress" placeholder="deine Mail">
            </div>
            <input type="submit" class="btn btn-primary" value="View Pdf">
        </form>
        
        <div id="businessCardCanvas" class="parentElement" style="height: 51mm; width: 86mm;">
            <drag-it-dude id="visitcardParent">
                <div class="innerElement">{{ name }}</div>
            </drag-it-dude>
            <drag-it-dude id="visitcardParent">
                <div class="innerElement">{{ adress }}</div>
            </drag-it-dude>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import DragItDude from 'vue-drag-it-dude';
export default {
    name: 'bc-input',
    data () {
        return{
            cardWidth: '89',
            cardHeight: '51',
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
        },
        pdf() {
            axios.post('http://localhost/generate/pdf', {
                cardWidth: this.cardWidth,
                cardHeight: this.cardHeight,
                name: this.name,
                adress: this.adress
            }).then(response  => {
                console.log(response);
            }).catch(function(error) {
                console.log(error);
            });
        },
        pdfAusgabe() {
            var link=document.createElement('a');
            link.href="http://localhost:80/generate/pdfAusgabe";
            link.target="_blank";
            link.click();
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