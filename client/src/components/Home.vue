<template>
  <div>
    <Slider></Slider>
    <Tabs></Tabs>
  </div>
</template>

<script>
import Tabs from './Landingpage/Tabs'
import Slider from './Landingpage/Slider'
export default {
    components: {
        Tabs, 
        Slider
    }
}
</script>


<style scoped>
button:focus,
input:focus,
textarea:focus,
select:focus {
  outline: none;
}
</style>