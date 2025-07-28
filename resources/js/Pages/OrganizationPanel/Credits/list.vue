<template>
    <div class="relative intro-y">
        <div class="flex mb-3 items-center">
            <div class="font-bold text-lg">فهرست اعتبارات</div>
            <div class="flex items-center mr-auto">
                <PrimaryButton
                    @click="$emit('entryPage')">
                    <vue-feather class="ml-2" size="20" type="plus"/>
                    افزودن اعتبار جدید
                </PrimaryButton>
            </div>
        </div>
        <Filter :filters="filter" @do-filter="reload"></Filter>
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
                        نام و نام خانوادگی
                    </th>
                    <th scope="col"
                        class="py-2 px-3 border border-themeOverlyPrimary text-sm font-normal text-right rtl:text-right text-themeLightPrimary">
                        کدملی
                    </th>
                    <th scope="col"
                        class="py-2 px-3 border border-themeOverlyPrimary text-sm font-normal text-right rtl:text-right text-themeLightPrimary">
                        میلغ
                    </th>
                    <th scope="col"
                        class="py-2 px-3 border border-themeOverlyPrimary text-sm font-normal text-right rtl:text-right text-themeLightPrimary">
                        تاریخ شروع
                    </th>

                    <th scope="col"
                        class="py-2 px-3 border border-themeOverlyPrimary text-sm font-normal text-right rtl:text-right text-themeLightPrimary">
                        تاریخ پایان
                    </th>

                    <th scope="col"
                        class="px-4 py-2 border border-themeOverlyPrimary text-sm font-normal text-right rtl:text-right text-themeLightPrimary">
                        <span>عملیات</span>
                    </th>
                </tr>
                </thead>


                <tbody class="bg-white divide-y divide-indigo-200">
                <tr v-for="(item, index) in credits.data" class="even:bg-gray-50">
                    <td class="border px-2 text-sm py-2">{{ item.person.name }}</td>
                    <td class="border px-2 text-sm py-2">{{ item.person.national_code }}</td>
                    <td class="border px-2 text-sm py-2">{{ item.amount.toLocaleString() }}</td>
                    <td class="border px-2 text-sm py-2">{{ item.start_date_label }}</td>
                    <td class="border px-2 text-sm py-2">{{ item.end_date_label }}</td>
                    <td class="border px-2">
                        <div class="flex items-center justify-center">
                            <div
                                class="mx-1">
                                <a
                                    class="cursor-pointer"
                                    @click="updateForm(item)"
                                >
                                    <Tippy content="ویرایش">
                                        <vue-feather size="20" class="text-themeDarkPrimary" type="edit"/>
                                    </Tippy>
                                </a>
                            </div>
                            <!--                            <div-->
                            <!--                                class="mx-1">-->
                            <!--                                <a-->
                            <!--                                    class="cursor-pointer"-->
                            <!--                                    @click="removeItem(item.id)"-->
                            <!--                                >-->
                            <!--                                    <Tippy content="حذف">-->
                            <!--                                        <vue-feather size="20" class="text-red-600" type="trash"/>-->
                            <!--                                    </Tippy>-->
                            <!--                                </a>-->
                            <!--                            </div>-->
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <Pagination
            v-if="!credits.isLoading && hasPagination"
            :paginate="credits.data"
            :pass-page-number="true"
            @get_items="reload"
        >
        </Pagination>
    </div>

</template>

<script>
import {defineComponent} from "vue";
import LoadingIcon from "@/Components/loading-icon/Main.vue";
import Pagination from "@/Components/pagination/Main.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Filter from "./Filter.vue";
import Modal from "@/Components/Modal.vue";
import Tippy from "@/Components/tippy/Main.vue";
import Swal from "sweetalert2";
import auth from "@/auth.js";


export default defineComponent({
    components: {
        Tippy,
        Modal,
        Filter,
        PrimaryButton,
        Pagination,
        LoadingIcon,
    },
    emits: ['entryPage', 'editItem'],
    props: {
        event: {
            type: Object,
            default: null,
        },
    },

    data() {
        return {
            filter: {
                name: "",
                national_code: "",
                organization_id: auth.methods.getData('login_id'),
            },
            credits: {
                isLoading: false, data: [],
            },
        };
    },
    created() {
        this.reload();
    },
    computed: {
        hasPagination() {
            return this.credits.data.meta && this.credits.data.meta.last_page > 1;
        },
    },
    watch: {},
    methods: {
        setDefault(e) {
            e.target.src = DefLogo
        },
        updateForm(item) {
            this.$emit('editItem', item)
        },
        reload(page = 1, filter = this.filter, submit_new = false) {
            this.credits.isLoading = true;
            this.axios
                .get(`/organization-credits`, {
                    params: {
                        limit: 20,
                        page,
                        organization_id: auth.methods.getData('login_id'),
                        include: [
                            'person'
                        ]
                    }
                })
                .then(({data}) => {
                    this.credits.isLoading = false;
                    this.credits.data = data.data;
                })
                .finally(() => {
                });
        },
        removeItem(id) {
            Swal.fire({
                title: "آیا از حذف مورد انتخاب شده اطمینان دارید ؟",
                text: "این عملکرد قابل بازگشت نمیباشد",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "بله، حذف شوند",
                cancelButtonText: "نه، منصرف شدم",
            }).then((doThat) => {
                if (doThat.value) {
                    this.axios.delete(`/credit/${id}`).then(() => {
                        this.reload()
                    });
                }
            });
        },
    },
});
</script>
