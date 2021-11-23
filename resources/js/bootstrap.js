import { NAME_TOKEN } from './config/config'

window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const token = localStorage.getItem(NAME_TOKEN)
if (token) {
    window.axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
}