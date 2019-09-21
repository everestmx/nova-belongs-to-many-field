<template>
    <panel-item :field="field">
        <template slot="value">
            <span v-for="(value, i) of values" v-if="values" class="btmf_item">{{ value }}</span>
            <span v-else>—</span>
        </template>
    </panel-item>
</template>

<script>
export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],

    computed: {
		values() {
			return this.field.value.map(val => val[this.field.optionsLabel || 'name']).filter(val => !!val);
		},
    }
}
</script>

<style>
    .btmf_item {
        color: #fff;
        position: relative;
        display: inline-block;
        padding: 4px 10px 4px 10px;
        border-radius: 5px;
        margin-right: 10px;
        background: #41b883;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
