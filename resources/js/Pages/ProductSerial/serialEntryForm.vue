<template>
    <div v-if="is_edit" class="text-2xl bg-themeLightPrimary p-3 flex items-center">
        <vue-feather class="ml-2" size="20" type="edit"/>
        ویرایش {{ this.form.serial }}
    </div>
    <div v-else class="text-2xl bg-themeLightPrimary text-white p-3 flex items-center">
        <vue-feather class="ml-2" size="20" type="plus"/>
        تولید سریال متوالی
    </div>
    <div class="p-8">

        <form>
            <div class="grid grid-cols-4 gap-4">
                <div class="col-span-2 text-center">
                    <label class="required block text-gray-700 text-sm mb-2  text-right">
                        محصول
                    </label>
                    <TailSelect
                        v-model="form.product_id"
                        :options="{
                            search: true,
                            searchFocus: true,
                            sourceBind: true,
                          }"

                    >
                        <option>-</option>
                        <option
                            v-for="(item , index) in products"
                            :key="index"
                            :value="item.id"
                            class="text-center"
                            :selected="form.product_id === item.id"
                        >
                            {{ item.name }}
                        </option>
                    </TailSelect>
                </div>
                <div class="col-span-2">
                    <label class="required block text-gray-700 text-sm  mb-2" for="username">
                        تعداد
                    </label>
                    <input v-model="form.count"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           type="text">

                </div>
                <div class="col-span-4 text-center">
                    <label class="required block text-gray-700 text-sm mb-2  text-right">
                        بارکد کارتن
                    </label>
                    <TailSelect
                        v-model="form.box_id"
                        :options="{
                            search: true,
                            searchFocus: true,
                            sourceBind: true,
                          }"

                    >
                        <option>-</option>
                        <option
                            v-for="(item , index) in boxes"
                            :key="index"
                            :value="item.id"
                            class="text-center"
                            :selected="form.box_id === item.id"
                        >
                            {{ item.barcode }}
                        </option>
                    </TailSelect>
                </div>
                <div class="col-span-2">
                    <label class="required block text-gray-700 text-sm mb-2" for="username">تاریخ تولید</label>
                    <VuePersianDatetimePicker
                        id="events-form-next-follow-up-date"
                        autocomplete="off"
                        display-format="dddd jDD jMMMM jYYYY"
                        format="YYYY-MM-DD"
                        type="date"
                        v-model="form.ma_date"
                        :value="form.ma_date"
                        @input="form.ma_date = $event"
                        input-class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    />
                </div>
                <div class="col-span-2">
                    <label class="required block text-gray-700 text-sm mb-2" for="username">تاریخ انقضاء</label>
                    <VuePersianDatetimePicker
                        id="events-form-next-follow-up-date"
                        autocomplete="off"
                        display-format="dddd jDD jMMMM jYYYY"
                        format="YYYY-MM-DD"
                        type="date"
                        v-model="form.ex_date"
                        :value="form.ex_date"
                        @input="form.ex_date = $event"
                        input-class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    />
                </div>
                <div class="col-span-4">
                     <textarea
                         v-model="form.description"
                         class="resize-none w-full rounded-md"
                         rows="3"
                         placeholder="توضیحات"></textarea>
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
        products: {
            type: Array,
            default: []
        },
        boxes: {
            type: Array,
            default: []
        },
    },
    computed: {
    },
    data() {
        return {
            btn_allow: true,
            form: {
                id: null,
                count: null,
                product_id: null,
                description: null,
                ex_date: null,
                ma_date: null,
            }
        };
    },

    watch: {},
    created() {
    },
    methods: {
        submit_form(submit_new) {
            this.btn_allow = false;
                this.axios
                    .post(`/product_serial_numbers_between`, this.form, {})
                    .then(({data}) => {
                        this.btn_allow = true;
                        this.$emit('reload', 1, submit_new);
                        if (submit_new) {
                            this.form.id = null;
                            this.form.count = '';
                            this.form.product_id = null;
                            this.form.description = null;
                            this.form.ma_date = null;
                            this.form.ex_date = null;
                        }
                    })
                    .catch(function (error) {
                    })
                    .finally(() => {
                        this.btn_allow = true;
                    });
        }
    },
});
</script>
