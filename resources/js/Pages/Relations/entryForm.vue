<template>
    <div v-if="is_edit" class="text-2xl text-white bg-themeLightPrimary p-3 flex items-center">
        <vue-feather class="ml-2" size="20" type="edit"/>
        ویرایش {{ this.form.title }}
    </div>
    <div v-else class="text-2xl bg-themeLightPrimary text-white p-3 flex items-center">
        <vue-feather class="ml-2" size="20" type="plus"/>
        افزودن ارتباط جدید
    </div>
    <div class="p-8">

        <form>
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="required block text-gray-700 text-sm  mb-2" for="username">
                        عنوان
                    </label>
                    <input v-model="form.title"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           type="text">

                </div>
                <div class="col-span-1 text-center">
                    <label class="required block text-gray-700 text-sm mb-2  text-right">
                        مخاطب
                    </label>
                    <TailSelect
                        v-model="form.contact_id"
                        :options="{
                            search: true,
                            searchFocus: true,
                            sourceBind: true,
                          }"

                    >
                        <option>-</option>
                        <option
                            v-for="(item , index) in contacts"
                            :key="index"
                            :value="item.id"
                            class="text-center"
                            :selected="form.contact_id === item.id"
                        >
                            {{ item.name }}
                        </option>
                    </TailSelect>
                </div>

                <div class="col-span-1 text-center">
                    <label class="required block text-gray-700 text-sm mb-2  text-right">
                        دسته بندی ارتباط
                    </label>
                    <TailSelect
                        v-model="form.relation_category_id"
                        :options="{
                            search: true,
                            searchFocus: true,
                            sourceBind: true,
                          }"

                    >
                        <option>-</option>
                        <option
                            v-for="(item , index) in categories"
                            :key="index"
                            :value="item.id"
                            class="text-center"
                            :selected="form.relation_category_id === item.id"
                        >
                            {{ item.title }}
                        </option>
                    </TailSelect>
                </div>

                <div class="col-span-2">
                    <label class="required block text-gray-700 text-sm mb-2" for="username">تاریخ تماس</label>
                    <VuePersianDatetimePicker
                        id="events-form-next-follow-up-date"
                        autocomplete="off"
                        display-format="dddd jDD jMMMM jYYYY HH:mm"
                        format="YYYY-MM-DD HH:mm"
                        type="datetime"
                        v-model="form.call_time"
                        :value="form.call_time"
                        @input="form.call_time = $event"
                        input-class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    />
                </div>
                <div class="col-span-2">
                     <textarea
                         v-model="form.call_result"
                         class="resize-none w-full rounded-md"
                         rows="3"
                         placeholder="نتیجه تماس"></textarea>
                </div>
                <div class="col-span-2">
                    <label class="block text-gray-700 text-sm mb-2" for="username">تاریخ پیگیری بعدی</label>
                    <VuePersianDatetimePicker
                        id="events-form-next-follow-up-date"
                        autocomplete="off"
                        display-format="dddd jDD jMMMM jYYYY HH:mm"
                        format="YYYY-MM-DD HH:mm"
                        type="datetime"
                        v-model="form.next_call_time"
                        :value="form.next_call_time"
                        @input="form.next_call_time = $event"
                        input-class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    />
                </div>
                <div class="col-span-2 text-xs text-gray-500">جهت یادآوری سیستمی می توانید تاریخ پیگیری بعدی را مشخص نمائید</div>
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
        contacts: {
            type: Object,
            default: [],
        },
        categories: {
            type: Object,
            default: [],
        }
    },
    computed: {},
    data() {
        return {
            is_edit: false,
            btn_allow: true,
            form: {
                id: null,
                title: null,
                contact_id: null,
                relation_category_id: null,
                call_time: null,
                next_call_time: null,
                call_result: null,
            }
        };
    },

    watch: {},
    created() {
        if (Object.keys(this.edit_items).length > 0) {
            this.is_edit = true;
            this.form.id = this.edit_items.id;
            this.form.title = this.edit_items.title;
            this.form.contact_id = this.edit_items.contact_id;
            this.form.relation_category_id = this.edit_items.relation_category_id;
            this.form.call_time = this.edit_items.call_time;
            this.form.next_call_time = this.edit_items.next_call_time;
            this.form.call_result = this.edit_items.call_result;
        } else {
            this.is_edit = false;
            this.form.id = null;
            this.form.title = null;
            this.form.contact_id = null;
            this.form.relation_category_id = null;
            this.form.call_time = null;
            this.form.next_call_time = null;
            this.form.call_result = null;
        }
    },
    methods: {
        submit_form(submit_new) {
            this.btn_allow = false;
            if (this.is_edit) {
                this.axios
                    .put(`/relations/` + this.form.id, this.form, {})
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
                    .post(`/relations`, this.form, {})
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
