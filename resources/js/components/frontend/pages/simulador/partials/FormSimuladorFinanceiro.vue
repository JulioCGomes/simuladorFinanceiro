<template>
    <div class="w-full">
        <form @submit.prevent="onSubmit" class="mb-5">
            <div class="relative w-full mb-3">
                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                    Selecione a marca
                </label>
                <select class="w-full mb-4" @change="onChangeMarca">
                    <option>-</option>
                    <option 
                        v-for="(marca, index) in marcas"
                        :key="index"
                        :value="marca.id"
                    >
                        {{ marca.nome }}
                    </option>
                </select>
            </div>
            <div class="relative w-full mb-3">
                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                    Selecione o veículo
                </label>
                <select class="w-full mb-4" @change="onChangeVeiculo">
                    <option>-</option>
                    <option 
                        v-for="(veiculo, index) in veiculos"
                        :key="index"
                        :value="veiculo.id"
                    >
                        {{ veiculo.nome }}
                    </option>
                </select>
            </div>

            <div class="relative w-full mb-5" v-if="nomeVeiculo">
                <strong>Nome veículo:</strong> {{ nomeVeiculo }} <br/>
                <strong>Valor veículo:</strong> R$ {{ valorVeiculo }}
            </div>

            <div class="relative w-full mb-3" >
                <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                    Simulação de Financiamento:
                </label>
                <input class="w-full" type="text" placeholder="Valor da entrada..." v-model="valorSimulacao" required="">
            </div>

            <button type="submit" class="mx-3 text-white font-bold py-2 px-4 rounded" style="background-color: #1e293b;">
                Simular
            </button>

            <router-link :to="{name: 'frotend.principal'}" v-slot="{ href, navigate }">
                <a :href="href" @click="navigate" class="mx-3 text-white font-bold py-2 px-4 rounded" style="background-color: #1e293b;">
                    Voltar
                </a>
            </router-link>
        </form>

        <div class="relative w-full mb-5" v-if="parcela48">
            <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                Valores simulados para você:
            </label>
            <strong>48x</strong> R$ {{ parcela48 }}<br/>
            <strong>12x</strong> R$ {{ parcela12 }}<br/>
            <strong>6x</strong> R$ {{ parcela06 }}
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                veiculos: {},
                idVeiculo: '',
                nomeVeiculo: '',
                valorVeiculo: '',
                valorSimulacao: null,
                parcela48: null,
                parcela12: null,
                parcela06: null,
            }
        },
        computed: {
            marcas () {
                return this.$store.state.marcas.items.data
            }
        },
        methods: {
            loadMarcas () {
                this.$store.dispatch('loadMarcas', this.filter)
            },
            onChangeMarca (event) {
                this.limparVariavel();

                var idMarca = event.target.value;

                this.loadVeiculoMarca(idMarca);
            },
            loadVeiculoMarca(idMarca){
               this.$store.dispatch('loadVeiculoMarca', idMarca)
                    .then(response => {
                        this.veiculos = response;
                    })
                    .catch()
            },
            onChangeVeiculo(event) {
                var idVeiculo = event.target.value;

                this.loadVeiculo(idVeiculo);
            },
            loadVeiculo(idVeiculo) {
                this.$store.dispatch('loadVeiculo', idVeiculo)
                    .then(response => {
                        this.idVeiculo = response[0].id;
                        this.nomeVeiculo = response[0].nome;
                        this.valorVeiculo = response[0].valor;
                    })
                    .catch()
            },
            onSubmit() {
                if (!this.valorVeiculo) {
                    alert('Selecione o veículo');
                    return;
                }

                this.$store.dispatch('loadSimulacao', {
                    'idVeiculo': this.idVeiculo, 
                    'valorSimulacao': this.valorSimulacao
                }).then(response => {
                    console.log(response);
                    this.parcela48 = response.parcela_48;
                    this.parcela12 = response.parcela_12;
                    this.parcela06 = response.parcela_06;
                }).catch()
            },
            limparVariavel() {
                this.idVeiculo = false;
                this.nomeVeiculo = false;
                this.valorVeiculo = false;
                this.valorSimulacao = null;
                this.parcela48 = null;
                this.parcela12 = null;
                this.parcela06 = null;
            }
        },
        created () {
            this.loadMarcas()
        },
    }
</script>

<style scoped>

</style>