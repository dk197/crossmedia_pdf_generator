<template>
    <drag-it-dude id="visitcardParent" style="top:1px; left:1px" v-on:click="alert('hello')">
        <div class="innerElement">{{ text }}</div>
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
    }
}
</script>
<style scoped>
</style>


