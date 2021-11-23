/**
 * Importando o vue para o arquivo de rotas.
 */
import Vue from 'vue'

/**
 * Importando o vue router para o arquivo de rotas.
 */
import VueRouter from 'vue-router'
 
/**
 * Importando o vuex para verificar as rotas.
 */
import store from '../vuex/store';

/**
 * Importando os components
 */
import PrincipalComponent from '../components/frontend/pages/principal/PrincipalComponent'
import MainComponent from '../components/frontend/MainComponent'
import LoginComponent from '../components/frontend/pages/login/LoginComponent'
import SimuladorComponent from '../components/frontend/pages/simulador/SimuladorComponent'

/**
 * Declrando que o vue use o vuerouter para declaração das rotas.
 */
Vue.use(VueRouter);

/**
 * const Declaração das rotas que vai existir no projeto.
 */
const routes = [
    {
        path: '/',
        component: MainComponent,
        name: 'main',
        meta: {
            auth: false
        },
        children: [
            {
                path: '',
                component: PrincipalComponent,
                name: 'frotend.principal'
            },
            {
                path: 'login',
                component: LoginComponent,
                name: 'frotend.login',
            },
            {
                path: '/simulador',
                component: SimuladorComponent,
                name: 'frontend.simulador',
            }
        ]
    },
    /*{
        path: '/admin', 
        component: AdminComponent,
        meta: {
            auth: true
        },
        children: [
            {
                path: '', 
                component: DashboardComponent, 
                name: 'admin.dashboard'
            },

            // Rotas para marcas.
            {
                path: 'marcas', 
                component: SorteioComponent, 
                name: 'admin.marcas'
            },
            {
                path: 'marcas/:id/edit', 
                component: 
                EditSorteioComponent, 
                name: 'admin.marcas.editar'
            },

            // Rotas para veiculos.
            {
                path: 'veiculos', 
                component: SorteioComponent, 
                name: 'admin.veiculos'
            },
            {
                path: 'veiculos/:id/edit', 
                component: 
                EditSorteioComponent, 
                name: 'admin.veiculos.editar'
            },
        ]
    }*/
];

/**
 * Consfigurando dentro do vuerouter as rotas.
 */
const router = new VueRouter({
    routes
});

/**
 * Nessa parte que será feita a restrição.
 */
router.beforeEach((to, from, next) => {
    /**
     * Verificando se a rota "filho" precisa de autenticação
     * com isso vou direcionar para login.
     */
    if (to.meta.auth && !store.state.login.authenticated) {
        store.commit('CHANGE_URL_BACK', to.name)

        return router.push({name: 'login'});
    }

    /**
     * Verificando se a rota "pai" precisa de autenticação
     * com isso vou direcionar para login.
     */
    if (to.matched.some(record => record.meta.auth) && !store.state.login.authenticated) {
        store.commit('CHANGE_URL_BACK', to.name)

        return router.push({name: 'login'});
    }

    /**
     * Verificando se a existe o auth dentro do meta, e
     * verificando se a rota é particular e 
     * a pessoa estiver logado.
     */
    if (to.meta.hasOwnProperty('auth') && !to.meta.auth && store.state.login.authenticated) {        
        return router.push({name: 'admin.dashboard'})
    }

    next();
});

/**
 * Exportando as rotas e chamando dentro do app.js
 */
 export default router