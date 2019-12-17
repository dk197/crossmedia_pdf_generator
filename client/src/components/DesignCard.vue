<template>
    <div>
        <h1>Erstelle deine Visitenkarte</h1>
        <p>Deine Kontaktdaten:</p>
        <form method="post" action="http://localhost:80/generate/pdf" target="_blank">
            <h3>Deine Daten:</h3>
            <div>
                <select id="attributeSelect" @change="createNewAttribute">
                    <option disabled :value="currentAttribute">Please select your attribute</option>
                    <option>Name</option>
                    <option>Position</option>
                    <option>Firma</option>
                    <option>Adresse</option>
                    <option>Telefon</option>
                    <option>Fax</option>
                    <option>E-Mail</option>
                    <option>Website</option>
                </select>
                <select v-model="fontSize" id="fontSize" @change="changeFontSize(currentAttribute)">
                    <option disabled value="">Please select your font size</option>
                    <option>xx-small</option>
                    <option>x-small</option>
                    <option>small</option>
                    <option>medium</option>
                    <option>large</option>
                    <option>x-large</option>
                    <option>xx-large</option>
                </select>
                <select v-model="fontStyle" id="fontStyle" @change="changeFontStyle(currentAttribute)">
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
                <td v-for="(brick, index) in bricks" :key="index">
                    <input v-model="bricks[index].data.text" :placeholder="bricks[index].attribute" @focus="changeCurrentAttribute(index)">
                </td>
            </div>
            <input type="hidden" name="htmlInput" id="htmlInput">
            <input type="submit" class="btn btn-primary" value="View Pdf" @click="handleHtml">
        </form>
        
        <div id="businessCardCanvas" class="parentElement" style="height: 51mm; width: 86mm;">
            <text-brick v-for="(brick, index) in bricks" :key="index" :text="brick.data.text" :font-size="brick.data.fontSize" :font-style="brick.data.fontStyle" :id="index"></text-brick>
        </div>
    </div>
</template>

<script>
import TextBrick from './TextBrick'
export default {
    name: 'bc-input',
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
                        text: 'tests'   
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
                        text: 'Bitte eintippen'   
                    }
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