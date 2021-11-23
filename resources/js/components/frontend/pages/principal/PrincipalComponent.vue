<template>
    <div class="main flex">
        <!--
            <router-link :to="{name: 'frotend.login'}" v-slot="{ href, navigate }">
                <a :href="href" @click="navigate" class="button-customizado">
                    Login
                </a>
            </router-link>
        -->

        <router-link :to="{name: 'frontend.simulador'}" v-slot="{ href, navigate }">
            <a :href="href" @click="navigate" class="button-customizado">
                Simulador Financeiro
            </a>
        </router-link>
    </div>
</template>

<script>
    export default {

    }
</script>

<style scoped>
    .main {
        display: flex;
        width: 60%;
        background-color: #e2e8f0;
        padding: 20px 30px;
    }
    .button-customizado {
        background-color: #1e293b;
        color: #e2e8f0;
        padding: 10px 30px;
        margin-left: 10px;
        width: 100%;
        text-transform: uppercase;
        transition: all .3s linear;
        font-weight: 600;
        border: 1px solid #1e293b;
        text-align: center;
    }
    .button-customizado:hover {
        background-color: #e2e8f0;
        color: #1e293b;
    }
</style>