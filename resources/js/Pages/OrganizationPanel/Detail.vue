<template>
    <Head title="پروفایل"/>
    <div class="grid gap-5 md:grid-cols-2 grid-cols-1 m-6">
        <div class="col-span-1 mt-3">
            <label class="text-sm required">نام</label>
            <input v-model="form.name" type="text"
                   class="mt-1 w-full transition-all border  px-3 py-2.5 rounded-[7px] border-gray-400 focus:border-indigo-400"
            >
        </div>

        <div class="col-span-1 mt-3">
            <label class="text-sm required" for="customerFamily">نام خانوادگی</label>
            <input v-model="form.family" type="text"
                   class="mt-1 w-full transition-all border  px-3 py-2.5 rounded-[7px] border-gray-400 focus:border-indigo-400"
            >
        </div>

        <div class="col-span-1 mt-3">
            <label class="text-sm required" for="customerBirth">تاریخ تولد <span class="badge"> (برای تغییر سال و ماه روی عنوان تقویم کلیک کنید)</span></label>
            <VuePersianDatetimePicker
                v-model="form.birth_date"
                append-to="html"
                class="forecast2"
                display-format="dddd jDD jMMMM jYYYY"
                format="YYYY-MM-DD"
                autofocus
                view="year"
                :max="new Date().getFullYear() - 18"
                :value="form.birth_date"
                auto-submit
                :clearable="false"
                @input="form.birth_date = $event"
                input-class="mt-1 w-full transition-all border  px-3 py-2.5 rounded-[7px] border-gray-400 focus:border-indigo-400"
            />
        </div>

        <div class="col-span-1 mt-3">
            <label class="text-sm required" for="customerFatherName">کدملی</label>
            <input v-if="type === 'submit'" v-model="form.national_code" type="text"
                   class="mt-1 w-full transition-all border  px-3 py-2.5 rounded-[7px] border-gray-400 focus:border-indigo-400"
            >
            <div v-else
                 class="mt-1 w-full transition-all border  px-3 py-2.5 rounded-[7px] border-gray-400 focus:border-indigo-400">
                {{ form.national_code }}
            </div>
        </div>

        <div class="col-span-1 mt-3">
            <label class="text-sm required">جنسیت</label>
            <select
                v-model="form.gender"
                class="mt-1 w-full transition-all border  px-3 py-2.5 rounded-[7px] border-gray-400 focus:border-indigo-400"
                required>
                <option value="">-</option>
                <option value="1">مرد</option>
                <option value="0">زن</option>
            </select>
        </div>

        <div class="col-span-1 mt-3">
            <label class="text-sm required" for="customerFatherName">نام پدر</label>
            <input v-model="form.father_name" type="text"
                   class="mt-1 w-full transition-all border  px-3 py-2.5 rounded-[7px] border-gray-400 focus:border-indigo-400"
            >
        </div>
        <div class="col-span-1 mt-3">
            <label class="text-sm required" for="customerState">استان</label>
            <input v-model="form.state" type="text"
                   class="mt-1 w-full transition-all border  px-3 py-2.5 rounded-[7px] border-gray-400 focus:border-indigo-400"
            >
        </div>
        <div class="col-span-1 mt-3">
            <label class="text-sm required" for="customerCity">شهر</label>
            <input v-model="form.city" type="text"
                   class="mt-1 w-full transition-all border  px-3 py-2.5 rounded-[7px] border-gray-400 focus:border-indigo-400"
            >
        </div>


        <div class="md:col-span-2 col-span-1">
            <PrimaryButton @click="submitProfile" class="w-full mt-1" :loading="isSubmitProfile">
                <span v-if="type === 'submit'">ثبت اطلاعات</span>
                <span v-else>ویرایش اطلاعات</span>
            </PrimaryButton>
        </div>
    </div>
</template>
<script>
import {Head} from "@inertiajs/vue3";
import {defineComponent} from "vue";
import {Link} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import RequestPage from "@/Pages/Request/Main.vue";
import RequestListPage from "@/Pages/RequestList/Main.vue";
import auth from "@/auth.js";

export default defineComponent({
    components: {PrimaryButton, Head, Link, RequestPage, RequestListPage},
    data() {
        return {
            form: {
                id: null,
                name: "",
                family: "",
                gender: null,
                father_name: "",
                state: "",
                city: "",
                national_code: null,
                birth_date: null,
            },
            isSubmitProfile: false
        }
    },
    created() {
        this.form.id = auth.methods.getCustomerId();
        if (this.type === 'edit') {
            this.getDetail();
        }
    },
    props: {
        type: {
            default: 'submit',
        }
    },
    methods: {
        getDetail() {
            this.axios
                .post('/auth/getProfile/' + this.form.id, {})
                .then(({data}) => {
                    this.form.name = data.data.name
                    this.form.family = data.data.family
                    this.form.birth_date = data.data.birth_date
                    this.form.city = data.data.city
                    this.form.national_code = data.data.national_code
                    this.form.state = data.data.state
                    this.form.father_name = data.data.father_name
                    this.form.gender = data.data.gender
                })
                .catch(function (error) {
                })
                .finally(() => {
                });
        },
        submitProfile() {
            this.isSubmitProfile = true;
            this.axios
                .post('/auth/updateProfile/' + this.form.id, this.form, {})
                .then(({data}) => {
                    this.form.is_send = true;
                    auth.methods.updateProfile(data.data['national_code'], data.data['fullName'], data.data['phone'], data.data['id']);
                    window.location.reload();
                })
                .catch(function (error) {
                })
                .finally(() => {
                    this.isSubmitProfile = false;
                });
        },
    }
});
</script>
