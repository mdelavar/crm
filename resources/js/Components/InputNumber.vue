<template>
    <input
        type="text"
        :value="formattedValue"
        @input="onInput"
        @keydown="preventInvalidKeys"
        :placeholder="placeholder"
        class="shadow appearance-none border rounded-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
    />
</template>

<script>
export default {
    name: 'InputNumber',
    props: {
        modelValue: {
            type: [String, Number],
            default: '',
        },
        placeholder: {
            type: String,
            default: '',
        },
    },
    computed: {
        formattedValue() {
            if (!this.modelValue) return ''
            return Number(this.modelValue).toLocaleString('en-US')
        },
    },
    methods: {
        onInput(event) {
            const val = event.target.value
            const onlyNumbers = val.replace(/[^\d]/g, '')
            this.$emit('update:modelValue', onlyNumbers)
        },
        preventInvalidKeys(e) {
            const allowedKeys = [
                'Backspace', 'ArrowLeft', 'ArrowRight', 'Delete', 'Tab',
            ]
            const isNumber = /^[0-9]$/.test(e.key)

            if (!isNumber && !allowedKeys.includes(e.key)) {
                e.preventDefault()
            }
        },
    },
}
</script>
