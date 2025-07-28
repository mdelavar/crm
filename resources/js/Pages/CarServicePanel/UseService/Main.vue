<style>
.c-pattern {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 56 28' width='56' height='28'%3E%3Cpath fill='%23000000' fill-opacity='0.06' d='M56 26v2h-7.75c2.3-1.27 4.94-2 7.75-2zm-26 2a2 2 0 1 0-4 0h-4.09A25.98 25.98 0 0 0 0 16v-2c.67 0 1.34.02 2 .07V14a2 2 0 0 0-2-2v-2a4 4 0 0 1 3.98 3.6 28.09 28.09 0 0 1 2.8-3.86A8 8 0 0 0 0 6V4a9.99 9.99 0 0 1 8.17 4.23c.94-.95 1.96-1.83 3.03-2.63A13.98 13.98 0 0 0 0 0h7.75c2 1.1 3.73 2.63 5.1 4.45 1.12-.72 2.3-1.37 3.53-1.93A20.1 20.1 0 0 0 14.28 0h2.7c.45.56.88 1.14 1.29 1.74 1.3-.48 2.63-.87 4-1.15-.11-.2-.23-.4-.36-.59H26v.07a28.4 28.4 0 0 1 4 0V0h4.09l-.37.59c1.38.28 2.72.67 4.01 1.15.4-.6.84-1.18 1.3-1.74h2.69a20.1 20.1 0 0 0-2.1 2.52c1.23.56 2.41 1.2 3.54 1.93A16.08 16.08 0 0 1 48.25 0H56c-4.58 0-8.65 2.2-11.2 5.6 1.07.8 2.09 1.68 3.03 2.63A9.99 9.99 0 0 1 56 4v2a8 8 0 0 0-6.77 3.74c1.03 1.2 1.97 2.5 2.79 3.86A4 4 0 0 1 56 10v2a2 2 0 0 0-2 2.07 28.4 28.4 0 0 1 2-.07v2c-9.2 0-17.3 4.78-21.91 12H30zM7.75 28H0v-2c2.81 0 5.46.73 7.75 2zM56 20v2c-5.6 0-10.65 2.3-14.28 6h-2.7c4.04-4.89 10.15-8 16.98-8zm-39.03 8h-2.69C10.65 24.3 5.6 22 0 22v-2c6.83 0 12.94 3.11 16.97 8zm15.01-.4a28.09 28.09 0 0 1 2.8-3.86 8 8 0 0 0-13.55 0c1.03 1.2 1.97 2.5 2.79 3.86a4 4 0 0 1 7.96 0zm14.29-11.86c1.3-.48 2.63-.87 4-1.15a25.99 25.99 0 0 0-44.55 0c1.38.28 2.72.67 4.01 1.15a21.98 21.98 0 0 1 36.54 0zm-5.43 2.71c1.13-.72 2.3-1.37 3.54-1.93a19.98 19.98 0 0 0-32.76 0c1.23.56 2.41 1.2 3.54 1.93a15.98 15.98 0 0 1 25.68 0zm-4.67 3.78c.94-.95 1.96-1.83 3.03-2.63a13.98 13.98 0 0 0-22.4 0c1.07.8 2.09 1.68 3.03 2.63a9.99 9.99 0 0 1 16.34 0z'%3E%3C/path%3E%3C/svg%3E");
}
</style>
<template>
    <div>
        <div class="pb-6 flex items-center flex-col justify-center">
            <div class="text-sm mt-8 mb-6">برای ثبت خدمات کد ملی فرد را وارد نمایید.</div>
            <input v-model="national_code"
                   placeholder="کدملی"
                   class="shadow max-w-[20rem] mb-4 appearance-none border rounded-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   type="text"
                   @keydown.enter="checkNational()">

            <LoadingIcon v-if="loading" icon="puff" color="#000000"/>
            <div v-if="person" class="flex flex-col items-center justify-center w-full">
                <span class="font-bold text-2xl mb-3">{{ person.name }}</span>
                <span>{{ organization.name }}</span>

                <div
                    class="font-bold my-4 space-x-2 space-x-reverse bg-green-300 flex rounded px-3 py-1 items-center justify-center">
                    <span>اعتبار باقی مانده : </span>
                    <span>{{ remindCredit.toLocaleString() }}</span>
                    <span>ریال</span>
                </div>
                <div class="mt-5 pb-4 border-b text-center font-bold w-full max-w-screen-sm ">فهرست خدمات</div>
                <div class="mb-4 w-full max-w-screen-sm">
                    <div v-for="(item,index) in services"
                         class="border-b flex justify-between items-center  py-2 min-h-[5rem]">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" @change="selectService($event , index)" class="sr-only peer">
                            <div
                                class="relative w-11 h-6 bg-gray-200 rounded-full peer  peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:end-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600 dark:peer-checked:bg-green-600"></div>
                            <span class="ms-3 peer-checked:text-black text-gray-500"> {{ item.name }}</span>
                        </label>
                        <InputNumber v-if="item.checked" v-model="services[index]['amount']" placeholder="مبلغ خدمت"
                                     class="max-w-[20rem]"></InputNumber>
                    </div>
                    <div class="flex justify-between items-center"
                         :class="{'text-red-800' : totalService > remindCredit}">
                        <div v-if="totalService <= remindCredit" class="font-bold">مجموع</div>
                        <div v-else class="font-bold"> مجموع بیش از میزان اعتبار</div>
                        <div
                            class="font-bold mt-5 space-x-2 space-x-reverse flex  px-3 py-1 items-center justify-center">
                            <span>{{ totalService.toLocaleString() }}</span>
                            <span>ریال</span>
                        </div>
                    </div>
                </div>
                <ButtonWithLoading :disabled="totalService > remindCredit" :loading="loadingSubmit"
                                   @click="submitServices">ثبت خدمات
                </ButtonWithLoading>
            </div>
        </div>

    </div>
</template>
<script>
import {Head, Link} from "@inertiajs/vue3";
import {defineComponent} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import LoadingIcon from "@/Components/loading-icon/Main.vue";
import ButtonWithLoading from "@/Components/button-with-loading/Main.vue";
import InputNumber from "@/Components/InputNumber.vue";
import auth from "@/auth.js";
import Toastify from "@/toastify.js";

export default defineComponent({
    components: {InputNumber, ButtonWithLoading, LoadingIcon, AuthenticatedLayout, PrimaryButton, Head, Link},
    data() {
        return {
            national_code: "",
            loading: false,
            loadingSubmit: false,
            person: null,
            organization: null,
            remindCredit: 0,
            services: []
        }
    },
    created() {
    },
    computed: {
        totalService() {
            return this.services.reduce((accumulator, currentItem) => {
                return accumulator + parseInt(currentItem.amount ?? 0);
            }, 0);
        }
    },
    methods: {
        checkNational() {
            this.person = null;
            this.loading = true;
            this.axios.post("/check-national", {
                national_code: this.national_code
            }).then((data) => {
                this.person = data.data.person;
                this.organization = data.data.organization;
                this.remindCredit = data.data.credit;
                this.services = data.data.services;
            }).finally((data) => {
                this.loading = false
            });
        },
        submitServices() {
            this.loadingSubmit = true;
            let selectedService = this.services.filter((t) => {
                return t.checked
            }).map((f) => {
                return {
                    'id': f.id,
                    "amount": f.amount
                }
            });

            this.axios.post("/submit-service", {
                services: selectedService,
                car_service: auth.methods.getData('login_id'),
                person: this.person.id
            }).then((data) => {
                if (data.data.success) {
                    this.person = null;
                    this.national_code = '';
                    Toastify({text: "ثبت خدمات با موفقیت انجام شد"}).showToast();

                }

            }).finally((data) => {
                this.loadingSubmit = false;
            });
        },
        selectService($event, $index) {
            this.services[$index]['checked'] = $event.target.checked;
        }
    }
});
</script>
