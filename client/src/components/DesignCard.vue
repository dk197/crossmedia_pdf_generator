<template>
    <div>
        <h1 class="dc-heading">Erstelle deine Visitenkarte</h1>
        <div class="dc-content">
            <div class="dc-input-area">
                <form method="post" action="http://localhost:80/generate/pdf" target="_blank">
                    <!-- <h3>Deine Daten:</h3> -->
                    <div class=dc-options>
                        <h4>Optionen:</h4>
                        <div>
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
                            <option style="fontFamily: dejavusanscondensed">  dejavusanscondensed </option> 
                            <option style="fontFamily: dejavusans"> dejavusans  </option>
                            <option style="fontFamily: dejavuserif">  dejavuserif  </option>
                            <option style="fontFamily: dejavuserifcondensed">  dejavuserifcondensed  </option>
                            <option style="fontFamily: dejavusansmono">  dejavusansmono  </option>
                            <option style="fontFamily: freesans">  freesans  </option>
                            <option style="fontFamily: freeserif">  freeserif  </option>
                            <option style="fontFamily: freemono"> freemono  </option>
                            <option style="fontFamily: ocrb">  ocrb  </option>
                            <option style="fontFamily: abyssinicasil">  abyssinicasil  </option>
                            <option style="fontFamily: aboriginalsans">  aboriginalsans  </option>
                            <option style="fontFamily: jomolhari">  jomolhari  </option>
                            <option style="fontFamily: taiheritagepro">  taiheritagepro  </option>
                            <option style="fontFamily: lannaalif">  lannaalif  </option>
                            <option style="fontFamily: daibannasilbook">  daibannasilbook  </option>
                            <option style="fontFamily: garuda">  garuda  </option>
                            <option style="fontFamily: khmeros">  khmeros  </option>
                            <option style="fontFamily: dhyana">  dhyana  </option>
                            <option style="fontFamily: tharlon">  tharlon  </option>
                            <option style="fontFamily: padaukbook">  padaukbook  </option>
                            <option style="fontFamily: zawgyi-one">  zawgyi-one  </option>
                            <option style="fontFamily: ayar">  ayar  </option>
                            <option style="fontFamily: taameydavidclm">  taameydavidclm  </option>
                            <option style="fontFamily: mph2bdamase">mph2bdamase</option>
                            <option style="fontFamily: lateef">  lateef  </option>
                            <option style="fontFamily: unbatang"> unbatang  </option>
                        </select>
                        <p class="dc-label">Schriftschnitt:</p>
                        <select class="dc-input" v-model="fontTyp" id="fontTyp" @change="changeFontTyp(currentAttribute)">
                            <option disabled value="">Schriftschnitt</option>
                            <option value="italic">italic</option>
                            <option value="italic-bold">italic-bold</option>
                            <option value="normal">normal</option>
                            <option value="bold">bold</option>
                        </select>
                        <p class="dc-label">Breite(mm):</p><input class="dc-input dc-input-size" type="number" v-model="cardWidth" name="cardWidth"  placeholder="Breite" id="cardWidth" @change="handleWidth">
                        <p class="dc-label">Höhe(mm):</p><input class="dc-input dc-input-size" type="number" v-model="cardHeight" name="cardHeight" placeholder="Höhe" id="cardHeight" @change="handleHeight">
                        </div>
                        <div>
                            <p class="dc-label">Breite QR-Code(px):</p>
                            <input  class="dc-input dc-input-size" type="number" value="50" name="qrSize" id="qrSize" @change="changeQrSize()">
                            <p class="dc-label">Datei für Logo:</p>
                            <input class="dc-input logo-input" type="file" id="file" ref="file" @change="handleFileUpload" accept=".jpg, .jpeg, .png"/>
                            <p class="dc-label">Breite des Logos(px):</p>
                            <input  class="dc-input dc-input-size" type="number" value="50" id="logoSize" @change="changeLogoSize()">
                            
                        </div>
                    </div>
                    <div class="dc-data">
                        <h4>Daten:</h4>
                        <div id="businessCardInput">
                            <td class="dc-input dc-input-card" v-for="(brick, index) in bricks" :key="index">
                                <input v-model="bricks[index].data.text" :placeholder="bricks[index].attribute" @focus="changeCurrentAttribute(index)" v-on:click="getSelectedInputField(index)">
                            </td>
                            <input  class="dc-button btn btn-primary" type="button" value=" +/- QR-Code" @click="toggleQr()">
                            <input  class="dc-button btn btn-primary" type="button" value=" +/- Logo " @click="toggleLogo()">
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
                    <text-brick v-for="(brick, index) in bricks" :key="index" :text="brick.data.text" :font-size="brick.data.fontSize" :font-color="brick.data.fontColor" :font-style="brick.data.fontStyle" :id="index + '-text'"></text-brick>
                    <img-brick v-for="(brickI, index) in bricksI" :key="'img-' + index" :src="brickI.data.src" :width="brickI.data.width" :style="brickI.data.show" :id="index + '-img'"></img-brick>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import TextBrick from './TextBrick'
import ImgBrick from './ImgBrick'
export default {
    name: 'bc-input',
    created: function(){
        console.log('loading')
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
            fontStyle: '',
            fontColor: '',
            fontTyp: '',
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
                        fontTyp: '',
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
                        fontTyp: '',
                    }
                },
                {
                    attribute: 'Firma',
                    data: {
                        fontSize: '',
                        fontStyle: '',
                        fontColor: '',
                        fontTyp: '',
                    }
                },
                {
                    attribute: 'Adresse',
                    data: {
                        fontSize: '',
                        fontStyle: '',
                        fontColor: '',
                        fontTyp: '',
                    }
                },
                {
                    attribute: 'Telefon',
                    data: {
                        fontSize: '',
                        fontStyle: '',
                        fontColor: '',
                        fontTyp: '',
                    }
                },
                {
                    attribute: 'Fax',
                    data: {
                        fontSize: '',
                        fontStyle: '', 
                        fontColor: '',
                        fontTyp: '',
                    }
                },
                {
                    attribute: 'E-Mail',
                    data: {
                        fontSize: '',
                        fontStyle: '',
                        fontColor: '',
                        fontTyp: '',
                    }
                },
                {
                    attribute: 'Webseite',
                    data: {
                        fontSize: '',
                        fontStyle: '',
                        fontColor: '',
                        fontTyp: '',
                    }
                },
            ],
            bricksI: [
                {
                    attribute: 'Qr',
                    data: {
                        src: 'https://qrickit.com/api/qr.php?d=BEGIN%3aVCARD%0d%0aVERSION%3a3',
                        width: '50px',
                        show: 'display: none',
                    }
                },
                {
                    attribute: 'Logo',
                    data: {
                        src: null,
                        width: '50px',
                        show: null,
                    }
                }
            ],
            fontFamilies: []
        }
    },
    components: {
        TextBrick,
        ImgBrick
    },
    computed: {
        getBrickValue(attribute) {
            const key = this.getKeyFromArray(this.bricks, attribute)
            return this.bricks[key].data.text
        },
        getBrickIValue(attribute) {
            const key = this.getKeyFromArray(this.bricksI, attribute)
            return this.bricksI[key].data.img
        }
    },
    methods: {
        getSelectedInputField(index) {
            this.fontSize = this.bricks[index].data.fontSize;
            this.fontStyle = this.bricks[index].data.fontStyle;
            this.fontColor = this.bricks[index].data.fontColor;
            this.fontTyp = this.bricks[index].data.fontTyp;
        },
        toggleLogo() {
            if(this.bricksI['1'].data.show == 'display: none'){
                this.bricksI['1'].data.show = 'display: ';
            }else{
                this.bricksI['1'].data.show = 'display: none';
            }    
        },
        changeLogoSize(){
            var width = event.target.value;
            this.bricksI['1'].data.width = width;
        },
        handleFileUpload(e) {
            const file = e.target.files[0];
            this.bricksI['1'].data.src = URL.createObjectURL(file);
            alert(file.webkitRelativePath)
        },
        toggleQr() {
            if(this.bricksI['0'].data.show == 'display: none'){
                this.bricksI['0'].data.show = 'display: ';
            }else{
                this.bricksI['0'].data.show = 'display: none';
            }    
        },
        handleWidth(e) {
            const width = e.target.value
            document.getElementById('businessCardCanvas').style.width = width + 'mm';
        },
        handleHeight() {
            var height = document.getElementById("cardHeight").value;
            document.getElementById('businessCardCanvas').style.height = height +'mm';
        }, 
        changeQrSize(){
            var width = event.target.value;
            this.bricksI['0'].data.width = width;
        },
        changeFontSize(attribute){
            var fontSize = event.target.value;
            this.bricks[attribute].data.fontSize = fontSize;
            document.getElementById(attribute + '-text').style.fontSize = fontSize;
        },
        changeFontColor(attribute){
            var fontColor = event.target.value;
            this.bricks[attribute].data.fontColor = fontColor;
            document.getElementById(attribute + '-text').style.color = fontColor;
        },
        changeFontStyle(attr){
            console.log(attr);
            var fontStyle = event.target.value;
            this.bricks[attr].data.fontStyle = fontStyle;
            // var fontUrl = document.getElementById(fontStyle).getAttribute("href");
            // this.bricks[attr].data.fontUrl = fontUrl;
            document.getElementById(attr + '-text').style.fontFamily = fontStyle;
            // console.log(this.bricks)
        },
        changeFontTyp(attribute){
            var fontTyp = event.target.value;
            this.bricks[attribute].data.fontTyp = fontTyp;
            if(fontTyp == "bold"){
                document.getElementById(attribute + '-text').style.fontWeight = fontTyp;
                document.getElementById(attribute + '-text').style.fontStyle = "normal";
            }else if (fontTyp == "italic-bold"){
                document.getElementById(attribute + '-text').style.fontStyle = "italic";
                document.getElementById(attribute + '-text').style.fontWeight = "bold";
            }else{
                document.getElementById(attribute + '-text').style.fontStyle = fontTyp;
                document.getElementById(attribute + '-text').style.fontWeight = "normal";
            }
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
        font-family: freesans;
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
        padding-top: 230px;
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
        flex-direction: column;
    }
    .dc-options> div {
        display: flex;
    }
    .dc-options h4{
        margin-right: 20px;
    }
    .dc-options > div > * {
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
        min-width: max-content;
    }
    .dc-button {
        width: 200px;
        margin-right: 10px;
    }
    .logo-input {
        padding: 3px;
        width: 270px;
    }
    
</style>