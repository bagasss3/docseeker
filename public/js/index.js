// tambah kurang item
$(".btn-plus, .btn-minus").on("click", function (e) {
    const isNegative = $(e.target).closest(".btn-minus").is(".btn-minus");
    const input = $(e.target).closest(".input-group").find("input");
    if (input.is("input")) {
        input[0][isNegative ? "stepDown" : "stepUp"]();
    }
});

// Active Link
const queryString = window.location.href.split("?")[1];
const navLink = document.querySelectorAll("[data-locations]");
navLink.forEach((nav) => {
    if (nav.getAttribute("data-locations") == queryString) {
        nav.classList.add("nav__active");
    }
});

// Number Format
// function numberWithCommas(x) {
//     return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
// }
// const numberToFormat = document.querySelectorAll(".number-format");
// numberToFormat.forEach((item) => {
//     item.innerHTML = `IDR ${numberWithCommas(item.innerHTML)},-`;
// });

// multi step form

// tombol navigasi form
const formIndicatorPositions = document.querySelectorAll(
    "[data-form-tab-control]"
);

let formPositions = 1;
const formTabCount = formIndicatorPositions.length;
const formSections = document.querySelectorAll("[data-form-sections]");
const nextBtnForm = document.querySelector(".btn-next-multistep-form");
const backBtnForm = document.querySelector(".btn-back-multistep-form");
let firstRender = true;

const dataFormOne = [
    {
        key: "#email",
        fn: ["required"],
    },
    {
        key: "#number",
        fn: ["required"],
    },
    {
        key: "#firstName",
        fn: ["required"],
    },
    {
        key: "#lName",
        fn: ["required"],
    },
    {
        key: "#country",
        fn: ["required"],
    },
    {
        key: "#streetAddres",
        fn: ["required"],
    },
    {
        key: "#zipCode",
        fn: ["required"],
    },
    {
        key: "#city",
        fn: ["required"],
    },
    {
        key: "#province",
        fn: ["required"],
    },
];
const reRenderForm = () => {
    // Pertama render g ush validasi
    let valid;
    if (firstRender === false) {
        valid = validateForm(dataFormOne);
        // valid = true;
        formPositions = valid ? parseInt(formPositions) : --formPositions;
        // console.log(valid);
    }
    firstRender = false;

    if (formPositions === 0) {
        formPositions = 1;
    }

    if (formPositions > formTabCount) {
        formPositions--;
    }

    formIndicatorPositions.forEach((item) => {
        const isDataAttrEqualsWithFormPositions =
            item.getAttribute("data-form-tab-control") == formPositions;
        const isDataAttrLessThanEqualWithFormPositions =
            item.getAttribute("data-form-tab-control") <= formPositions;

        item.classList.toggle(
            "form-tab-control__active",
            isDataAttrEqualsWithFormPositions
        );
        item.classList.toggle(
            "cursor-pointer",
            isDataAttrLessThanEqualWithFormPositions
        );
    });
    formSections.forEach((item) => {
        const isDataAttrEqualsWithFormPositions =
            item.getAttribute("data-form-sections") == formPositions;
        item.classList.toggle("d-none", !isDataAttrEqualsWithFormPositions);
    });
    // console.log(formSections[formPositions - 1].querySelectorAll("input"));
};
reRenderForm();

// Jika paginasi tab ditekan
document.addEventListener("click", (e) => {
    /**
     * @type {HTMLDivElement} target
     */
    const target = e.target;
    const isDataAttrGTRWithFormPositions =
        target.getAttribute("data-form-tab-control") >= formPositions;
    // Kalo bukan tab yang ditekan keluar
    // Kalo isDataAttrGTRWithFormPositions keluar
    if (
        !target.closest("[data-form-tab-control]") ||
        isDataAttrGTRWithFormPositions
    )
        return;

    const number = target.getAttribute("data-form-tab-control");
    formPositions = parseInt(number);

    reRenderForm();
});

nextBtnForm?.addEventListener("click", () => {
    formPositions++;
    reRenderForm();
});
backBtnForm?.addEventListener("click", () => {
    formPositions--;
    reRenderForm();
});

// Hapus item ketika tombol ditekan
// const buttonsDeleteItem = document.querySelectorAll(
//     '[data-actions="delete-item"]'
// );
// document.addEventListener("click", (e) => {
//     const isNotBtnDelete = !e.target.closest('[data-actions="delete-item"]');

//     if (isNotBtnDelete) return;
//     const btnDelete = e.target.closest('[data-actions="delete-item"]');

//     btnDelete
//         .closest(".d-flex.justify-content-between.align-items-center.mb-4.mt-4")
//         .remove();
// });

// bisa ganti gambar qty
// side-image
// main-image
const sideImage = document.querySelectorAll(".side-image");
const mainImageContainer = document.querySelector(".main-image");
// Dikeluarin g ngaruh, cuman biar di konsole g error
if (mainImageContainer) {
    const imagePositions = mainImageContainer.querySelector(".fw-bold");
    const mainImage = mainImageContainer.querySelector("img");
}

document.addEventListener("click", (e) => {
    const isNotSideImage = !e.target.closest(".side-image");

    if (isNotSideImage) return;
    e.preventDefault();

    const sideImageElement = e.target.closest(".side-image");
    const sideImageElementData = sideImageElement.getAttribute(
        "data-side-image-positions"
    );
    const sideImageElementImg = sideImageElement.querySelector("img");

    imagePositions.innerHTML = `${sideImageElementData}/2`;
    mainImage.src = sideImageElementImg.src;

    sideImage.forEach((item) => {
        const isActive =
            item.getAttribute("data-side-image-positions") ==
            sideImageElementData;
        item.classList.toggle("opacity-75", !isActive);
    });
});

function validateForm(props) {
    let result = true;

    for (const { key, fn } of props) {
        /**
         * @type {HTMLInputElement} element
         */
        const element = document.querySelector(key);
        for (const fnName of fn) {
            switch (fnName) {
                case "required":
                    const isElementEmpty = element.value === "";
                    // element.toggle("invalid", isElementEmpty);
                    if (isElementEmpty === true) {
                        element.classList.add("invalid");
                        result = false;
                    } else element.classList.remove("invalid");

                    break;
                default:
                    break;
            }
        }
    }

    return result;
}
