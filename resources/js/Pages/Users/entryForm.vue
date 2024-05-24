<template>
    <div v-if="is_edit" class="text-2xl bg-themeLightPrimary text-white p-3 flex items-center">
        <vue-feather class="ml-2" size="20" type="edit"/>
        ویرایش {{ this.form.name }}
    </div>
    <div v-else class="text-2xl bg-themeLightPrimary text-white p-3 flex items-center">
        <vue-feather class="ml-2" size="20" type="plus"/>
        افزودن کاربر جدید
    </div>
    <div class="p-8">

        <form>
            <div class="grid grid-cols-4 gap-4">


                <div class="col-span-2">
                    <label class="block text-gray-700 text-sm  mb-2" >
                        ایمیل
                    </label>
                    <input v-model="form.email"
                           autocomplete="off"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           type="text">

                </div>

                <div class="col-span-2">
                    <label class="block text-gray-700 text-sm  mb-2" for="username">
                        نام
                    </label>
                    <input v-model="form.name"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           type="text">

                </div>

                <div class="col-span-2">
                    <label class="block text-gray-700 text-sm  mb-2">
                        رمز عبور
                    </label>
                    <input v-model="form.password"
                           autocomplete="off"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           type="password">

                </div>
                <div class="col-span-2">
                    <label class="block text-gray-700 text-sm  mb-2">
                        تکرار رمز عبور
                    </label>
                    <input v-model="form.repeat_password"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           type="password">

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
import Checkbox from "@/Components/Checkbox.vue";
import DangerButton from "@/Components/DangerButton.vue";

export default defineComponent({
    components: {DangerButton, Checkbox, ButtonWithLoading},
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
                email: null,
                password: null,
                repeat_password: null,
            }
        };
    },

    watch: {},
    created() {
        if (Object.keys(this.edit_items).length > 0) {
            this.is_edit = true;
            this.form.id = this.edit_items.id;
            this.form.name = this.edit_items.name;
            this.form.email = this.edit_items.email;
            this.form.password = null;
            this.form.repeat_password = null;
        } else {
            this.is_edit = false;
            this.form.id = null;
            this.form.name = '';
            this.form.email = null;
            this.form.password = null;
            this.form.repeat_password = null;
        }
    },
    methods: {
        submit_form(submit_new) {
            this.btn_allow = false;
            if (this.is_edit) {
                this.axios
                    .put(`/users/` + this.form.id, this.form, {})
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
                    .post(`/users`, this.form, {})
                    .then(({data}) => {
                        this.btn_allow = true;
                        this.$emit('reload', 1, submit_new);
                        if (submit_new) {
                            this.form.id = null;
                            this.form.title = '';
                            this.form.time = null;
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
