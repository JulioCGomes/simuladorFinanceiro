<template>
    <div>
        <form @submit.prevent="login">
            <div class="relative w-full mb-3">
                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                    E-mail
                </label>
                <input type="email" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" />
            </div>

            <div class="relative w-full mb-3">
                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                    Senha
                </label>
                <input type="password" v-model="formData.password" class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" placeholder="Senha" required="" />
            </div>

            <div class="text-center mt-6">
                <button class="bg-blueGray-800 text-white active:bg-blueGray-600 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full ease-linear transition-all duration-150" type="submit">
                    Acessar
                </button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                formData: {
                    email: '',
                    password: '',
                }
            }
        },

        methods: {
            login () {
                this.$store.dispatch('login', this.formData)
                    .then(response => {
                        /**
                         * Direcionando o usuário ao efetuar o login.
                         */
                        this.$router.push({name: 'admin.dashboard'})

                        /**
                         * Recuperando o nome do usuário logado.
                         */
                        let nomeUsuario = this.$store.state.login.me.name;

                        /**
                         * Mandando uma mensagem ao efetuar o login.
                         */
                        this.$snotify.success(`Seja bem vindo ${nomeUsuario}!`, 'Sucesso');
                    })
                    .catch(error => {
                        /**
                         * Recuperando a mensagem de error ao efetuar login.
                         */
                        let msgError = this.$store.state.login.msg;

                        /**
                         * Mandando uma mensagem de erro se caso não efetuar o login correto.
                         */
                        this.$snotify.error(`Não foi possível realizar o login. Erro: ${msgError}`, 'Erro');
                    })
            }
        }
    }
</script>