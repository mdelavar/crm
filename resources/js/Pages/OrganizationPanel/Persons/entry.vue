<template>
    <div class="cover-entry">
        <div class="flex items-center justify-between pb-4 border-b border-gray-200">
            <div v-if="!is_edit" class="font-bold text-lg">افزوردن کارمند جدید</div>
            <div v-else class="font-bold text-lg">ویرایش کارمند</div>
            <DangerButton @click="backPage">بازگشت</DangerButton>
        </div>
        <div class="grid md:grid-cols-8 grid-cols-1 gap-6 py-6">
            <div class="md:col-span-4 col-span-1">
                <label>
                    نام و نام خانوادگی
                    <input v-model="form.name"
                           class="shadow appearance-none border rounded-md w-full mt-2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           type="text">
                </label>
            </div>
            <div class="md:col-span-4 col-span-1">
                <label>
                    کدملی
                    <input v-model="form.national_code"
                           class="shadow appearance-none border rounded-md w-full mt-2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           type="text">
                </label>
            </div>
            <div class="md:col-span-4 col-span-1">
                <label>
                    شماره همراه
                    <input v-model="form.phone"
                           class="shadow appearance-none border rounded-md w-full mt-2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           type="text">
                </label>
            </div>
            <div class="md:col-span-4 col-span-1">
                <label>
                    پلاک خودرو
                    <input v-model="form.car_number"
                           class="shadow appearance-none border rounded-md w-full mt-2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           type="text">
                </label>
            </div>
        </div>
    </div>
    <ButtonWithLoading v-if="is_edit" :loading="loading" @click="editForm()" class="py-2 px-4 !text-sm">ویرایش کارمند
    </ButtonWithLoading>
    <ButtonWithLoading v-else :loading="loading" @click="submitForm()" class="py-2 px-4 !text-sm">ثبت کارمند
    </ButtonWithLoading>

</template>

<script>
import {defineComponent} from "vue";
import DangerButton from "@/Components/DangerButton.vue";
import Toastify from "@/toastify.js";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import auth from "@/auth.js";
import ButtonWithLoading from "@/Components/button-with-loading/Main.vue";

export default defineComponent({
    components: {ButtonWithLoading, PrimaryButton, DangerButton},
    props: {
        person: {
            type: Object,
            default: null,
        }
    },
    emits: ['backPage'],
    data() {
        return {
            form: {
                id: null,
                name: "",
                phone: "",
                national_code: "",
                car_number: "",
                organization_id: auth.methods.getData('login_id'),
            },
            is_edit: false,
            loading: false,
        };
    },
    created() {
        if (this.person && Object.keys(this.person).length > 0) {
            this.is_edit = true;
            this.form.id = this.person.id;
            this.form.name = this.person.name;
            this.form.phone = this.person.phone;
            this.form.car_number = this.person.car_number;
            this.form.national_code = this.person.national_code;
        } else {
            this.is_edit = false;
            this.form.id = null;
            this.form.name = "";
            this.form.phone = "";
            this.form.car_number = "";
            this.form.national_code = "";
        }
    },
    watch: {},
    methods: {
        backPage() {
            this.$emit('backPage')
        },
        submitForm() {
            this.loading = true;
            this.axios
                .post('/organizationPerson', this.form, {})
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
                .put('/organizationPerson/' + this.form.id, this.form, {})
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
