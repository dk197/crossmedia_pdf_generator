<template>
<div class="wrapper">
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
html, body {
	height: 100%;
}

.wrapper {
	position: relative;
    min-height: 100%;
    height: auto !important;
    height: 100%;
}

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
	padding-bottom: 150px;
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

@font-face { font-family: "dejavusanscondensed"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/DejaVuSansCondensed.ttf") format('truetype'); }
@font-face { font-family: "dejavusans"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/DejaVuSans.ttf") format('truetype'); }
@font-face { font-family: "dejavuserif"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/DejaVuSerif.ttf") format('truetype'); }
@font-face { font-family: "dejavuserifcondensed"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/DejaVuSerifCondensed.ttf") format('truetype'); }
@font-face { font-family: "dejavusansmono"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/DejaVuSansMono.ttf") format('truetype'); }
@font-face { font-family: "freesans"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/FreeSans.ttf") format('truetype'); }
@font-face { font-family: "freeserif"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/FreeSerif.ttf") format('truetype'); }
@font-face { font-family: "freemono"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/FreeMono.ttf") format('truetype'); }
@font-face { font-family: "ocrb"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/ocrb10.ttf") format('truetype'); }
@font-face { font-family: "abyssinicasil"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/Abyssinica_SIL.ttf") format('truetype'); }
@font-face { font-family: "aboriginalsans"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/AboriginalSansREGULAR.ttf") format('truetype'); }
@font-face { font-family: "jomolhari"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/Jomolhari.ttf") format('truetype'); }
@font-face { font-family: "taiheritagepro"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/TaiHeritagePro.ttf") format('truetype'); }
@font-face { font-family: "lannaalif"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/lannaalif-v1-03.ttf") format('truetype'); }
@font-face { font-family: "daibannasilbook"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/DBSILBR.ttf") format('truetype'); }
@font-face { font-family: "garuda"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/Garuda.ttf") format('truetype'); }
@font-face { font-family: "khmeros"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/KhmerOS.ttf") format('truetype'); }
@font-face { font-family: "dhyana"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/Dhyana-Regular.ttf") format('truetype'); }
@font-face { font-family: "tharlon"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/Tharlon-Regular.ttf") format('truetype'); }
@font-face { font-family: "padaukbook"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/Padauk-book.ttf") format('truetype'); }
@font-face { font-family: "zawgyi-one"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/ZawgyiOne.ttf") format('truetype'); }
@font-face { font-family: "ayar"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/ayar.ttf") format('truetype'); }
@font-face { font-family: "taameydavidclm"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/TaameyDavidCLM-Medium.ttf") format('truetype'); }
@font-face { font-family: "mph2bdamase"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/damase_v.2.ttf") format('truetype'); }
@font-face { font-family: "lateef"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/LateefRegOT.ttf") format('truetype'); }
@font-face { font-family: "unbatang"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/UnBatang_0613.ttf") format('truetype'); }
</style>
