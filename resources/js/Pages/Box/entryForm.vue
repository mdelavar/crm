<template>
    <div v-if="is_edit" class="text-2xl bg-themeLightPrimary p-3 flex items-center">
        <vue-feather class="ml-2" size="20" type="edit"/>
        ویرایش {{ this.form.name }}
    </div>
    <div v-else class="text-2xl bg-themeLightPrimary text-white p-3 flex items-center">
        <vue-feather class="ml-2" size="20" type="plus"/>
        افزودن کارتن جدید
    </div>
    <div class="p-8">

        <form>
            <div class="grid grid-cols-4 gap-4">
                <div class="col-span-2">
                    <label class="required block text-gray-700 text-sm  mb-2" for="username">
                        تعداد
                    </label>
                    <input v-model="form.count"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           type="text">

                </div>

                <div class="col-span-2 text-center">
                    <label class="required block text-gray-700 text-sm mb-2  text-right">
                        نمایندگی
                    </label>
                    <TailSelect
                        v-model="form.representation_id"
                        :options="{
                            search: true,
                            searchFocus: true,
                            sourceBind: true,
                          }"

                    >
                        <option>-</option>
                        <option
                            v-for="(item , index) in representations"
                            :key="index"
                            :value="item.id"
                            class="text-center"
                            :selected="form.representation_id === item.id"
                        >
                            {{ item.name }}
                        </option>
                    </TailSelect>
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
        representations: {
            type: Array,
            default: []
        },
    },
    data() {
        return {
            formData: null,
            is_edit: false,
            btn_allow: true,
            form: {
                id: null,
                count: null,
                representation_id: null,
            }
        };
    },

    watch: {},
    created() {
        if (Object.keys(this.edit_items).length > 0) {
            this.is_edit = true;
            this.form.id = this.edit_items.id;
            this.form.representation_id = this.representation_id;
        } else {
            this.is_edit = false;
            this.form.id = null;
            this.form.representation_id = null;
        }
    },
    methods: {
        submit_form(submit_new) {
            this.btn_allow = false;
            if (this.is_edit) {
                this.axios
                    .put(`/boxes/` + this.form.id, this.form, {})
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
                    .post(`/boxes`, this.form, {})
                    .then(({data}) => {
                        this.btn_allow = true;
                        this.$emit('reload', submit_new);
                        if (submit_new) {
                            this.form.id = null;
                            this.form.representation_id = null;
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
