<template>
<div>
	<loader></loader>
    <dmc-header></dmc-header>
    <div class="container-fluid">
		
		<router-view></router-view> 
	</div>
</div>
	
</template>

<script>
import Loader from './components/others/Loader'
import Header from './components/Header'
export default {
	components: {
		dmcHeader: Header,
		loader: Loader	
	}
	
};
</script>

<style>
body {
    color: white;
}

</style>
