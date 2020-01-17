<template>
    <drag-it-dude id="visitcardParent"> 
        <div class="innerElement"><img :src="src" :width="width" :style="show"></div>
    </drag-it-dude>

</template>
<script>
import DragItDude from 'vue-drag-it-dude';
export default{
    props: {
        src: {
            default: '',
            required: true
        },
        show: {
            default: ''
        },
        width: {
            default: '50px'
        }
    },
    components: {
        DragItDude
    }
}
</script>
<style scoped>

</style>


