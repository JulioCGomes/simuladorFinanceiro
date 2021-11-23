/**
 * Arquivo para gerenciar o status da aplicação.
 */

/**
 * Importando o vue
 */
import Vue from 'vue'

/**
 * Importando o pacote do vuex.
 */
import Vuex from 'vuex'

/**
 * Importando os itens que vou utilizar dentro do projeto.
 */
import login from './modules/login/login'
import Marcas from './modules/marcas/marcas'
import Veiculos from './modules/veiculos/veiculos'

/**
 * Vue utilizando o vuex
 */
Vue.use(Vuex);

/**
 * Função para gerenciar os status por modules.
 */
const store = new Vuex.Store({
    modules: {
        marcas: Marcas,
        veiculos: Veiculos,
        login
    }
});

export default store
 