<template>
    <div v-if="is_edit" class="text-2xl bg-themeLightPrimary p-3 flex items-center">
        <vue-feather class="ml-2" size="20" type="edit"/>
        ویرایش {{ this.form.name }}
    </div>
    <div v-else class="text-2xl bg-themeLightPrimary text-white p-3 flex items-center">
        <vue-feather class="ml-2" size="20" type="plus"/>
        افزودن نمایندگی جدید
    </div>
    <div class="p-8">

        <form>
            <div class="grid grid-cols-4 gap-4">
                <div class="col-span-2">
                    <label class="required block text-gray-700 text-sm  mb-2" for="username">
                        نام
                    </label>
                    <input v-model="form.name"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           type="text">

                </div>

                <div class="col-span-2">
                    <label class=" block text-gray-700 text-sm  mb-2" for="username">
                        شماره همراه
                    </label>
                    <input v-model="form.phone"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           type="text">

                </div>
                <div class="col-span-4">
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
import DefLogo from "@/Images/avatar.jpg";

export default defineComponent({
    components: {DangerButton, ButtonWithLoading},
    props: {
        edit_items: {
            type: Object,
            default: null,
        },
    },
    data() {
        return {
            formData: null,
            is_edit: false,
            btn_allow: true,
            form: {
                id: null,
                name: null,
                phone: null,
                address: null,
            }
        };
    },

    watch: {},
    created() {
        if (Object.keys(this.edit_items).length > 0) {
            this.is_edit = true;
            this.form.id = this.edit_items.id;
            this.form.name = this.edit_items.name;
            this.form.phone = this.edit_items.phone;
            this.form.address = this.edit_items.address;
        } else {
            this.is_edit = false;
            this.form.id = null;
            this.form.name = null;
            this.form.phone = null;
            this.form.address = null;
        }
    },
    methods: {
        submit_form(submit_new) {
            this.btn_allow = false;
            if (this.is_edit) {
                this.axios
                    .put(`/representations/` + this.form.id, this.form, {})
                    .then(({data}) => {
                        this.$emit('reload', false);
                    })
                    .catch(function (error) {
                    })
                    .finally(() => {
                        this.btn_allow = true;
                    });

            } else {
                this.axios
                    .post(`/representations`, this.form, {})
                    .then(({data}) => {
                        this.btn_allow = true;
                        this.$emit('reload', submit_new);
                        if (submit_new) {
                            this.form.id = null;
                            this.form.title = '';
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
