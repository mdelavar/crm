<template>
    <div class="flex items-center mb-4 justify-between font-bold text-lg border-b border-gray-200">
        گزارش {{ person.name }}
        <div>
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500">
                <li class="me-3">
                    <div
                        class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg"
                        :class="[type === 1 ?  'border-blue-600 text-blue-600' : ' border-transparent hover:text-gray-600  cursor-pointer']"
                        @click="changeTab(1)"
                    >
                        <vue-feather class="ml-3" size="20" type="grid"/>
                        اعتبارات
                    </div>
                </li>

                <li class="me-3">
                    <div
                        class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg"
                        :class="[type === 2 ?  'border-blue-600 text-blue-600' : ' border-transparent hover:text-gray-600  cursor-pointer']"
                        @click="changeTab(2)"
                    >
                        <vue-feather class="ml-3" size="20" type="home"/>
                        دریافت خدمات
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div v-if="type === 1">
        <div class="overflow-y-auto border border-themeOverlyPrimary md:rounded">
            <div v-if="credits.isLoading" class="flex justify-center mx-auto p-5">
                <LoadingIcon
                    icon="three-dots"
                    color="#000"
                    class="w-10 h-10 z-10 overlay-loading anim-scale-up"
                />
            </div>
            <table v-else class="min-w-full divide-y divide-themeDarkPrimary table-auto">
                <thead class="bg-themeOverlyPrimary">
                <tr>
                    <th scope="col"
                        class="py-2 px-3 border border-themeOverlyPrimary text-sm font-normal text-right rtl:text-right text-themeLightPrimary">
                        مبلغ (ریال)
                    </th>
                    <th scope="col"
                        class="py-2 px-3 border border-themeOverlyPrimary text-sm font-normal text-right rtl:text-right text-themeLightPrimary">
                        تاریخ شروع
                    </th>

                    <th scope="col"
                        class="py-2 px-3 border border-themeOverlyPrimary text-sm font-normal text-right rtl:text-right text-themeLightPrimary">
                        تاریخ پایان
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-indigo-200">
                <tr v-for="(item, index) in credits.data" class="even:bg-gray-50">
                    <td class="border px-2 text-sm py-2">{{ item.amount.toLocaleString() }}</td>
                    <td class="border px-2 text-sm py-2">{{ item.start_date_label }}</td>
                    <td class="border px-2 text-sm py-2">{{ item.end_date_label }}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <Pagination
            v-if="!credits.isLoading && hasPagination"
            :paginate="credits.data"
            :pass-page-number="true"
            @get_items="reloadCredit"
        >
        </Pagination>
    </div>
    <div v-if="type === 2">
        <div class="overflow-y-auto border border-themeOverlyPrimary md:rounded">
            <div v-if="person_use_credits.isLoading" class="flex justify-center mx-auto p-5">
                <LoadingIcon
                    icon="three-dots"
                    color="#000"
                    class="w-10 h-10 z-10 overlay-loading anim-scale-up"
                />
            </div>
            <table v-else class="min-w-full divide-y divide-themeDarkPrimary table-auto">
                <thead class="bg-themeOverlyPrimary">
                <tr>
                    <th scope="col"
                        class="py-2 px-3 border border-themeOverlyPrimary text-sm font-normal text-right rtl:text-right text-themeLightPrimary">
                        مبلغ (ریال)
                    </th>
                    <th scope="col"
                        class="py-2 px-3 border border-themeOverlyPrimary text-sm font-normal text-right rtl:text-right text-themeLightPrimary">
                        خدمت
                    </th>
                    <th scope="col"
                        class="py-2 px-3 border border-themeOverlyPrimary text-sm font-normal text-right rtl:text-right text-themeLightPrimary">
                        اتوسرویس
                    </th>
                    <th scope="col"
                        class="py-2 px-3 border border-themeOverlyPrimary text-sm font-normal text-right rtl:text-right text-themeLightPrimary">
                        تاریخ
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-indigo-200">
                <tr v-for="(item, index) in person_use_credits.data" class="even:bg-gray-50">
                    <td class="border px-2 text-sm py-2">{{ item.amount.toLocaleString() }}</td>
                    <td class="border px-2 text-sm py-2">{{ item.service }}</td>
                    <td class="border px-2 text-sm py-2">{{ item.car_service }}</td>
                    <td class="border px-2 text-sm py-2">{{ item.create_date_label }}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <Pagination
            v-if="!person_use_credits.isLoading && hasPagination"
            :paginate="person_use_credits.data"
            :pass-page-number="true"
            @get_items="reloadUse"
        >
        </Pagination>
    </div>
</template>

<script>
import {defineComponent} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import TextInput from "@/Components/TextInput.vue";
import LoadingIcon from "@/Components/loading-icon/Main.vue";
import Tippy from "@/Components/tippy/Main.vue";
import Pagination from "@/Components/pagination/Main.vue";

export default defineComponent({
    name: "Filter",
    components: {Pagination, Tippy, LoadingIcon, TextInput, DangerButton, PrimaryButton},
    props: {
        person: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            type: 1,
            credits: {
                isLoading: false, data: [],
            },
            person_use_credits: {
                isLoading: false, data: [],
            },
        }
    },
    watch: {},
    computed: {
        hasPagination() {
            if (this.type === 1) {
                return this.credits.data.meta && this.credits.data.meta.last_page > 1;
            }
        },
    },
    created() {
        this.getData()
    },
    methods: {
        changeTab(t) {
            this.type = t;
            this.getData();
        },
        getData() {
            if (this.type === 1) {
                this.reloadCredit()
            } else {
                this.reloadUse()
            }
        },
        reloadCredit(page = 1, filter = this.filter, submit_new = false) {
            this.credits.isLoading = true;
            this.axios
                .get(`/credits`, {
                    params: {
                        limit: 20,
                        page,
                        filter: {
                            organization_people_id: this.person.id,
                        },
                        include: []
                    }
                })
                .then(({data}) => {
                    this.credits.isLoading = false;
                    this.credits.data = data.data;
                })
                .finally(() => {
                });
        },
        reloadUse(page = 1, filter = this.filter, submit_new = false) {
            this.person_use_credits.isLoading = true;
            this.axios
                .get(`/personUseCredit`, {
                    params: {
                        limit: 20,
                        page,
                        filter: {
                            organization_people_id: this.person.id,
                        },
                        include: []
                    }
                })
                .then(({data}) => {
                    this.person_use_credits.isLoading = false;
                    this.person_use_credits.data = data.data;
                })
                .finally(() => {
                });
        },

    },
});
</script>
<style></style>
