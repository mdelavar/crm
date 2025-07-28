<template>
    <div class="relative intro-y">
        <div class="flex justify-between mb-3 items-center md:flex-row flex-col">
            <span class="text-2xl mb-3 md:mb-0">فهرست کارتن ها</span>
            <PrimaryButton v-if="hasPermission('box_create')" @click="clearForm">
                <vue-feather class="ml-2" size="20" type="plus"/>
                افزودن کارتن جدید
            </PrimaryButton>
        </div>
        <Filter @search-items="searchFilters"></Filter>
        <div class="overflow-y-auto border border-themeOverlyPrimary md:rounded-lg">
            <div v-if="boxes.isLoading" class="flex justify-center mx-auto p-5">
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
                        شماره سریال
                    </th>
                    <th scope="col"
                        class="border border-themeOverlyPrimary py-3.5 px-4 text-sm font-normal text-right rtl:text-right text-themeLightPrimary">
                       نمایندگی
                    </th>
                    <th scope="col" class="border border-themeOverlyPrimary px-4 py-3.5 text-sm font-normal text-right rtl:text-right text-themeLightPrimary">
                        <span>عملیات</span>
                    </th>
                </tr>
                </thead>


                <tbody class="bg-white divide-y divide-indigo-200">
                <tr v-for="(item, index) in boxes.data" class="even:bg-gray-50">
                    <td class="p-2 border">{{ item.barcode }}</td>
                    <td class="p-2 border">{{ item.representation.name }}</td>
                    <td class="p-2 border">
                        <div class="flex items-center justify-center">
                            <div v-if="hasPermission('box_edit')" class="mx-1">
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
            :class="boxes.data.length"
            :paginate="paginate"
            :counter="paginate.meta.per_page"
            :pass-page-number="true"
            @get_items="reload"
        />
    </div>

    <Modal @close="showModal = false" :show="showModal" max-width="2xl" :closeable="false">
        <EntryForm @close="showModal = false" @reload="reload" :edit_items="edit_items" :representations="representations"/>
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
import DefLogo from "@/Images/avatar.jpg";


export default defineComponent({
    components: {Filter, Pagination, LoadingIcon, EntryForm, Modal, PrimaryButton},
    props: {},

    data() {
        return {
            edit_items: {},
            showModal: false,
            boxes: {
                isLoading: false, data: {},
            },
            representations : [],
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
            this.boxes.isLoading = true;
            this.axios
                .get(`/boxes`, {
                    params: {
                        filter,
                        page: 1,
                        limit: 25,
                    }
                })
                .then(({data}) => {
                    this.boxes.isLoading = false;
                    this.boxes.data = data.data;
                    this.representations = data.representations;
                    this.paginate.links = data.links;
                    this.paginate.meta = data.meta;
                    this.categories = data.categories;
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
            this.boxes.isLoading = true;
            this.axios
                .get(`/boxes`, {
                    params: {
                        page,
                        limit: 25,
                    }
                })
                .then(({data}) => {
                    this.boxes.isLoading = false;
                    this.boxes.data = data.data
                    this.representations = data.representations;
                    this.paginate.links = data.links;
                    this.paginate.meta = data.meta;
                    this.categories = data.categories;
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
