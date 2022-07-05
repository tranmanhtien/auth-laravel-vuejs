window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import $ from 'jquery';
window.$ = window.jQuery = $;

import 'bootstrap';


import Vue from "vue";
window.Vue = Vue;
Vue.component('login', require('./components/Auth/Login').default);


import ApiLocation from "./common/api-location";

Vue.prototype.$apiLocation = ApiLocation;
Vue.prototype.$clearErrors = () => {
    window.__validationErrors = {}
}

Vue.prototype.$error = field => {
    try {
        return window.__validationErrors[field][0];
    } catch {

    }
}


import bootbox from 'bootbox';

bootbox.setDefaults({
    closeButton: false
});
window.bootbox = bootbox;


const app = new Vue({
    el: '#app'
})

const httpErrorInterceptor = function (error) {
    if (error.response) {

        switch (error.response.status) {
            case 401:
                bootbox.confirm('Session expired. Do you want to reload the page to login?', res => {
                    if (res) {
                        location.reload();
                    }
                });
                break;
            case 403 :
                window.location.href = "/403";
                break;
            case 404 :
                bootbox.alert(error.response.data.message, () => {
                    window.location.href = '/404';
                });
                break;
            case 500 :
                bootbox.alert('Internal Server Error');
                break;
            case 422:
                if (error.response.data.errors) {
                    window.__validationErrors = error.response.data.errors;
                }
                break;
            default:
                break;
        }
    } else {
        bootbox.alert('Server has no response', () => {
            location.reload();
        })
    }

    return Promise.reject(error);
}

window.axios.interceptors.response.use(function (response) {
    return response;
}, httpErrorInterceptor);
