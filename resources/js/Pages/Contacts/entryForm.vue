<template>
    <div v-if="is_edit" class="text-2xl bg-themeLightPrimary p-3 flex items-center">
        <vue-feather class="ml-2" size="20" type="edit"/>
        ویرایش {{ this.form.name }}
    </div>
    <div v-else class="text-2xl bg-themeLightPrimary text-white p-3 flex items-center">
        <vue-feather class="ml-2" size="20" type="plus"/>
        افزودن مخاطب جدید
    </div>
    <div class="p-8">

        <form>
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-1">
                    <label class="required block text-gray-700 text-sm  mb-2" for="username">
                       نام
                    </label>
                    <input v-model="form.name"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           type="text">

                </div>

                <div class="col-span-1">
                    <label class="required block text-gray-700 text-sm  mb-2" for="username">
                        شماره همراه
                    </label>
                    <input v-model="form.mobile"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           type="text">

                </div>
                <div class="col-span-1">
                    <label class="block text-gray-700 text-sm  mb-2" for="username">
                        شماره ثابت
                    </label>
                    <input v-model="form.phone"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           type="text">

                </div>
                <div class="col-span-1">
                    <label class="block text-gray-700 text-sm  mb-2" for="username">
                        ایمیل
                    </label>
                    <input v-model="form.email"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           type="text">

                </div>
                <div class="col-span-1">
                    <label class="block text-gray-700 text-sm  mb-2" for="username">
                        وبسایت
                    </label>
                    <input v-model="form.website"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           type="text">

                </div>
                <div class="col-span-1">
                    <label class="block text-gray-700 text-sm  mb-2" for="username">
                        شناسه فضای مجازی
                    </label>
                    <input v-model="form.social"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           type="text">

                </div>
                <div class="col-span-2">
                    <label class="block text-gray-700 text-sm  mb-2" for="username">
                        کدپستی
                    </label>
                    <input v-model="form.postal_code"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           type="text">

                </div>
                <div class="col-span-2">
                     <textarea
                         v-model="form.address"
                         class="resize-none w-full rounded-md"
                         rows="3"
                         placeholder="آدرس"></textarea>
                </div>
            </div>
        </form>
        <div class="mt-5">
            <div class="flex items-center justify-between w-full">
                <div class="flex items-center">
                    <ButtonWithLoading :loading="!btn_allow" @click="submit_form(false)">
                        {{ is_edit ? 'ویرایش' : 'ثبت' }}
                    </ButtonWithLoading>
                    <ButtonWithLoading v-if="!is_edit" class="mx-3" @click="submit_form(true)" :loading="!btn_allow"
                                       type="submit">
                        ثبت و ادامه
                    </ButtonWithLoading>
                </div>
                <DangerButton @click="$emit('close')">انصراف</DangerButton>
            </div>
        </div>
    </div>
</template>

<script>
import {defineComponent} from "vue";
import ButtonWithLoading from "@/Components/button-with-loading/Main.vue";
import DangerButton from "@/Components/DangerButton.vue";

export default defineComponent({
    components: {DangerButton, ButtonWithLoading},
    props: {
        edit_items: {
            type: Object,
            default: null,
        },
    },
    computed: {},
    data() {
        return {
            is_edit: false,
            btn_allow: true,
            form: {
                id: null,
                name: null,
                mobile: null,
                address: null,
                website: null,
                phone: null,
                email: null,
                social: null,
                postal_code: null,
            }
        };
    },

    watch: {},
    created() {
        if (Object.keys(this.edit_items).length > 0) {
            this.is_edit = true;
            this.form.id = this.edit_items.id;
            this.form.name = this.edit_items.name;
            this.form.mobile = this.edit_items.mobile;
            this.form.address = this.edit_items.address;
            this.form.phone = this.edit_items.phone;
            this.form.email = this.edit_items.email;
            this.form.social = this.edit_items.social;
            this.form.postal_code = this.edit_items.postal_code;
        } else {
            this.is_edit = false;
            this.form.id = null;
            this.form.name = null;
            this.form.mobile = null;
            this.form.address = null;
            this.form.phone = null;
            this.form.email = null;
            this.form.social = null;
            this.form.postal_code = null;
        }
    },
    methods: {
        submit_form(submit_new) {
            this.btn_allow = false;
            if (this.is_edit) {
                this.axios
                    .put(`/contacts/` + this.form.id, this.form, {})
                    .then(({data}) => {
                        this.$emit('reload', 1, false);
                    })
                    .catch(function (error) {
                    })
                    .finally(() => {
                        this.btn_allow = true;
                    });

            } else {
                this.axios
                    .post(`/contacts`, this.form, {})
                    .then(({data}) => {
                        this.btn_allow = true;
                        this.$emit('reload', 1, submit_new);
                        if (submit_new) {
                            this.form.id = null;
                            this.form.name = '';
                            this.form.en_name = null;
                        }
                    })
                    .catch(function (error) {
                    })
                    .finally(() => {
                        this.btn_allow = true;
                    });
            }
        }
    },
});
</script>
