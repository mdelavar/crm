<template>
    <Card class="p-4 mb-5">
        <div class="ml-auto flex gap-2 items-center flex-wrap max-sm:space-y-3">
            <input
                v-model="filter.name"
                placeholder="عنوان"
                @keyup.enter="doFilter"
                class=" shadow mx-2 appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                type="text">
            <input
                v-model="filter.en_name"
                @keyup.enter="doFilter"
                placeholder="عنوان انگلیسی"
                class=" shadow mx-2 appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                type="text">
            <div class="flex-1">
                <TailSelect
                    v-model="filter.product_category_id"
                    :options="{
                            search: true,
                            searchFocus: true,
                            sourceBind: true,
                            placeholder: 'دسته بندی محصول',
                          }"

                >
                    <option></option>
                    <option
                        v-for="(item , index) in categories"
                        :key="index"
                        :value="item.id"
                        class="text-center"
                        :selected="filter.product_category_id === item.id"
                    >
                        {{ item.title }}
                    </option>
                </TailSelect>
            </div>
            <PrimaryButton @click="doFilter()"
            >جستجو
            </PrimaryButton>
            <DangerButton class="mx-1" @click="clearFilter()"
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
    props: {
        categories: {
            type: Object,
            default: null,
        }
    },
    components: {
        DangerButton,
        PrimaryButton,
        Card,
    },
    data() {
        return {
            filter: {
                name: '',
                en_name: '',
                product_category_id: null,
            },
        };
    },
    watch: {},
    created() {
    },
    methods: {
        clearFilter() {
            this.filter.name = '';
            this.filter.en_name = '';
            this.filter.product_category_id = null;

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
</style>
