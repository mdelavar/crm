import axios from "axios";
import {router} from "@inertiajs/vue3";
import Toastify from "./toastify.js";
import auth from "@/auth.js";


let options = {
    baseURL: import.meta.env.VITE_APIURL || "/api",
    withCredentials: true,
    headers: {
        Authorization: auth.methods.getToken() ? "Bearer " + auth.methods.getToken() : "",
        "Access-Control-Allow-Origin": "*",
        "Access-Control-Allow-Credentials": true,
        "Content-Type": "application/json",
        Accept: "application/json",
    },
};

const Axios = axios.create(options);

Axios.interceptors.response.use(
    (response) => {
        return Promise.resolve(response);
    },
    (error) => {
        if (error.response.status) {
            let data = error.response.data;
            switch (error.response.status) {
                case 401:
                    console.log("ssss")
                    // auth.methods.logout();
                    // router.push({name: "login"});
                    break;
                case 422:
                    if ("errors" in data) {
                        let i = 0;
                        for (var key of Object.keys(data.errors)) {
                            Toastify(
                                {
                                    text: data.errors[key],
                                    gravity: "top", // `top` or `bottom`
                                    position: "left", // `left`, `center` or `right`
                                },
                                "error"
                            ).showToast();
                            i++;
                        }
                    }
                    break;
                default:

                    break;
            }
        }
        return Promise.reject(error);
    }
);
export default Axios;
