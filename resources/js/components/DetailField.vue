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
			if (!this.field.value) {
				return;
            }

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
        padding: 2px 10px 2px 10px;
        margin: 0 0 5px 5px;
        border-radius: 3px;
        background: #41b883;
        white-space: nowrap;
        text-overflow: ellipsis;
        font-size: 14px;
    }
</style>
