Nova.booting((Vue, router, store) => {
    Vue.component('index-belongs-to-many-tags', require('./components/IndexField'))
    Vue.component('detail-belongs-to-many-tags', require('./components/DetailField'))
    Vue.component('form-belongs-to-many-tags', require('./components/FormField'))
})
