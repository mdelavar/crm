import Toastify from "toastify-js";

const T = (opt, mode = "success") => {
    let background;
    switch (mode) {
        case "success":
        case "info":
        default:
            background = "#13B176";
            break;
        case "error":
            background = "#E63B1F";
    }
    const options = {
        text: "Message",
        duration: 4500,
        destination: "",
        newWindow: true,
        close: true,
        gravity: "top", // `top` or `bottom`
        position: "left", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
            background: background,
        },
        // onClick: function () {}, // Callback after click
    };

    let merged = {...options, ...opt};
    return Toastify(merged);
};
export default T;
