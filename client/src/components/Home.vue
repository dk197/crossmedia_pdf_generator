<template>
    <div class="container">
        <div class="left-bg">
        </div>
        <div class="right-bg">
        </div>
    </div>
</template>

<script>
export default {
    
}
</script>

<style scoped>
.container {
  position: relative;
  background: #f1f1f1;
  margin: 40px auto;
  width: 80%;
  height: 360px;
}
.left-bg{
  position: absolute;
  top: 0;
  bottom: 0;
  width: 77%;
  transition: .25s ease;
}

.right-bg{
  position: absolute;
  top: 0;
  bottom: 0;
  width: 23%;
  transition: .25s ease;
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
  content: " ";
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
}
</style>