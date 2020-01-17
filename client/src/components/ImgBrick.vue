<template>
    <drag-it-dude id="visitcardParent">
        <div class="innerElement"><img src="https://qrickit.com/api/qr.php?d=BEGIN%3aVCARD%0d%0aVERSION%3a3.0%0d%0aN%3aDoe%3bJohn%0d%0aORG%3aABC+Co.%0d%0aTITLE%3aPresident%0d%0aEMAIL%3ajohndoe%40email" >{{ img }}</div>
    </drag-it-dude>

</template>
<script>
import DragItDude from 'vue-drag-it-dude';
export default{
    props: {
        img: {
            required: true
        },
        src: {

        },
        width: {
            default: '30px'
        }
    },
    components: {
        DragItDude
    }
}
</script>
<style scoped>

</style>


