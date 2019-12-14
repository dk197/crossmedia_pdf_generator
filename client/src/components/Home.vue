<template>
    <div>
        <div class="area">
            <div class="container">
        <div class="right-bg">
        </div>
        <div class="left-bg">
        </div>
    </div>
            <!-- <ul class="circles">
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
            </ul> -->
        </div>
        
    </div>
</template>


<style scoped>


*{
    margin: 0px;
    padding: 0px;
}


.context {
    width: 100%;
    position: absolute;
    top:50vh;
    
}

.context h1{
    text-align: center;
    color: #fff;
    font-size: 50px;
}


.area{
    background: #343a40;  
    width: 100%;
    height:100vh;
    
   
}

.circles{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    
}

.circles li{
    position: absolute;
    display: block;
    list-style: none;
    width: 20px;
    height: 20px;
    background: rgba(255, 255, 255, 0.2);
    animation: animate 25s linear infinite;
    bottom: -150px;
    
}

.circles li:nth-child(1){
    left: 25%;
    width: 80px;
    height: 80px;
    animation-delay: 0s;
}


.circles li:nth-child(2){
    left: 10%;
    width: 20px;
    height: 20px;
    animation-delay: 2s;
    animation-duration: 12s;
}

.circles li:nth-child(3){
    left: 70%;
    width: 20px;
    height: 20px;
    animation-delay: 4s;
}

.circles li:nth-child(4){
    left: 40%;
    width: 60px;
    height: 60px;
    animation-delay: 0s;
    animation-duration: 18s;
}

.circles li:nth-child(5){
    left: 65%;
    width: 20px;
    height: 20px;
    animation-delay: 0s;
}

.circles li:nth-child(6){
    left: 75%;
    width: 110px;
    height: 110px;
    animation-delay: 3s;
}

.circles li:nth-child(7){
    left: 35%;
    width: 150px;
    height: 150px;
    animation-delay: 7s;
}

.circles li:nth-child(8){
    left: 50%;
    width: 25px;
    height: 25px;
    animation-delay: 15s;
    animation-duration: 45s;
}

.circles li:nth-child(9){
    left: 20%;
    width: 15px;
    height: 15px;
    animation-delay: 2s;
    animation-duration: 35s;
}

.circles li:nth-child(10){
    left: 85%;
    width: 150px;
    height: 150px;
    animation-delay: 0s;
    animation-duration: 11s;
}



@keyframes animate {

    0%{
        transform: translateY(0) rotate(0deg);
        opacity: 1;
        border-radius: 0;
    }

    100%{
        transform: translateY(-1000px) rotate(720deg);
        opacity: 0;
        border-radius: 50%;
    }

}
.container {
  position: relative;
  background-color:#343a40;
  margin: 40px auto;
  width: 80%;
  height: 360px;
}
.left-bg{
  position: absolute;
  top: 0;
  bottom: 0;
  width: 77%;
  transition: .75s ease;
  z-index: 9999;
}

.right-bg{
  position: absolute;
  top: 0;
  bottom: 0;
  width: 23%;
  transition: .75s ease;
  z-index: 9999;
}

.left-bg {
  background-image: url('../assets/left.png');
  left: 0;
}
.right-bg {
  background-image: url('../assets/right.png');
  background-position: right;
  right: 0;
}
.right-bg:before {
  content: "OR";
  font-weight: bold;
  position: absolute;
  background: white;
  text-align: center;
  width: 30px;
  height: 30px;
  line-height: 30px;
  border-radius: 15px;
  top: 150px;
  left: 0;
  -webkit-transform: translate(-50%, -50%);
}
.right-bg:after {
  content: "";
  height: 280px;
  width: 1px;
  background-color: white;
  display: block;
  position: absolute;
  left: 0;
  right: 0;
  top: 20px;
}
.right-bg:after {
  right: 0;
}
.left-bg:hover {
  width: 77%;
}
.left-bg:hover + .right-bg {
  width: 23%;
}
.right-bg:hover {
  width: 100%;
}
.right-bg:hover + .left-bg {
  width: 0%;
  display:none;
}
</style>