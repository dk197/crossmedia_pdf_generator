<template>
    <div class="row">
        <div class="col-10">
            <h1 class="dc-heading">Erstelle deine Visitenkarte</h1>
            <div class="dc-content">
                <div class="dc-input-area">
                    <form method="post" action="http://localhost:80/generate/pdf" enctype="multipart/form-data" target="_blank">
                        <!-- <h3>Deine Daten:</h3> -->
                        <div class=dc-options>
                            <h4>Optionen:</h4>
                            <div>
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
                            <channel-color-picker id="fontColor" v-model="fontColor" :color="color" @color-change="colorChanged"/>
                            <!-- <input class="dc-input" v-model="fontColor" id="fontColor" type="color" @change="changeFontColor(currentAttribute)" name="favcolor" value="#ff0000"><br><br> -->
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
                            <select class="dc-input" v-model="fontTyp" id="fontTyp" @change="changeFontTyp(currentAttribute)">
                                <option disabled value="">Schriftschnitt</option>
                                <option value="italic">italic</option>
                                <option value="italic-bold">italic-bold</option>
                                <option value="normal">normal</option>
                                <option value="bold">bold</option>
                            </select>
                            </div>
                            <div>
                                <p class="dc-label">Breite(mm):</p><input class="dc-input dc-input-size" type="number" v-model="cardWidth" name="cardWidth"  placeholder="Breite" id="cardWidth" @change="handleWidth">
                                <p class="dc-label">Höhe(mm):</p><input class="dc-input dc-input-size" type="number" v-model="cardHeight" name="cardHeight" placeholder="Höhe" id="cardHeight" @change="handleHeight">
                                <p class="dc-label">Datei für Logo:</p>
                                <input class="dc-input logo-input" type="file" id="fileToUpload" ref="file" @change="handleFileUpload" name="fileToUpload" accept=".jpg, .jpeg, .png"/>
                                <p class="dc-label">Breite des Logos(px):</p>
                                <input  class="dc-input dc-input-size" type="number" value="50" id="logoSize" @change="changeLogoSize()">
                                <p class="dc-label">Breite QR-Code(px):</p>
                                <input  class="dc-input dc-input-size" type="number" value="50" name="qrSize" id="qrSize" @change="changeQrSize()">
                                <p class="dc-label">Dynamischer QR-Code:</p>
                                <input class="dc-input" type="checkbox" name="dynamicQrCode" v-model="dynamicQrCode">
                            </div>
                        </div>
                        <div class="dc-data">
                            <h4>Daten:</h4>
                            <div id="businessCardInput">
                                <td class="dc-input dc-input-card" v-for="(brick, index) in bricks" :key="index">
                                    <input v-model="bricks[index].data.text" :placeholder="bricks[index].attribute" :name="bricks[index].attribute.toLowerCase()" @focus="changeCurrentAttribute(index)" v-on:click="getSelectedInputField(index)">
                                </td>
                                <input  class="dc-button btn btn-primary" type="button" value=" +/- Logo " @click="toggleLogo()">
                                <input  class="dc-button btn btn-primary" type="button" value=" +/- QR-Code" @click="toggleQr()">
                            </div>
                            <div class="dc-submit">               
                                <input type="hidden" name="user_id" v-model="userId">                                     
                                <input type="hidden" name="htmlInput" id="htmlInput">
                                <input type="submit" class="btn btn-primary" value="View Pdf" @click="handleHtml">
                            </div>
                        </div>
                    </form>                
                </div>
                <div class="dc-card-area">
                    <div id="businessCardCanvas" class="parentElement" style="height: 51mm; width: 86mm;">
                        <text-brick v-for="(brick, index) in bricks" :key="index" :text="brick.data.text" :font-size="brick.data.fontSize" :font-color="brick.data.fontColor" :font-style="brick.data.fontStyle" :id="index + '-text'" @clicked="onClickChild(index)"></text-brick>
                        <img-brick v-for="(brickI, index) in bricksI" :key="'img-' + index" :src="brickI.data.src" :width="brickI.data.width" :style="brickI.data.show" :id="index + '-img'"></img-brick>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import TextBrick from './TextBrick'
import ImgBrick from './ImgBrick'
export default {
    name: 'bc-input',
    created: function(){
        if(!this.$store.getters.getLoginStatus){
            this.$router.push('/');
        }else {
            this.getCurrentUser()
        }
    },
    data () {
        return{
            userId: '',
            dynamicQrCode: false,
            currentAttribute: '0',
            attributeSelect: '',
            cardWidth: '89',
            cardHeight: '51',
            fontSize: '',
            fontStyle: 'Futura',
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
                    attribute: 'Telefon_privat',
                    data: {
                        fontSize: '',
                        fontStyle: '',
                        fontColor: '',
                        fontTyp: '',
                    }
                },
                {
                    attribute: 'Telefon_Geschaeftlich',
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
            fontFamilies: [],
            color: {
                type: "cmyk",
                channels: [0, 0, 0, 100]
            }
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
        getCurrentUser() {
            axios.get('http://localhost/api/secured/getcurrentuser', {
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('token')
                }
            }).then(response  => {
                this.userId = response.data.user_id
            }).catch(function(error) {
                console.log(error);
            });
        },
        onClickChild (index) {
            this.getSelectedInputField(index);
        },
        getSelectedInputField(index) {
            this.fontSize = this.bricks[index].data.fontSize;
            this.fontStyle = this.bricks[index].data.fontStyle;
            this.fontColor = this.bricks[index].data.fontColor;
            this.fontTyp = this.bricks[index].data.fontTyp;
            if (this.bricks[index].data.fontColor.length !== 0) {
                var r = this.bricks[index].data.fontColor.match(/\d{1,3}/gm)[0];
                var g = this.bricks[index].data.fontColor.match(/\d{1,3}/gm)[1];
                var b = this.bricks[index].data.fontColor.match(/\d{1,3}/gm)[2];
                console.log(this.RGBtoCMYK(r,g,b));
                this.color.channels = this.RGBtoCMYK(r,g,b);
            }
            else {
                this.color.channels = [0,0,0,100]
            }
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
            this.bricksI[1].data.src = URL.createObjectURL(file);
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
        },
        colorChanged(color) {
            const newColor = this.CYMKtoRGB(color.channels[0], color.channels[1], color.channels[2], color.channels[3])
            this.bricks[this.currentAttribute].data.fontColor = newColor;
            document.getElementById(this.currentAttribute + '-text').style.color = newColor; 
            this.color.channels = newColor;
        },
        CYMKtoRGB(c, m, y, k) {
            c = (c / 100);
            m = (m / 100);
            y = (y / 100);
            k = (k / 100);
            
            c = c * (1 - k) + k;
            m = m * (1 - k) + k;
            y = y * (1 - k) + k;
            
            var r = 1 - c;
            var g = 1 - m;
            var b = 1 - y;

            r = Math.round(255 * r);
            g = Math.round(255 * g);
            b = Math.round(255 * b);
            
            return `rgb(${r}, ${g}, ${b})`
        },
        RGBtoCMYK(r, g, b) {
            var c = 1 - (r / 255);
            var m = 1 - (g / 255);
            var y = 1 - (b / 255);
            var k = Math.min(c, Math.min(m, y));
            
            c = (c - k) / (1 - k);
            m = (m - k) / (1 - k);
            y = (y - k) / (1 - k);
            
        
            c = Math.round(c * 10000) / 100;
            m = Math.round(m * 10000) / 100;
            y = Math.round(y * 10000) / 100;
            k = Math.round(k * 10000) / 100;
            
            
            c = isNaN(c) ? 0 : c;
            m = isNaN(m) ? 0 : m;
            y = isNaN(y) ? 0 : y;
            k = isNaN(k) ? 0 : k;
            
            return [c, m, y, k];
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
        margin-top: 10px;
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

    .sb-color_picker-current-icon {
        width: 100px;
    }

    .sb-color_picker-current {
        padding: .7rem !important;
        padding-right: 0 !important;
        height: calc(1.5em + .75rem + 2px) !important;
        border: none !important;
    }

    .sb-color_picker-picker {
        width: 200px !important;
    }

    .sb-color_picker-picker-list {
        display: none !important;
    }
</style>