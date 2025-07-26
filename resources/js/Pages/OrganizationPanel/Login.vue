<template>
    <Head title="ورود"/>
    <div class="bg-gray-50 text-gray-500 p-6">
        <div class="min-h-screen w-full flex items-center justify-center">
            <div class="bg-white border border-gray-300 rounded-3xl p-10 md:w-5/12">
                <div class="grid md:grid-cols-4 grid-cols-1 gap-5">
                    <div class="col-span-2 flex items-center flex-col justify-center">
                        <div class="text-center mb-4 text-2xl">زائر سرای گل نرجس</div>
                        <div v-if="form.is_send" class="w-full">
                            <input v-model="form.tempCode"
                                   placeholder="کد دریافتی"
                                   class="shadow appearance-none border rounded-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                   type="text"
                                   @keydown.enter="login()">
                            <PrimaryButton :loading="loginLoading" @click="login()" class="w-full mt-4"
                                           :disabled='!isValidateCode'>ورود
                            </PrimaryButton>

                            <span  v-if="timer > 0" class="block w-full text-center my-3 text-sm" style="direction: ltr">00 : {{timer.toString().padStart(2, '0')}}</span>
                            <span v-else class="block w-full text-center my-3 text-sm cursor-pointer" style="direction: ltr" @click="getCode()">ارسال مجدد کد</span>
                        </div>
                        <div v-else  class="w-full">
                            <input v-model="form.phone"
                                   placeholder="شماره همراه"
                                   class="shadow appearance-none border rounded-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                   type="text"
                            @keydown.enter="getCode()">
                            <PrimaryButton :loading="sendCodeLoading" @click="getCode()" class="w-full mt-4"
                                           :disabled='!isValidatePhone'>
                                قبول شرایط و ادامه
                            </PrimaryButton>
                        </div>
                    </div>
                    <div class="col-span-2 md:border-r md:border-t-0 border-t  border-gray-300  md:pr-4 md:pt-0 pt-4">
                        <div class="font-bold text-center text-black mb-3">
                            شرایط ثبت نام و درخواست اقامت
                        </div>
                        <div class="text-sm  w-full">
                            1 - امکان درخواست اقامت برای کدملی های صادره از قم و اصفهان وجود ندارد.
                            <br>
                            <br>
                            2 - ثبت درخواست به معنی تایید نهایی نمی باشد و مراحل پذیرش بعد از تماس با شما نهایی خواهد شد.
                            <br>
                            <br>
                            3 - همه زائران گرامی خانم ملزم به رعایت حجاب برتر(چادر) هستند و زوج های گرامی با عقد موقت پذیرش نخواهند شد.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {Head} from "@inertiajs/vue3";
import {computed, defineComponent} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import auth from "@/auth.js";

export default defineComponent({
    components: {PrimaryButton, Head},
    data() {
        return {
            form: {
                phone: "",
                tempCode: "",
                is_send: false
            },
            loginLoading: false,
            sendCodeLoading: false,
            timer : 59,

        };
    },
    computed: {
        isValidatePhone() {
            return this.form.phone.length == 11 && this.form.phone.startsWith('09');
        },
        isValidateCode() {
            return this.form.tempCode.length == 4;
        },
    },

    methods: {
        getCode() {
            if (!this.isValidatePhone) return;
            this.timer = 59;
            this.sendCodeLoading = true;
            this.axios
                .post('/auth/getCode', this.form, {})
                .then(({data}) => {
                    this.form.is_send = true;
                    this.sendCodeLoading = false;
                    this.startTimer();
                })
                .catch(function (error) {
                })
                .finally(() => {
                });
        },
        login() {
            if (!this.isValidateCode) return;
            this.loginLoading = true;
            this.axios
                .post('/auth/sign', this.form, {})
                .then(({data}) => {
                    auth.methods.updateProfile(data.data['national_code'], data.data['fullName'], data.data['phone'], data.data['id']);
                    auth.methods.setToken(data["token"]);
                    window.location.reload();
                })
                .catch(function (error) {
                })
                .finally(() => {
                    this.loginLoading = false;
                });
        },

        startTimer() {
            this.interval = setInterval(() => {
                if (this.timer === 0) {
                    clearInterval(this.interval)
                } else {
                    this.timer--
                }
            }, 1000)
        }
    }
});
</script>
