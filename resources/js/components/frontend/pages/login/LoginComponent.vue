<template>
    <div style="width:60%">
        <section class="relative w-full h-full min-h-screen">

            <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-200 border-0">
                <div class="rounded-t mb-0 px-6 py-6">
                    <div class="text-center mb-3">
                        <h6 class="text-blueGray-500 text-sm font-bold">
                            Login Superbolao
                        </h6>
                    </div>
                    <hr class="mt-6 border-b-1 border-blueGray-300" />
                </div>
                <div class="flex-auto px-4 lg:px-10 py-10 pt-0">                               
                    <FormLogin />
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import FormLoginComponent from './partials/FormLogin';

    export default{
        data() {

        },
        components: {
            FormLogin: FormLoginComponent
        }
    };
</script>

<style scoped>
    .main {
        background-color: #1e293b;
    }
</style>
