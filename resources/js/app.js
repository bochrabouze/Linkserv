/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import '@mdi/font/css/materialdesignicons.css'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify)
import fr from 'vuetify/es5/locale/fr'
import Dashboard from './views/Dashboard'
import Products from './views/Products'


// Permis
//import Permis from './permis/Permis'

// Forfait
import Forfait from './forfait/Forfait'
import Application from './application/Application'
import Profileapplicant from './profileapplicant/Profileapplicant'
import Profileservant from './profileservant/Profileservant'
import Applicationapplicant from './applicationapplicant/Applicationapplicant'
import Detailapplication from './detailapplication/Detailapplication'
import Applicant from './applicant/Applicant'
import Service from './service/Service'
import Servant from './servant/Servant'
import Detailservice from './detailservice/Detailservice'
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue'));

Vue.component('app-init', require('./AppInit.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const router = new VueRouter({
    mode: 'history',
    routes: [
       
        // {
        //     path: '/permis',
        //     name: 'permis',
        //     component: Permis,
        // },
        {
            path: '/forfait',
            name: 'forfait',
            component: Forfait,
        },

        {
            path: '/application',
            name: 'application',
            component: Application,
        },

        {
            path: '/profileapplicant',
            name: 'profileapplicant',
            component: Profileapplicant,
        },

        {
            path: '/profileservant',
            name: 'profileservant',
            component: Profileservant,
        },

        {
            path: '/applicationapplicant',
            name: 'applicationapplicant',
            component: Applicationapplicant,
        },

        {
            path: '/applicant',
            name: 'applicant',
            component: Applicant,
        },

        {
            path: '/detailapplication',
            name: 'detailapplication',
            component: Detailapplication,
        },

        {
            path: '/service',
            name: 'service',
            component: Service,
        },

        {
            path: '/servant',
            name: 'servant',
            component: Servant,
        },

        {
            path: '/detailservice',
            name: 'detailservice',
            component: Detailservice,
        },







        
    ],
});



const app = new Vue({
    el: '#app',
    router,
    vuetify: new Vuetify({
        lang: {
          locales: { fr },
          current: 'fr',
        },
      }),

   

});
