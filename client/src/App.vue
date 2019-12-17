<template>
<div>
	<loader></loader>
    <dmc-header></dmc-header>
    <div class="container-fluid">
		
		<router-view></router-view> 
	</div>
	<Footer></Footer>
</div>
	
</template>

<script>
import Loader from './components/others/Loader'
import Header from './components/Header'
import Footer from './components/Footer'
export default {
	components: {
		dmcHeader: Header,
		loader: Loader,
		Footer: Footer,
	}
	
};
</script>

<style>

:focus {
	outline: none;
}

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
</style>
