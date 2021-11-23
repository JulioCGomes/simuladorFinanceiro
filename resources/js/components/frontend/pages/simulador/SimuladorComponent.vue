<template>
    <div class="main flex">       
        <formsimulador></formsimulador>
    </div>
</template>

<script>
    import FormSimuladorFinanceiro from './partials/FormSimuladorFinanceiro';

    export default {
        components: {
            formsimulador: FormSimuladorFinanceiro
        }
    }
</script>

<style scoped>
    .main {
        display: flex;
        width: 60%;
        background-color: #e2e8f0;
        padding: 20px 30px;
    }
</style>