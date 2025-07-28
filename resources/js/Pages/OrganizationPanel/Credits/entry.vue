<template>
    <div class="cover-entry">
        <div class="flex items-center justify-between pb-4 border-b border-gray-200">
            <div v-if="!is_edit" class="font-bold text-lg">افزوردن اعتبار جدید</div>
            <div v-else class="font-bold text-lg">ویرایش اعتبار</div>
            <DangerButton @click="backPage">بازگشت</DangerButton>
        </div>
        <div class="grid md:grid-cols-8 grid-cols-1 gap-6 py-6">
            <div class="md:col-span-4 col-span-1">
                <div class="md:col-span-4 col-span-1">
                    <label>
                        کارمند
                    </label>
                    <div class="mt-2">
                        <TailSelect
                            v-model="form.organization_people_id"
                            :options="{
                            search: true,
                            searchFocus: true,
                            sourceBind: true,
                          }"
                        >
                            <option
                                v-for="(item , index) in persons"
                                :key="index"
                                :value="item.id"

                                class="text-center"
                            >
                                {{ item.name }}
                            </option>
                        </TailSelect>
                    </div>
                </div>
            </div>
            <div class="md:col-span-4 col-span-1">
                <label>
                    مبلغ

                    <InputNumber v-model="form.amount"/>
                </label>
            </div>
            <div class="md:col-span-4 col-span-1">

                <label>
                    تاریخ شروع
                    <VuePersianDatetimePicker
                        v-model="form.start_date"
                        display-format="dddd jDD jMMMM jYYYY"
                        format="YYYY-MM-DD"
                        append-to="html"
                        auto-submit
                        :value="form.start_date"
                        @input="form.start_date = $event"
                        input-class="shadow appearance-none border mt-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    />
                </label>
            </div>
            <div class="md:col-span-4 col-span-1">

                <label>
                    تاریخ پایان
                    <VuePersianDatetimePicker
                        v-model="form.end_date"
                        display-format="dddd jDD jMMMM jYYYY"
                        format="YYYY-MM-DD"
                        append-to="html"
                        auto-submit
                        :value="form.end_date"
                        @input="form.end_date = $event"
                        input-class="shadow appearance-none border mt-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    />
                </label>
            </div>
        </div>
    </div>
    <ButtonWithLoading v-if="is_edit" :loading="loading" @click="editForm()" class="py-2 px-4 !text-sm">ویرایش اعتبار
    </ButtonWithLoading>
    <ButtonWithLoading v-else :loading="loading" @click="submitForm()" class="py-2 px-4 !text-sm">ثبت اعتبار
    </ButtonWithLoading>

</template>

<script>
import {defineComponent} from "vue";
import DangerButton from "@/Components/DangerButton.vue";
import Toastify from "@/toastify.js";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import auth from "@/auth.js";
import InputNumber from "@/Components/InputNumber.vue";
import ButtonWithLoading from "@/Components/button-with-loading/Main.vue";

export default defineComponent({
    components: {ButtonWithLoading, InputNumber, PrimaryButton, DangerButton},
    props: {
        credit: {
            type: Object,
            default: null,
        }
    },
    emits: ['backPage'],
    data() {
        return {
            form: {
                id: null,
                amount: "",
                start_date: null,
                end_date: null,
                organization_people_id: null,
            },
            persons: [],
            is_edit: false,
            loading: false,
        };
    },
    created() {
        this.getPersons();
        if (this.credit && Object.keys(this.credit).length > 0) {
            this.is_edit = true;
            this.form.id = this.credit.id;
            this.form.amount = this.credit.amount;
            this.form.start_date = this.credit.start_date;
            this.form.end_date = this.credit.end_date;
            this.form.organization_people_id = this.credit.organization_people_id;
        } else {
            this.is_edit = false;
            this.form.id = null;
            this.form.amount = "";
            this.form.start_date = null;
            this.form.end_date = null;
            this.form.organization_people_id = null;
        }
    },
    watch: {},
    methods: {
        backPage() {
            this.$emit('backPage')
        },
        getPersons() {
            this.axios
                .get('/organizationPerson', {
                    params: {
                        limit: 20000000,
                        filter: {
                            organization_id: auth.methods.getData('login_id')
                        },
                        include: []
                    }
                })
                .then(({data}) => {
                    this.persons = data.data;
                    if (this.persons.length > 0)
                        this.form.organization_people_id = this.persons[0].id;
                })
                .catch(function (error) {
                })
                .finally(() => {
                    this.loading = false;
                });
        },
        submitForm() {
            this.loading = true;
            this.axios
                .post('/credits', this.form, {})
                .then(({data}) => {
                    Toastify({text: "افزودن با موفقیت انجام شد"}).showToast();
                    this.backPage()
                })
                .catch(function (error) {
                })
                .finally(() => {
                    this.loading = false;

                });
        },
        editForm() {
            this.loading = true;
            this.axios
                .put('/credits/' + this.form.id, this.form, {})
                .then(({data}) => {
                    Toastify({text: "ویرایش با موفقیت انجام شد"}).showToast();
                    this.backPage()
                })
                .catch(function (error) {

                })
                .finally(() => {
                    this.loading = false;

                });
        }
    },
});
</script>
