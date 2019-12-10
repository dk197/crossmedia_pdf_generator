<template>
    <div>
        <h1>Erstelle deine Visitenkarte</h1>
        <p>Deine Kontaktdaten:</p>
            <div id="businessCardInput">
                <input v-model="name" placeholder="dein Name">
                <input v-model="adress" placeholder="deine Mail">
                <div id="businessCardCanvas">
                    <drag-it-dude
                    @activated="handleActivated"
                    @dragging="handleDragging"
                    @dropped="handleDropped"
                    >
                    <p>{{name}}</p>
                    <p>{{adress}}</p>
                    </drag-it-dude>
                </div>
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
    adress: ''
  },
  template: '<div>{{ message }}</div>'
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
        handleActivated() {
        this.text = "I am ready for great things!";
        },
        handleDragging() {
        this.text = "Weeee!";
        },
        handleDropped() {
        this.text = "That's place is awesome!";
        setTimeout(() => {
            this.text = "Just move me!";
        }, 3000);
        }
    }
};
</script>

<style>
    #businessCardCanvas{
        position: relative;
        float: right;
    }
</style>