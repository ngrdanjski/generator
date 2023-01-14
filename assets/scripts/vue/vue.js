import Vue from 'vue'
import Cookie from "./components/cookie/Cookie"

export default new Vue({
    el: '#app',
    components: {
        'cookie': Cookie,
    }
});
