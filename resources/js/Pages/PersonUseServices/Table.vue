<template>
    <div class="relative intro-y p-5">
       <div class="flex justify-between mb-3 items-center md:flex-row flex-col">
            <span class="text-2xl mb-3 md:mb-0">گزارش دریافت خدمات</span>
        </div>
        <Filter @search-items="searchFilters"></Filter>
        <div class="overflow-y-auto border border-themeOverlyPrimary md:rounded-lg">
            <div v-if="services.isLoading" class="flex justify-center mx-auto p-5">
                <LoadingIcon
                    icon="three-dots"
                    color="#000"
                    class="w-10 h-10 z-10 overlay-loading anim-scale-up"
                />
            </div>
            <table v-else class="min-w-full divide-y divide-themeOverlyPrimary table-auto">
                <thead class="bg-themeOverlyPrimary">
                <tr>
                    <th scope="col"
                        class="border border-themeOverlyPrimary py-3.5 px-4 text-sm font-normal text-right rtl:text-right text-themeLightPrimary">
                        نام
                    </th>
                    <th scope="col"
                        class="border border-themeOverlyPrimary py-3.5 px-4 text-sm font-normal text-right rtl:text-right text-themeLightPrimary">
                        سازمان
                    </th>
                    <th scope="col"
                        class="border border-themeOverlyPrimary py-3.5 px-4 text-sm font-normal text-right rtl:text-right text-themeLightPrimary">
                        خدمت
                    </th>
                    <th scope="col"
                        class="border border-themeOverlyPrimary py-3.5 px-4 text-sm font-normal text-right rtl:text-right text-themeLightPrimary">
                        مبلغ(ریال)
                    </th>
                    <th scope="col"
                        class="border border-themeOverlyPrimary py-3.5 px-4 text-sm font-normal text-right rtl:text-right text-themeLightPrimary">
                        اتوسرویس
                    </th>
                    <th scope="col"
                        class="border border-themeOverlyPrimary py-3.5 px-4 text-sm font-normal text-right rtl:text-right text-themeLightPrimary">
                        تاریخ
                    </th>
                </tr>
                </thead>


                <tbody class="bg-white divide-y divide-indigo-200">
                <tr v-for="(item, index) in services.data" class="even:bg-gray-50">
                    <td class="p-2 border">{{ item.organization_people }}</td>
                    <td class="p-2 border">{{ item.organization }}</td>
                    <td class="p-2 border">{{ item.service }}</td>
                    <td class="p-2 border">{{ item.amount.toLocaleString() }}</td>
                    <td class="p-2 border">{{ item.car_service }}</td>
                    <td class="p-2 border">{{ item.create_date_label }}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <Pagination
            v-if="hasPagination"
            class="intro-y box mt-3"
            :class="services.data.length"
            :paginate="paginate"
            :counter="paginate.meta.per_page"
            :pass-page-number="true"
            @get_items="reload"
        />
    </div>

    <Modal @close="showModal = false" :show="showModal" max-width="2xl" :closeable="false">
        <EntryForm @close="showModal = false" @reload="reload" :edit_items="edit_items"/>
    </Modal>

</template>

<script>
import {defineComponent} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Modal from "@/Components/Modal.vue";
import EntryForm from "./entryForm.vue";
import LoadingIcon from "@/Components/loading-icon/Main.vue";
import Pagination from "@/Components/pagination/Main.vue";
import Filter from "./filter.vue";

export default defineComponent({
    components: {Filter, Pagination, LoadingIcon, EntryForm, Modal, PrimaryButton},
    props: {},

    data() {
        return {
            edit_items: {},
            showModal: false,
            services: {
                isLoading: false, data: {},
            },
            paginate: {
                links: [],
                meta: [],
            },
        };
    },
    created() {
        this.reload(1, false);
    },
    computed: {
        hasPagination() {
            return this.paginate.meta.per_page < this.paginate.meta.total;
        },
    },
    watch: {},
    methods: {
        searchFilters(filter) {
            this.services.isLoading = true;
            this.axios
                .get(`/personUseCredit`, {
                    params: {
                        filter : {
                            'organization_people.name' : filter.name,
                            'organization_people.organization.name' : filter.organization,
                            'car_service.name' : filter.car_service,
                            'service.name' : filter.service,
                        },
                        page: 1,
                        limit: 25,
                    }
                })
                .then(({data}) => {
                    this.services.isLoading = false;
                    this.services.data = data.data
                    this.paginate.links = data.links;
                    this.paginate.meta = data.meta;
                })
                .finally(() => {
                });
        },
        clearForm() {
            this.edit_items = {};
            this.showModal = true;
        },
        updateForm(item) {
            this.showModal = true;
            this.edit_items = item;
        },
        reload(page = 1, submit_new) {
            this.services.isLoading = true;
            this.axios
                .get(`/personUseCredit`, {
                    params: {
                        page,
                        limit: 25,
                    }
                })
                .then(({data}) => {
                    this.services.isLoading = false;
                    this.services.data = data.data
                    this.paginate.links = data.links;
                    this.paginate.meta = data.meta;
                })
                .finally(() => {
                    this.btn_allow = true;
                });
            if (!submit_new && this.showModal) {
                this.showModal = false;
            }
        },
    },
});
</script>
