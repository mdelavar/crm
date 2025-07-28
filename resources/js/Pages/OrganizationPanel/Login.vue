<template>
    <Head title="ورود سازمانی"/>
    <div class="w-full h-screen bg-themePrimary py-10 flex items-center justify-center">
        <div class="bg-white mx-8 rounded-2xl relative shadow-2xl overflow-hidden">
            <div class="py-4 px-16 flex flex-col items-center justify-center">
                <ApplicationLogo class="w-3/6 m-4"/>
                <div class="text-themeSecondary text-xl">پنل ورود سازمان ها</div>
            </div>
            <div class="flex flex-col items-center justify-center bg-themeGray px-5 py-12 text-center">
                <input v-model="form.phone"
                       placeholder="شماره همراه"
                       class="shadow max-w-[20rem] mb-4 appearance-none border rounded-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                       type="text"
                       @keydown.enter="login()">

                <input v-model="form.password"
                       placeholder="رمز عبور"
                       class="shadow max-w-[20rem] mb-4 appearance-none border rounded-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                       type="text"
                       @keydown.enter="login()">

                <ButtonWithLoading :loading="loginLoading" @click="login()" class="w-full max-w-[20rem] mt-4"
                                   :disabled='!isValidatePhone || !isValidatePassword'>ورود
                </ButtonWithLoading>
            </div>
        </div>
    </div>
</template>
<script>
import {Head} from "@inertiajs/vue3";
import {computed, defineComponent} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import auth from "@/auth.js";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import ButtonWithLoading from "@/Components/button-with-loading/Main.vue";

export default defineComponent({
    components: {ButtonWithLoading, ApplicationLogo, PrimaryButton, Head},
    data() {
        return {
            form: {
                phone: "",
                password: "",
            },
            loginLoading: false,

        };
    },
    computed: {
        isValidatePhone() {
            return this.form.phone.length === 11 && this.form.phone.startsWith('09');
        },
        isValidatePassword() {
            return this.form.password.length > 0;
        },
    },

    methods: {
        login() {
            if (!this.isValidatePhone || !this.isValidatePassword) return;
            this.loginLoading = true;
            this.axios
                .post('/auth/sign-o', this.form, {})
                .then(({data}) => {
                    auth.methods.setToken(data["token"]);
                    auth.methods.setData('phone', data.data["phone"]);
                    auth.methods.setData('name', data.data["name"]);
                    auth.methods.setData('login_id', data.data["id"]);
                    auth.methods.setData('type', data["type"]);

                    console.log(auth.methods.getToken(data["token"]),
                    auth.methods.getData('phone'),
                    auth.methods.getData('name'),
                    auth.methods.getData('type'));
                    window.location.reload();
                })
                .catch(function (error) {
                })
                .finally(() => {
                    this.loginLoading = false;
                });
        },

    }
});
</script>
