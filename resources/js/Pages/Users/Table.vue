<template>
    <div class="relative intro-y">
       <div class="flex justify-between mb-3 items-center md:flex-row flex-col">
            <span class="text-2xl mb-3 md:mb-0">فهرست کاربران</span>
            <PrimaryButton v-if="hasPermission('users_create')" @click="clearForm">
                <vue-feather class="ml-2" size="20" type="plus"/>
                افزودن کاربر جدید
            </PrimaryButton>
        </div>
        <div class="overflow-y-auto border border-themeOverlyPrimary md:rounded-lg">
            <div v-if="users.isLoading" class="flex justify-center mx-auto p-5">
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
                        class="border border-themeOverlyPrimary py-3.5 px-4 text-sm font-normal text-right rtl:text-right text-themeLightPrimary">
                        نام
                    </th>
                    <th scope="col"
                        class="border border-themeOverlyPrimary py-3.5 px-4 text-sm font-normal text-right rtl:text-right text-themeLightPrimary">
                        ایمیل
                    </th>
                    <th scope="col"
                        class="border border-themeOverlyPrimary px-4 py-3.5 text-sm font-normal text-right rtl:text-right text-themeLightPrimary">
                        <span>عملیات</span>
                    </th>
                </tr>
                </thead>


                <tbody class="bg-white divide-y divide-indigo-200">
                <tr v-for="(item, index) in users.data" class="even:bg-gray-50">
                    <td class="p-2 border">{{ item.name }}</td>
                    <td class="p-2 border">{{ item.email }}</td>
                    <td class="p-2 border">
                        <div class="flex items-center justify-center">
                            <div v-if="hasPermission('users_edit')">
                                <a
                                    class="cursor-pointer"
                                    @click="updateForm(item)"
                                >
                                    <Tippy content="ویرایش">
                                        <vue-feather size="20" class="text-themeDarkPrimary" type="edit"/>
                                    </Tippy>
                                </a>
                            </div>
                            <div class="mx-2">
                                <a
                                    class="cursor-pointer"
                                    @click="permissionForm(item)"
                                >
                                    <Tippy content="دسترسی ها">
                                        <vue-feather size="20" class="text-green-700" type="key"/>
                                    </Tippy>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <Modal @close="showModal = false" :show="showModal" max-width="2xl" :closeable="false">
        <EntryForm @close="showModal = false" @reload="reload" :edit_items="edit_items"/>
    </Modal>

    <Modal @close="showPermissionModal = false" :show="showPermissionModal" max-width="2xl" :closeable="false">
        <PermissionForm @close="showPermissionModal = false" @reload="reload" :edit_items="edit_items"/>
    </Modal>

</template>

<script>
import {defineComponent} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Modal from "@/Components/Modal.vue";
import EntryForm from "@/Pages/Users/entryForm.vue";
import PermissionForm from "@/Pages/Users/permissions.vue";

import LoadingIcon from "@/Components/loading-icon/Main.vue";

export default defineComponent({
    components: {LoadingIcon, EntryForm, PermissionForm , Modal, PrimaryButton},
    props: {},

    data() {
        return {
            edit_items: {},
            showModal: false,
            showPermissionModal: false,
            users: {
                isLoading: false, data: {},
            },
        };
    },
    created() {
        this.reload(1, false);
    },
    computed: {
    },
    watch: {},
    methods: {
        clearForm() {
            this.edit_items = {};
            this.showModal = true;
        },
        updateForm(item) {
            this.showModal = true;
            this.edit_items = item;
        },
        permissionForm(item) {
            this.showPermissionModal = true;
            this.edit_items = item;
        },
        reload(page = 1, submit_new) {
            this.users.isLoading = true;
            this.axios
                .get(`/users`, {})
                .then(({data}) => {
                    this.users.isLoading = false;
                    this.users.data = data.data
                })
                .finally(() => {
                    this.btn_allow = true;
                });
            if (!submit_new) {
                this.showModal = false;
                this.showPermissionModal = false;
            }
        },
    },
});
</script>
