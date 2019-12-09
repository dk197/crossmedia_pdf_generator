<template>
<div>
    <dmc-header></dmc-header>
    <div class="container-fluid">
		<router-view></router-view> 
	</div>
</div>
	
</template>

<script>
import Header from './components/Header'
export default {
	components: {
		dmcHeader: Header
	}
};
</script>

<style>
body {
    color: white;
}
</style>
