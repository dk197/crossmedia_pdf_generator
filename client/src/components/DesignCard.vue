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
                        <p class="dc-label">Schriftfarbe:</p>
                        <input class="dc-input" v-model="fontColor" id="fontColor" type="color" @change="changeFontColor(currentAttribute)" name="favcolor" value="#ff0000"><br><br>
                        <p class="dc-label">Schriftart:</p>
                        <select class="dc-input" v-model="fontStyle" id="fontStyle" @change="changeFontStyle(currentAttribute)">
                            <option disabled value="">Schriftart</option>
                            <option v-for="(fontFamily, index) in fontFamilies" :key="index" v-bind:style="{ fontFamily: fontFamily.family }">
                                {{fontFamily.family}}
                            </option>
                        </select>
                        <p class="dc-label">Breite(mm):</p><input class="dc-input dc-input-size" type="number" v-model="cardWidth" name="cardWidth"  placeholder="Breite" id="cardWidth" @change="handleWidth">
                        <p class="dc-label">Höhe(mm):</p><input class="dc-input dc-input-size" type="number" v-model="cardHeight" name="cardHeight" placeholder="Höhe" id="cardHeight" @change="handleHeight">
                    </div>
                    <div class="dc-data">
                        <h4>Daten:</h4>
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
            </div>
            <div class="dc-card-area">
                <div id="businessCardCanvas" class="parentElement" style="height: 51mm; width: 86mm;">
                    <text-brick v-for="(brick, index) in bricks" :key="index" :text="brick.data.text" :font-size="brick.data.fontSize" :font-color="brick.data.fontColor" :font-style="brick.data.fontStyle" :id="index"></text-brick>
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
    created: function(){
        console.log('loading')
        this.loadGoogleFonts();
        if(!this.$store.getters.getLoginStatus){
            this.$router.push('/');
        }
    },
    data () {
        return{
            currentAttribute: '0',
            attributeSelect: '',
            cardWidth: '89',
            cardHeight: '51',
            fontSize: '',
            fontStyle: 'Futura',
            fontColor: '',
            fontUrl: '',
            name: '',
            adress: '',
            bricks: [
                {
                    attribute: 'Name',
                    data: {
                        fontSize: '',
                        fontStyle: '', 
                        fontColor: '',
                        fontUrl: '',
                        text: ''   
                    }
                },
                {
                    attribute: 'Position',
                    data: {
                        fontSize: '',
                        fontStyle: '',
                        fontColor: '',
                    }
                },
                {
                    attribute: 'Firma',
                    data: {
                        fontSize: '',
                        fontStyle: '',
                        fontColor: '',
                    }
                },
                {
                    attribute: 'Adresse',
                    data: {
                        fontSize: '',
                        fontStyle: '',
                        fontColor: '',
                    }
                },
                {
                    attribute: 'Telefon',
                    data: {
                        fontSize: '',
                        fontStyle: '',
                        fontColor: '',
                    }
                },
                {
                    attribute: 'Fax',
                    data: {
                        fontSize: '',
                        fontStyle: '', 
                        fontColor: '',
                    }
                },
                {
                    attribute: 'E-Mail',
                    data: {
                        fontSize: '',
                        fontStyle: '',
                        fontColor: '',
                    }
                },
                {
                    attribute: 'Webseite',
                    data: {
                        fontSize: '',
                        fontStyle: '',
                        fontColor: '',
                    }
                },
            ],
            fontFamilies: []
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
        handleWidth(e) {
            const width = e.target.value
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
        changeFontColor(attribute){
            var fontColor = event.target.value;
            this.bricks[attribute].data.fontColor = fontColor;
            document.getElementById(attribute).style.color = fontColor;
        },
        changeFontStyle(attr){
            var fontStyle = event.target.value;
            this.bricks[attr].data.fontStyle = fontStyle;
            // var fontUrl = document.getElementById(fontStyle).getAttribute("href");
            // this.bricks[attr].data.fontUrl = fontUrl;
            document.getElementById(attr).style.fontFamily = fontStyle;
            // console.log(this.bricks)
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
        handleHtml() {
            document.getElementById('htmlInput').value = document.getElementById('businessCardCanvas').innerHTML;
        },
        changeCurrentAttribute(index){
            this.currentAttribute = index;
        },
        loadGoogleFonts(){
            console.log('test')
            axios.get('https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyA_NtdvhXR4TDbYHJKvA1XJz4rjr-DjZ5E')
            .then(response  => {
                console.log('test2')
                this.fontFamilies = response.data.items;
                var sheet = window.document.styleSheets[0];
                for (var i = 0; i < this.fontFamilies.length; i++) {
                    var selector = "@font-face ";
                    var rules = "font-family: "+ this.fontFamilies[i].family +";src: url('"+ this.fontFamilies[i].files.regular +"');";
                    var index = sheet.cssRules.length;
                    if("insertRule" in sheet) {
                        sheet.insertRule(selector + "{" + rules + "}", index);
                    }
                    else if("addRule" in sheet) {
                        sheet.addRule(selector, rules, index);
                    }
                }        
                console.log(sheet)        
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
        /* color: black; */
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
        background: white;
        font-size: 12px;
        font-family: Futura;
        color: black;
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
        padding-top: 140px;
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
        width: 100px;
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