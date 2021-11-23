import axios from "axios";

/**
 * Importando URL base para a API
 */
 import { URL_BASE, NAME_TOKEN } from '../../../config/config';

export default {
    state: {
        me: {},
        authenticated: false,
        urlBack: 'admin.dashboard',
        msg: ''
    },

    mutations: {
        LOGIN_USER_OK (state, user) {
            state.authenticated = true,
            state.me = user
        },
        LOGIN_USER_ERRO (state, error) {
            state.authenticated = false,
            state.msg = error
        },
        AUTH_USER_LOGOUT (state) {
            state.me = {},
            state.authenticated = false,
            state.urlBack = 'login'
        },
        CHANGE_URL_BACK (state, url) {
            state.urlBack = url
        }
    },

    actions: {
        login (context, params) {
            return new Promise((resolve, reject) => {
                axios.post(`${URL_BASE}/login`, params)
                    .then(response => {
                        /**
                         * Inserindo os dados do usuário dentro dos mutations
                         */
                        context.commit('LOGIN_USER_OK', response.data.data.usuario)
                        
                        /**
                         * Guardando o token.
                         */
                        const token = response.data.data.token;

                        /**
                         * Armazenando token no store do navegador.
                         */
                        localStorage.setItem(NAME_TOKEN, token);

                        /**
                         * Incluindo o token dentro do axios.
                         */
                        window.axios.defaults.headers.common['Authorization'] = `Bearer ${token}`

                        /**
                         * Decretando o final da promisse.
                         */
                        resolve();
                    })
                    .catch(error => {
                        /**
                         * Inserindo no mutations a mensagem de erro do usuário.
                         */
                        context.commit('LOGIN_USER_ERRO', error.response.data.msg)

                        /**
                         * Finalizando o promisse.
                         */
                        reject(error);
                    })
            })
        },

        checkLogin (context) {
            return new Promise((resolve, reject) => {
                const token = localStorage.getItem(NAME_TOKEN);
                
                if (!token) {
                    return reject();
                }

                axios.get(`${URL_BASE}/me`)
                    .then(response => {
                        context.commit('LOGIN_USER_OK', response.data.data);
                        
                        resolve();
                    })
                    .catch(() => reject())
            });
        },

        logout (context) {
            localStorage.removeItem(NAME_TOKEN);

            /**
             * Implementar depois pegar o token e invalidar.
             */

            /**
             * Resetando todos os itens novamente.
             */
            context.commit('AUTH_USER_LOGOUT')
        },
    }
}