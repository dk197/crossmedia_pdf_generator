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

@font-face { font-family: "DejaVuSansCondensed"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/DejaVuSansCondensed.ttf") format('truetype'); }
@font-face { font-family: "DejaVuSansCondensed-Bold"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/DejaVuSansCondensed-Bold.ttf") format('truetype'); }
@font-face { font-family: "DejaVuSansCondensed-Oblique"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/DejaVuSansCondensed-Oblique.ttf") format('truetype'); }
@font-face { font-family: "DejaVuSansCondensed-BoldOblique"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/DejaVuSansCondensed-BoldOblique.ttf") format('truetype'); }
@font-face { font-family: "DejaVuSans"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/DejaVuSans.ttf") format('truetype'); }
@font-face { font-family: "DejaVuSans-Bold"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/DejaVuSans-Bold.ttf") format('truetype'); }
@font-face { font-family: "DejaVuSans-Oblique"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/DejaVuSans-Oblique.ttf") format('truetype'); }
@font-face { font-family: "DejaVuSans-BoldOblique"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/DejaVuSans-BoldOblique.ttf") format('truetype'); }
@font-face { font-family: "DejaVuSerif"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/DejaVuSerif.ttf") format('truetype'); }
@font-face { font-family: "DejaVuSerif-Bold"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/DejaVuSerif-Bold.ttf") format('truetype'); }
@font-face { font-family: "DejaVuSerif-Italic"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/DejaVuSerif-Italic.ttf") format('truetype'); }
@font-face { font-family: "DejaVuSerif-BoldItalic"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/DejaVuSerif-BoldItalic.ttf") format('truetype'); }
@font-face { font-family: "DejaVuSerifCondensed"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/DejaVuSerifCondensed.ttf") format('truetype'); }
@font-face { font-family: "DejaVuSerifCondensed-Bold"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/DejaVuSerifCondensed-Bold.ttf") format('truetype'); }
@font-face { font-family: "DejaVuSerifCondensed-Italic"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/DejaVuSerifCondensed-Italic.ttf") format('truetype'); }
@font-face { font-family: "DejaVuSerifCondensed-BoldItalic"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/DejaVuSerifCondensed-BoldItalic.ttf") format('truetype'); }
@font-face { font-family: "DejaVuSansMono"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/DejaVuSansMono.ttf") format('truetype'); }
@font-face { font-family: "DejaVuSansMono-Bold"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/DejaVuSansMono-Bold.ttf") format('truetype'); }
@font-face { font-family: "DejaVuSansMono-Oblique"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/DejaVuSansMono-Oblique.ttf") format('truetype'); }
@font-face { font-family: "DejaVuSansMono-BoldOblique"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/DejaVuSansMono-BoldOblique.ttf") format('truetype'); }
@font-face { font-family: "FreeSans"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/FreeSans.ttf") format('truetype'); }
@font-face { font-family: "FreeSansBold"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/FreeSansBold.ttf") format('truetype'); }
@font-face { font-family: "FreeSansOblique"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/FreeSansOblique.ttf") format('truetype'); }
@font-face { font-family: "FreeSansBoldOblique"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/FreeSansBoldOblique.ttf") format('truetype'); }
@font-face { font-family: "FreeSerif"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/FreeSerif.ttf") format('truetype'); }
@font-face { font-family: "FreeSerifBold"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/FreeSerifBold.ttf") format('truetype'); }
@font-face { font-family: "FreeSerifItalic"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/FreeSerifItalic.ttf") format('truetype'); }
@font-face { font-family: "FreeSerifBoldItalic"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/FreeSerifBoldItalic.ttf") format('truetype'); }
@font-face { font-family: "FreeMono"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/FreeMono.ttf") format('truetype'); }
@font-face { font-family: "FreeMonoBold"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/FreeMonoBold.ttf") format('truetype'); }
@font-face { font-family: "FreeMonoOblique"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/FreeMonoOblique.ttf") format('truetype'); }
@font-face { font-family: "FreeMonoBoldOblique"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/FreeMonoBoldOblique.ttf") format('truetype'); }
@font-face { font-family: "ocrb10"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/ocrb10.ttf") format('truetype'); }
@font-face { font-family: "Abyssinica_SIL"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/Abyssinica_SIL.ttf") format('truetype'); }
@font-face { font-family: "AboriginalSansREGULAR"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/AboriginalSansREGULAR.ttf") format('truetype'); }
@font-face { font-family: "Jomolhari"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/Jomolhari.ttf") format('truetype'); }
@font-face { font-family: "TaiHeritagePro"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/TaiHeritagePro.ttf") format('truetype'); }
@font-face { font-family: "lannaalif-v1-03"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/lannaalif-v1-03.ttf") format('truetype'); }
@font-face { font-family: "DBSILBR"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/DBSILBR.ttf") format('truetype'); }
@font-face { font-family: "Garuda"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/Garuda.ttf") format('truetype'); }
@font-face { font-family: "Garuda-Bold"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/Garuda-Bold.ttf") format('truetype'); }
@font-face { font-family: "Garuda-Oblique"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/Garuda-Oblique.ttf") format('truetype'); }
@font-face { font-family: "Garuda-BoldOblique"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/Garuda-BoldOblique.ttf") format('truetype'); }
@font-face { font-family: "KhmerOS"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/KhmerOS.ttf") format('truetype'); }
@font-face { font-family: "Dhyana-Regular"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/Dhyana-Regular.ttf") format('truetype'); }
@font-face { font-family: "Dhyana-Bold"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/Dhyana-Bold.ttf") format('truetype'); }
@font-face { font-family: "Tharlon-Regular"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/Tharlon-Regular.ttf") format('truetype'); }
@font-face { font-family: "Padauk-book"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/Padauk-book.ttf") format('truetype'); }
@font-face { font-family: "ZawgyiOne"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/ZawgyiOne.ttf") format('truetype'); }
@font-face { font-family: "ayar"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/ayar.ttf") format('truetype'); }
@font-face { font-family: "TaameyDavidCLM-Medium"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/TaameyDavidCLM-Medium.ttf") format('truetype'); }
@font-face { font-family: "damase_v.2"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/damase_v.2.ttf") format('truetype'); }
@font-face { font-family: "LateefRegOT"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/LateefRegOT.ttf") format('truetype'); }
@font-face { font-family: "UnBatang_0613"; src: url("../../api/vendor/mpdf/mpdf/ttfonts/UnBatang_0613.ttf") format('truetype'); }
</style>
