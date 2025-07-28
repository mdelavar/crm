<template>
    <div class="relative intro-y">
       <div class="flex justify-between mb-3 items-center md:flex-row flex-col">
            <span class="text-2xl mb-3 md:mb-0">فهرست سریال محصولات</span>
            <div class="flex items-center">
                <PrimaryButton v-if="hasPermission('product_serial_create')" class="mx-2" @click="clearForm">
                    <vue-feather class="ml-2" size="20" type="plus"/>
                    افزودن سریال محصول جدید
                </PrimaryButton>
                <PrimaryButton v-if="hasPermission('product_serial_create')"  @click="clearForm2">
                    <vue-feather class="ml-2" size="20" type="plus"/>
                    تولید سریال محصولات
                </PrimaryButton>
            </div>

        </div>
        <Filter @search-items="searchFilters" :products="products"></Filter>
        <div class="overflow-y-auto border border-themeOverlyPrimary md:rounded-lg">
            <div v-if="product_serial_numbers.isLoading" class="flex justify-center mx-auto p-5">
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
                        تاریخ تولید
                    </th>
                    <th scope="col"
                        class="border border-themeOverlyPrimary py-3.5 px-4 text-sm font-normal text-right rtl:text-right text-themeLightPrimary">
                        تاریخ انقضاء
                    </th>
                    <th scope="col"
                        class="border border-themeOverlyPrimary py-3.5 px-4 text-sm font-normal text-right rtl:text-right text-themeLightPrimary">
                        سریال مشتری
                    </th>
                    <th scope="col"
                        class="border border-themeOverlyPrimary py-3.5 px-4 text-sm font-normal text-right rtl:text-right text-themeLightPrimary">
                        سریال اتوسرویس
                    </th>
                    <th scope="col"
                        class="border border-themeOverlyPrimary py-3.5 px-4 text-sm font-normal text-right rtl:text-right text-themeLightPrimary">
                        سریال جعبه
                    </th>
                    <th scope="col"
                        class="border border-themeOverlyPrimary py-3.5 px-4 text-sm font-normal text-right rtl:text-right text-themeLightPrimary">
                       توضیحات
                    </th>

                    <th scope="col" class="border border-themeOverlyPrimary px-4 py-3.5 text-sm font-normal text-right rtl:text-right text-themeLightPrimary">
                        <span>عملیات</span>
                    </th>
                </tr>
                </thead>


                <tbody class="bg-white divide-y divide-indigo-200">
                <tr v-for="(item, index) in product_serial_numbers.data" class="even:bg-gray-50">
                    <td class="p-2 border">{{ item.pr.name }}</td>
                    <td class="p-2 border">{{ item.ma_date_label }}</td>
                    <td class="p-2 border">{{ item.ex_date_label }}</td>
                    <td class="p-2 border text-xs">{{ item.customer_serial }}</td>
                    <td class="p-2 border text-xs">{{ item.representation_serial }}</td>
                    <td class="p-2 border text-xs">{{ item.box.barcode }}</td>
                    <td class="p-2 border">{{ item.description }}</td>
                    <td class="p-2 border">
                        <div class="flex items-center justify-center">
                            <div v-if="hasPermission('product_serial_edit')" class="mx-1">
                                <a
                                    class="cursor-pointer"
                                    @click="updateForm(item)"
                                >
                                    <Tippy content="ویرایش">
                                        <vue-feather size="20" class="text-blue-700" type="edit"/>
                                    </Tippy>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <Pagination
            v-if="hasPagination"
            class="intro-y box mt-3"
            :class="product_serial_numbers.data.length"
            :paginate="paginate"
            :counter="paginate.meta.per_page"
            :pass-page-number="true"
            @get_items="reload"
        />
    </div>

    <Modal @close="showModal = false" :show="showModal" max-width="2xl" :closeable="false">
        <EntryForm @close="showModal = false" @reload="reload" :edit_items="edit_items" :boxes="boxes" :products="products"/>
    </Modal>

    <Modal @close="showSerialModal = false" :show="showSerialModal" max-width="2xl" :closeable="false">
        <SerialEntryForm @close="showSerialModal = false" @reload="reload" :products="products" :boxes="boxes"/>
    </Modal>

</template>

<script>
import {defineComponent} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Modal from "@/Components/Modal.vue";
import EntryForm from "./entryForm.vue";
import SerialEntryForm from "./serialEntryForm.vue";
import LoadingIcon from "@/Components/loading-icon/Main.vue";
import Pagination from "@/Components/pagination/Main.vue";
import Filter from "./filter.vue";
import DefLogo from "@/Images/avatar.jpg";


export default defineComponent({
    components: {Filter, Pagination, LoadingIcon, EntryForm,SerialEntryForm , Modal, PrimaryButton},
    props: {},

    data() {
        return {
            edit_items: {},
            showModal: false,
            showSerialModal: false,
            product_serial_numbers: {
                isLoading: false, data: {},
            },
            products: [],
            boxes: [],
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
        setDefault(e) {
            e.target.src = DefLogo
        },
        searchFilters(filter) {
            this.product_serial_numbers.isLoading = true;
            this.axios
                .get(`/product_serial_numbers`, {
                    params: {
                        filter,
                        page: 1,
                        limit: 25,
                    }
                })
                .then(({data}) => {
                    this.product_serial_numbers.isLoading = false;
                    this.product_serial_numbers.data = data.data
                    this.paginate.links = data.links;
                    this.paginate.meta = data.meta;
                    this.products = data.products;
                    this.boxes = data.boxes;
                })
                .finally(() => {
                });
        },
        clearForm() {
            this.edit_items = {};
            this.showModal = true;
        },
        clearForm2() {
            this.showSerialModal = true;
        },
        updateForm(item) {
            this.showModal = true;
            this.edit_items = item;
        },
        reload(page = 1, submit_new) {
            this.product_serial_numbers.isLoading = true;
            this.axios
                .get(`/product_serial_numbers`, {
                    params: {
                        page,
                        limit: 25,
                    }
                })
                .then(({data}) => {
                    this.product_serial_numbers.isLoading = false;
                    this.product_serial_numbers.data = data.data
                    this.paginate.links = data.links;
                    this.paginate.meta = data.meta;
                    this.products = data.products;
                    this.boxes = data.boxes;
                })
                .finally(() => {
                    this.btn_allow = true;
                });
            if (!submit_new) {
                this.showModal = false;
                this.showSerialModal = false;

            }
        },
    },
});
</script>
