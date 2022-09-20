let kota = null;

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
function numberWithCommas(x) {
    let rp = "Rp ";
    return rp + x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}
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
const btnpay = document.querySelector(".btn-pay-multistep-form");
// const backBtnForm = document.querySelector(".btn-back-multistep-form");
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
    }
    firstRender = false;

    if (formPositions === 0) {
        formPositions = 1;
    }

    if (formPositions > formTabCount) {
        formPositions--;
    }
    btnpay?.classList.add("d-none");

    nextBtnForm?.classList.remove("d-none");

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

nextBtnForm?.addEventListener(
    "click",
    /**
     * @param {Event & {target: HTMLDivElement}} e
     */ (e) => {
        formPositions++;
        reRenderForm();
        if (formPositions == 2) {
            e.target.classList.add("d-none");
            btnpay?.classList.remove("d-none");

            return;
        }
    }
);
// backBtnForm?.addEventListener("click", () => {
//     formPositions--;
//     reRenderForm();
// });

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

const /**@typeof ${HTMLSelectElement} */ inputProvience = document.querySelector(
        ".province-select"
    );
const /**@typeof ${HTMLSelectElement} */ inputCity = document.querySelector(
        ".city-select"
    );
// raja ongkir
let urlRajaOngkirProvince = "/api/province";
fetch(urlRajaOngkirProvince, {})
    .then((response) => {
        return response.json();
    })
    .then((data) => {
        const {
            rajaongkir: { results: province },
        } = data;
        for (const { province: province_name, province_id } of province) {
            const option = document.createElement("option");
            option.innerHTML = province_name;
            option.setAttribute("value", province_id);
            inputProvience.appendChild(option);
        }
        // console.log(inputProvience);
    })
    .then((res) => {
        $(".province-select").select2({
            placeholder: " Select Province",
            // allowClear: true,
        });
        $(".province-select").on("change.select2", function (e) {
            // Do something
            // console.log(this.value);
            let urlRajaOngkirCity = `/api/city/${this.value}`;
            fetch(urlRajaOngkirCity, {})
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    const {
                        rajaongkir: { results: city },
                    } = data;

                    inputCity.textContent = "";
                    for (const { city_name, city_id } of city) {
                        const option = document.createElement("option");
                        option.innerHTML = city_name;
                        option.setAttribute("value", city_id);
                        inputCity.appendChild(option);
                    }
                })
                .then((res) => {
                    $(".city-select").select2({
                        placeholder: " Select City",
                    });

                    $(".city-select").on("change.select2", function (e) {
                        kota = e.target.value;
                    });
                });
        });
    });
$(".province-select").select2({
    placeholder: " Select Province",
});
$(".city-select").select2({
    placeholder: " Select City",
});

let total_berat;

document.getElementById("selectCourier").addEventListener("change", (e) => {
    let urlRajaOngkirWeight = "/weight";
    fetch(urlRajaOngkirWeight, {})
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            total_berat = data;
            let urlRajaOngkirCost =
                "/cost-ongkir?" +
                new URLSearchParams({
                    destination: kota,
                    weight: total_berat,
                    courier: e.target.value,
                });
            let orders = {
                destination: kota,
                weight: total_berat,
                courier: e.target.value,
            };

            return fetch(urlRajaOngkirCost, {
                method: "GET",
                // headers: {
                //     "Content-Type": "application/json",
                //     Accept: "application/json",
                // },
            });
        })
        .then((res) => {
            return res.json();
        })
        .then((data) => {
            // console.log(data);
            const costShipping = document.querySelector("[data-description]");
            costShipping.innerHTML = numberWithCommas(
                data.raja_ongkir.rajaongkir.results[0].costs[0].cost[0].value
            );

            const totalHarga =
                data.total_harga +
                data.raja_ongkir.rajaongkir.results[0].costs[0].cost[0].value;

            const grandTotal = document.querySelector("[data-total]");
            grandTotal.innerHTML = numberWithCommas(totalHarga);

            // console.log(data.total_harga);
            // console.log(
            //     data.raja_ongkir.rajaongkir.results[0].costs[0].cost[0].value
            // );
        });
});
