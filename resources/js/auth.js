import {usePage} from "@inertiajs/vue3";
import {computed} from "vue";

export default {
    computed: {
        isLoggedIn() {
            return this.getToken().length > 0;
        },
    },
    methods: {
        getToken() {
            return localStorage.getItem('token') ?? "";
        },
        getName() {
            return localStorage.getItem('name') ?? "";
        },
        getPhone() {
            return localStorage.getItem('phone') ?? "";
        },
        setToken($token) {
            localStorage.setItem('token', $token)
        },
        logout() {
            localStorage.removeItem("token");
            localStorage.removeItem("name");
            localStorage.removeItem("phone");
            window.location.reload();
        }
    }
};

