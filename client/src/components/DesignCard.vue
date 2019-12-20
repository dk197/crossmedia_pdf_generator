<template>
    <div>
        <h1 class="dc-heading" >Erstelle deine Visitenkarte</h1>
        <div class="dc-content">
            <div class="dc-input-area">
                <form method="post" action="http://localhost:80/generate/pdf" target="_blank">
                    <!-- <h3>Deine Daten:</h3> -->
                    <div class=dc-options>
                        <h4>Optionen:</h4>
                        <p class="dc-label">Schriftgröße:</p>
                        <select class="dc-input" v-model="fontSize" id="fontSize" @change="changeFontSize(currentAttribute)">
                            <option disabled value="">Schriftgröße</option>
                            <option value="8px">8px</option>
                            <option value="10px">10px</option>
                            <option value="12px">12px</option>
                            <option value="14px">14px</option>
                            <option value="16px">16px</option>
                            <option value="20px">20px</option>
                            <option value="25px">25px</option>
                            <option value="30px">30px</option>
                        </select>
                        <p class="dc-label">Schriftart:</p>
                        <select class="dc-input" v-model="fontStyle" id="fontStyle" @change="changeFontStyle(currentAttribute)">
                            <option disabled value="">Schriftart</option>
                             <option v-for="(fontFamily, index) in fontFamilies" :key="index" v-bind="{id: fontFamily.family, href:fontFamily.files.regular}">
                                {{fontFamily.family}}
                            </option>
                        </select>
                        <p class="dc-label">Breite(mm):</p><input class="dc-input dc-input-size" type="number" v-model="cardWidth" name="cardWidth"  placeholder="Breite" id="cardWidth" @change="handleWidth">
                        <p class="dc-label">Höhe(mm):</p><input class="dc-input dc-input-size" type="number" v-model="cardHeight" name="cardHeight" placeholder="Höhe" id="cardHeight" @change="handleHeight">
                    </div>
                    <div class="dc-data">
                        <h4>Daten:</h4>
                        <!-- <select class="dc-input" id="attributeSelect" @change="createNewAttribute">
                            <option disabled :value="currentAttribute">Datentyp</option>
                            <option>Name</option>
                            <option>Position</option>
                            <option>Firma</option>
                            <option>Adresse</option>
                            <option>Telefon</option>
                            <option>Fax</option>
                            <option>E-Mail</option>
                            <option>Website</option>
                        </select> -->
                        <div id="businessCardInput">
                            <td class="dc-input dc-input-card" v-for="(brick, index) in bricks" :key="index">
                                <input v-model="bricks[index].data.text" :placeholder="bricks[index].attribute" @focus="changeCurrentAttribute(index)">
                            </td>
                        </div>
                        <div class="dc-submit">                                                    
                            <input type="hidden" name="htmlInput" id="htmlInput">
                            <input type="submit" class="btn btn-primary" value="View Pdf" @click="handleHtml">
                        </div>
                    </div>
                </form>
                <button class="dc-custom btn btn-success" @click="createNewAttribute">+ Extrafeld</button>
            </div>
            <div class="dc-card-area">
                <div id="businessCardCanvas" class="parentElement" style="height: 51mm; width: 86mm;">
                    <text-brick v-for="(brick, index) in bricks" :key="index" :text="brick.data.text" :font-size="brick.data.fontSize" :font-style="brick.data.fontStyle" :id="index"></text-brick>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import TextBrick from './TextBrick'
import axios from 'axios';
export default {
    name: 'bc-input',
    mounted: function(){
        this.loadGoogleFonts();
    },
    data () {
        return{
            currentAttribute: '0',
            attributeSelect: '',
            cardWidth: '89',
            cardHeight: '51',
            fontSize: '',
            fontStyle: 'Futura',
            name: '',
            adress: '',
            bricks: [
                {
                    attribute: 'Name',
                    data: {
                        fontSize: '',
                        fontStyle: '',
                    }
                },
                {
                    attribute: 'Position',
                    data: {
                        fontSize: '',
                        fontStyle: '',
                    }
                },
                {
                    attribute: 'Firma',
                    data: {
                        fontSize: '',
                        fontStyle: '',
                    }
                },
                {
                    attribute: 'Adresse',
                    data: {
                        fontSize: '',
                        fontStyle: '',
                    }
                },
                {
                    attribute: 'Telefon',
                    data: {
                        fontSize: '',
                        fontStyle: '',
                    }
                },
                {
                    attribute: 'Fax',
                    data: {
                        fontSize: '',
                        fontStyle: '', 
                    }
                },
                {
                    attribute: 'E-Mail',
                    data: {
                        fontSize: '',
                        fontStyle: '',
                    }
                },
                {
                    attribute: 'Webseite',
                    data: {
                        fontSize: '',
                        fontStyle: '',
                    }
                },
            ],
            fontFamilies: []
        }
    },
    components: {
        TextBrick
    },
    created(){
        if(!this.$store.getters.getLoginStatus){
            this.$router.push('/');
        }
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
        changeFontSize(attribute){
            var fontSize = event.target.value;
            this.bricks[attribute].data.fontSize = fontSize;
            document.getElementById(attribute).style.fontSize = fontSize;
        },
        changeFontStyle(attribute){
            var fontStyle = event.target.value;
            this.bricks[attribute].data.fontStyle = fontStyle;
            document.getElementById(attribute).style.fontFamily = fontStyle;
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
            }
            return false       
        },
        createNewAttribute(event){
            const attr = event.target.value
            if(this.getKeyFromArray(this.bricks, attr) === false) {
                const newAttrObj = {
                    attribute: attr,
                    data: {
                        fontSize: '',
                        fontStyle: '',
                        // text: 'Bitte eintippen'
                    },
                    

                }
                this.bricks.push(newAttrObj)
            }
            const attrKey = this.getKeyFromArray(this.bricks, attr)
            this.currentAttribute = attrKey
        },
        handleHtml() {
            document.getElementById('htmlInput').value = document.getElementById('businessCardCanvas').innerHTML;
        },
        changeCurrentAttribute(index){
            this.currentAttribute = index;
        },
        loadGoogleFonts(){
            alert();
            axios.get('https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyA_NtdvhXR4TDbYHJKvA1XJz4rjr-DjZ5E')
            .then(response  => {
                this.fontFamilies = response.data.items;
                console.log(this.fontFamilies);
            })
            .catch(function(error) {
                console.log(error);
            });
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
        display: flex;
        width: 450px;
        flex-wrap: wrap;
        margin-top:10px;
    }
    #businessCardCanvas{
        float: left;
        /* left: 10%; */
        background: white;
        font-size: 12px;
        font-family: Futura;
    }
    .dc-heading {
        margin-left: 10%;
        margin-bottom: 30px;
    }
    .dc-content {
        display: flex;
        width: 100%;
        position: relative;
        padding: 0 10%;
    }
    .dc-input-area {
        width: 40%;
        z-index: 50;
    }
    .dc-card-area {
        padding-top: 170px;
        z-index: 10;
    }
    .dc-input {
        display: block;
        height: calc(1.5em + .75rem + 2px);
        padding: .375rem .75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
    .dc-input-card {
        width: 200px;
        margin-right: 10px;
        margin-bottom: 10px;
    }
    .dc-input input{
        border: none;
        width: 180px;
    }
    .dc-data, .dc-options, .dc-submit {
        width:  100%
    }
    .dc-options {
        display: flex;
        margin-bottom: 50px;
    }
    .dc-options h4{
        margin-right: 20px;
    }
    .dc-options > * {
        margin-right: 10px
    }
    .dc-data select{
        width: 200px;
    }
    .dc-input-size {
        width: 50px;
    }
    .dc-card-options {
        display: flex;
        margin-bottom: 30px;
    }
    .dc-card-options input {
        width: 100px;
    }
    .dc-data {
        display: flex;
        flex-direction: column;
    }
    .dc-submit {
        margin-top: 50px;
    }
    .dc-label{
        padding-top: 7px;
    }


    /* optional */
    .dc-submit {
        margin-top: 70px;
    }
    .dc-custom {
        position: absolute;
        bottom:60px;
        background-color: white;
        color:grey;
    }
</style>