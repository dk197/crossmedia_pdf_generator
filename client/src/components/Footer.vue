<template>
    <div class="footer">
        <div class="footer-left">
             <a class="logo-link" href="/#/"><img class="logo" src="../assets/logograu.svg" ></a>
        </div>
        <div class="footer-right">
            <router-link class="footer-link" to="impressum" active-class="active" exact>Impressum</router-link>
        </div>
    </div>
</template>

<style scoped>
    .footer {
        background-color: #42b883;
        display: flex;
        height: 150px;
        position: absolute;
        bottom: 0px;
        width: 100%;
        padding: 0.5rem 10%;
    }
    
    .logo {
        height: 120px;
    }

    .footer-left, .footer-right {
        width: 50%;
    }

    .footer-link {
        color: #212529;
        font-size: 20px;
        display: flex;
        justify-content: flex-end;
        margin-top: 50px;
    }
</style>