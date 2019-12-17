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
            <h3 @click="changeText(1,1)">Deine Daten:</h3>
            <div>
                <select v-model="fontSize" id="fontSize" @change="changeFontSize">
                    <option disabled value="">Please select your font size</option>
                    <option>xx-small</option>
                    <option>x-small</option>
                    <option>small</option>
                    <option>medium</option>
                    <option>large</option>
                    <option>x-large</option>
                    <option>xx-large</option>
                </select>
                  <select v-model="fontStyle" id="fontStyle" @change="changeFontStyle">
                    <option disabled value="">Please select your font style</option>
                    <option>Verdana</option>
                    <option>Arial</option>
                    <option>Futura</option>
                    <option>Times</option>
                </select>
                <input type="number" v-model="cardWidth" name="cardWidth"  placeholder="Breite" id="cardWidth" @change="handleWidth">
                <input type="number" v-model="cardHeight" name="cardHeight" placeholder="Höhe" id="cardHeight" @change="handleHeight">
            </div>
            <div id="businessCardInput">
                <input v-model="bricks[0].data.text" placeholder="name">
                <!--
                <input v-model="name" placeholder="name">
                <input v-model="adress" placeholder="e-mail">
                <input v-model="posistion" placeholder="position">
                <input v-model="company" placeholder="unternehmen/firma">
                <input v-model="telefon" placeholder="telefon">
                <input v-model="fax" placeholder="fax">
                <input v-model="company" placeholder="unternehmen/firma">
                <input v-model="website" placeholder="website">-->
            </div>
            <input type="submit" class="btn btn-primary" value="View Pdf">
        </form>
        
        <div id="businessCardCanvas" class="parentElement" style="height: 51mm; width: 86mm;">
            <text-brick v-for="(brick, index) in bricks" :key="index" :text="brick.data.text" :font-size="brick.data.fontSize" :font-style="brick.data.fontStyle"></text-brick>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import TextBrick from './TextBrick'
export default {
    name: 'bc-input',
    data () {
        return{
            cardWidth: '89',
            cardHeight: '51',
            fontSize: '',
            fontStyle: 'Futura',
            name: '',
            adress: '',
            bricks: [
                {
                    attribute: 'name',
                    data: {
                        fontSize: '',
                        fontStyle: '',
                        text: 'tests'   
                    }
                },
                {
                    attribute: 'position',
                    data: {
                        fontSize: '',
                        fontStyle: '',
                        text: ''   
                    }
                },
                {
                    attribute: 'company',
                    data: {
                        fontSize: '',
                        fontStyle: '',
                        text: ''   
                    }
                },
                {
                    attribute: 'adress',
                    data: {
                        fontSize: '',
                        fontStyle: '',
                        text: ''   
                    }
                },
                {
                    attribute: 'telefon',
                    data: {
                        fontSize: '',
                        fontStyle: '',
                        text: ''   
                    }
                },
                {
                    attribute: 'fax',
                    data: {
                        fontSize: '',
                        fontStyle: '',
                        text: ''   
                    }
                },
                {
                    attribute: 'email',
                    data: {
                        fontSize: '',
                        fontStyle: '',
                        text: ''   
                    }
                },
                {
                    attribute: 'website',
                    data: {
                        fontSize: '',
                        fontStyle: '',
                        text: ''   
                    }
                }
            ]
        }
    },
    components: {
        TextBrick
    },
    computed: {
        getBrickValue(attribute) {
            const key = this.getKeyFromArray(this.bricks, attribute)
            return this.bricks[key].data.text
        }
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
        changeFontSize(){
            var fontSize = document.getElementById("fontSize").value;
            document.getElementById("businessCardCanvas").style.fontSize = fontSize;
        },
        changeFontStyle(){
            var fontStyle = document.getElementById("fontStyle").value;
            console.log(fontStyle);
            document.getElementById("businessCardCanvas").style.fontFamily = fontStyle;
        },
        changeText(attribute, text) {
            //this.bricks
            console.log(attribute)
            console.log(text)
            const key = this.getKeyFromArray(this.bricks, attribute)
            console.log(key)

        },
        getKeyFromArray(array, value) {
            for (let index = 0; index < array.length; index++) {
                if (Object.values(array[index]).indexOf(value) > -1) {
                    return index
                }         
                return false       
            }
            
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
        font-size: 12px;
        font-family: Futura;
    }
</style>