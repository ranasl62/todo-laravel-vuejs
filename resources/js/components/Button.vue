<template>
    <button @click="onClick()" :style="{ background: color }" :class="['btn', ...(classNames||[])]">
        {{ text }}
    </button>
</template>

<script>
export default {
    name: 'Button',
    props: {
        text: String,
        color: String,
        classNames: Array,
    },
    methods: {
        onClick() {
            this.$emit('btn-click')
        },
    },
}
</script>
