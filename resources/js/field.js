Nova.booting((Vue, router, store) => {
    Vue.component('index-belongs-to-many-field', require('./components/IndexField'))
    Vue.component('detail-belongs-to-many-field', require('./components/DetailField'))
    Vue.component('form-belongs-to-many-field', require('./components/FormField'))
})
