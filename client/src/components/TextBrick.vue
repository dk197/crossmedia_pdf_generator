<template>
    <drag-it-dude id="visitcardParent" style="top:1px; left:1px">
        <div class="innerElement" v-on:click="selectAttribute">{{ text }}</div>
    </drag-it-dude>

</template>
<script>
import DragItDude from 'vue-drag-it-dude';
export default{
    props: {
        text: {
            required: true
        },
        fontSize: {
            default: '20px'
        },
        fontStyle: {
            default: 'freesans'
        },
        fontColor: {
            default: 'black'
        }
    },
    components: {
        DragItDude
    },
    methods: {
        selectAttribute: function (event){
            if(event){
                this.$emit('clicked')
            }
        }
    }
}
</script>
<style scoped>
</style>


