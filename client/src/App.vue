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
.nav-link {
	display: inline-block;
}
.container-fluid {
	margin-top: 50px;
}
form > h3 {
	margin-bottom: 20px;
}
.btn {
	background-color: #42b883;
	border-color: #42b883;
}
.btn:hover {
	background-color: #42b883;
	border-color: #42b883;
	transform: translateY(-2px);
}
.nav-link.router-link-exact-active {
	border-bottom: 2px solid #42b883;
}
</style>
