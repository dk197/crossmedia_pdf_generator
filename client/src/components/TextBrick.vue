<template>
    <drag-it-dude id="visitcardParent">
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
            default: '12px'
        },
        fontStyle: {
            default: 'Futura'
        },
        fontColor: {
            default: 'black'
        },
        fontURL:{
            default: ''
        }
    },
    components: {
        DragItDude
    }
}
</script>
<style scoped>

</style>


