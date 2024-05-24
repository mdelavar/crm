<template>
    <Card class="p-4 mb-4">
        <div class="flex items-center w-full">
            <input
                v-model="filter.name"
                placeholder="عنوان"
                class=" shadow mx-2 appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                type="text">
            <PrimaryButton @click="doFilter()"
            >جستجو
            </PrimaryButton>
            <DangerButton class="mx-3" @click="clearFilter()"
            >لغو فیلتر
            </DangerButton>
        </div>
    </Card>
</template>

<script>
import {defineComponent} from "vue";
import Card from "@/Components/Card.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";

export default defineComponent({
    name: "Filter",
    emits: ['search-items'],
    components: {
        DangerButton,
        PrimaryButton,
        Card,
    },
    data() {
        return {
            filter: {
                name: '',
            },
        };
    },
    watch: {},
    created() {
    },
    methods: {
        clearFilter() {
            this.filter.name = '';
            this.$emit("search-items", this.filter);
        },
        doFilter() {
            this.$emit("search-items", this.filter);
        },
    },
});
</script>
<style>
.filter .vpd-icon-btn {
    display: none;
}

.filter .vpd-input-group .form-control {
    padding: 0 10px;
    text-align: center;
    margin-top: 0;
    border-right: 1px solid #dadada !important;
    border-top-right-radius: 0.375rem !important;
    border-bottom-right-radius: 0.375rem !important;
}

.label-inner,
.dropdown-option {
    text-align: center !important;
}
</style>
