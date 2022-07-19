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

import Vue from "vue";
window.Vue = Vue;
Vue.component('login', require('./components/Auth/Login').default);
Vue.component('register', require('./components/Auth/Register').default);
Vue.component('forget_password', require('./components/Auth/ForgetPassword').default);
Vue.component('reset_password', require('./components/Auth/ResetPassword').default);


import ApiLocation from "./common/api-location";
import {StatusCode} from "./common/status_code";

Vue.prototype.$apiLocation = ApiLocation;
Vue.prototype.$statusCode = StatusCode;
Vue.prototype.$clearErrors = () => {
    window.__validationErrors = {}
}

Vue.prototype.$error = field => {
    try {
        return window.__validationErrors[field][0];
    } catch {

    }
}

import 'bootstrap';
var bootbox = require('bootbox');

bootbox.setDefaults({
    closeButton: false,
    centerVertical: true,
    onShow: function (e) {
        setTimeout(function () {
            $("button").trigger("blur");
        }, 500);
    }
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
                console.log(error.response);
                bootbox.alert(error.response.data.message, () => {
                    $(window).unbind('beforeunload');
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



// toast
import Toast from "vue-toastification";
// Import the CSS or use your own!
import "vue-toastification/dist/index.css";
const options = {
    // You can set your default options here
};
Vue.use(Toast, options);
// Vue.mixin(require('./asset'));
