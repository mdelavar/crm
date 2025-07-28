<template>
    <div class="border-y py-4 my-5 w-full">
        <div class="ml-auto flex gap-2 items-center">
            <input
                v-model="filters.name"
                class="border-gray-300 py-2 text-sm px-3 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                placeholder="نام و نام خانوادگی"
                @keyup.enter="search"
            />
            <input
                v-model="filters.national_code"
                class="border-gray-300 py-2 text-sm px-3 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                placeholder="کدملی"
                @keyup.enter="search"
            />
            <div class="rounded mr-auto bg-indigo-600 text-white cursor-pointer py-1 px-3 text-sm" @click="search">
                جستجو
            </div>
            <div class="rounded mr-1 bg-rose-800 text-white cursor-pointer py-1 px-3 text-sm"
                 @click="clearFilter"
            >
                لغو فیلتر
            </div>
        </div>

    </div>
</template>

<script>
import {defineComponent} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import TextInput from "@/Components/TextInput.vue";

export default defineComponent({
    name: "Filter",
    components: {TextInput, DangerButton, PrimaryButton},
    props: {
        filters: {
            type: Object,
            required: true,
        },
    },
    emits: ["do-filter"],
    data() {
    },
    watch: {},
    created() {
    },
    methods: {
        search() {
            this.$emit('do-filter');
        },
        clearFilter() {
            this.filters.name = '';
            this.filters.national_code = '';
            this.$emit('do-filter');
        }
    },
});
</script>
<style></style>
