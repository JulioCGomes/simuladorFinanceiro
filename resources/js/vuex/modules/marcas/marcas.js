import axios from "axios";

/**
 * Importando URL base para a API
 */
import { URL_BASE, NAME_TOKEN } from '../../../config/config';

export default {
    state: {
        items: {
            data: []
        },
    },
    mutations: {
        LOAD_MARCAS (state, marcas) {
            state.items = marcas
        }
    },
    actions: {
        loadMarcas (context, params) {
            return new Promise((resolve, reject) => {
                axios.get(`${URL_BASE}/marcas`)
                    .then(response => {
                        context.commit('LOAD_MARCAS', response.data)
                        // resolve(response.data.data)
                    })
                    .catch(error => {
                        reject(error)
                    })
                    .finally()
            });
        },
    }
}