/**
 * Importando a class do bootstrap.
 */
require('./bootstrap');

/**
 * Incluindo o VueJS.
 */
window.Vue = require('vue').default;

/**
 * Importando o vue
 */
import Vue from 'vue';

/**
 * Importando o arquivo de rotas.
 */
import router from './routes/routers'

/**
 * Incluindo o store para gerenciar os states
 */
import store from './vuex/store'

/**
 * Importando o arquivo das minhas rotas
 */
Vue.component('main-component', require('./components/frontend/MainComponent').default)
Vue.component('header-component', require('./components/frontend/layout/HeaderComponent').default)
Vue.component('footer-component', require('./components/frontend/layout/FooterComponent').default)

 /**
 * Incluindo o seletor que irá iniciar e as rotas.
 */
const app = new Vue({
    router,
    store,
    el: '#app'
});