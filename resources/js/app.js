//importamos vuetifi
import Vuetify from 'vuetify';

//importamos rutas vue
import router from './router'

require('./bootstrap');

window.Vue = require('vue');
Vue.use(Vuetify);

//creamos componentes
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('evento',require('./components/Eventos.vue').default);


const app = new Vue({
    router,
    el: '#app',
    vuetify: new Vuetify(),
});
