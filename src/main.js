import Vue from 'vue'
import App from './App.vue'

// CSP compliant generic app mount
Vue.mixin({
    methods: {
        t(app, string) {
            return string
        },
        n(app, singular, plural, count) {
            return count === 1 ? singular : plural
        }
    }
})

new Vue({
    el: '#app-content',
    render: h => h(App)
})
