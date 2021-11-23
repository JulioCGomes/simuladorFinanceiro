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
        LOAD_VEICULOS (state, veiculos) {
            state.items = veiculos
        }
    },
    actions: {
        loadVeiculo (context, id) {
            return new Promise((resolve, reject) => {
                axios.get(`${URL_BASE}/veiculos/${id}`)
                    .then(response => {
                        resolve(response.data.data)
                    })
                    .catch(error => {
                        reject(error)
                    })
                    .finally()
            });
        },
        loadVeiculoMarca (context, id) {
            return new Promise((resolve, reject) => {
                axios.get(`${URL_BASE}/veiculos/marca/${id}`)
                    .then(response => {
                        resolve(response.data.data)
                    })
                    .catch(error => {
                        reject(error)
                    })
                    .finally()
            });
        },
        loadSimulacao (context, params) {
            return new Promise((resolve, reject) => {
                axios.post(`${URL_BASE}/simulacao`, params)
                    .then(response => {
                        resolve(response.data.data)
                    })
                    .catch(error => {
                        reject(error)
                    })
                    .finally()
            });
        },
    }
}