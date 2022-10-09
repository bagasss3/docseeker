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
    // {
    //     key: "#country",
    //     fn: ["required"],
    // },
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

let email = document.querySelector("#email");
let number = document.querySelector("#number");
let fName = document.querySelector("#firstName");
let lName = document.querySelector("#lName");
let streetAddres = document.querySelector("#streetAddres");
let zipCode = document.querySelector("#zipCode");

email.addEventListener("input", function (e) {
    email = e.target.value;
    // console.log(email);
});

number.addEventListener("input", function (e) {
    number = e.target.value;
    // console.log(number);
});

fName.addEventListener("input", function (e) {
    fName = e.target.value;
    // console.log(fName);
});

lName.addEventListener("input", function (e) {
    lName = e.target.value;
    // console.log(lName);
});

streetAddres.addEventListener("input", function (e) {
    streetAddres = e.target.value;
    // console.log(streetAddres);
});

zipCode.addEventListener("input", function (e) {
    zipCode = e.target.value;
    // console.log(zipCode);
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

let total_berat;

const /**@typeof ${HTMLSelectElement} */ inputProvience =
        document.querySelector(".province-select");
const /**@typeof ${HTMLSelectElement} */ inputCity =
        document.querySelector(".city-select");
// raja ongkir

$(inputProvience).select2({
    placeholder: " Select Province",
});

let selectedProvince = "";
$(inputProvience).on("change", function (e) {
    // Do something
    // console.log(this.value);
    let urlRajaOngkirCity = `/api/city/${this.value}`;

    selectedProvince = e.target.options[e.target.selectedIndex].innerHTML;
    // console.log(selectedProvince);
    fetchNewCity(urlRajaOngkirCity);
    // console.log(this.value);
});

$(inputCity).select2({
    placeholder: " Select City",
});

let selectedCity = "";
$(inputCity).on("change", function (e) {
    kota = e.target.value;
    selectedCity = e.target.options[e.target.selectedIndex].innerHTML;
    // console.log(selectedCity);
});

const fetchNewCity = async (url) => {
    const data = await fetch(url, {}).then((response) => response.json());

    const {
        rajaongkir: { results: city },
    } = data;
    inputCity.textContent = "";
    kota = city[0].city_id;
    for (const { city_name, city_id } of city) {
        const option = document.createElement("option");
        option.innerHTML = city_name;
        option.setAttribute("value", city_id);
        inputCity.appendChild(option);
    }
};

let urlRajaOngkirProvince = "/api/province";

const fetchProvince = async () => {
    const data = await fetch(urlRajaOngkirProvince, {}).then((response) =>
        response.json()
    );

    const {
        rajaongkir: { results: province },
    } = data;
    for (const { province: province_name, province_id } of province) {
        const option = document.createElement("option");
        option.innerHTML = province_name;
        option.setAttribute("value", province_id);
        inputProvience?.appendChild(option);
    }
    // console.log(inputProvience);
};

fetchProvince();
let totalBerat;

fetch("/weight", {})
    .then((resp) => resp.json())
    .then((weight) => {
        totalBerat = weight;
    });

const btnSelectService = document.querySelector(".select-service");

const extrackNumberFromText = (text) => {
    return text.match(/\d/g).join("");
};

let costShipping = 0;
let subTotal = 0;
let selectedService = "";

btnSelectService?.addEventListener("change", function (e) {
    /**
     * @type {HTMLOptionElement} costShipping
     */
    costShipping = parseInt(e.target.value);
    // format harga
    const costShippingElement = document.querySelector("[data-description]");
    costShippingElement.innerHTML = numberWithCommas(costShipping);

    /**
     * @type {HTMLHeadingElement} subTotalElement
     */
    const subTotalElement = document.querySelector(".helper-temp-class");
    subTotal = extrackNumberFromText(subTotalElement?.innerText);

    // total harga
    let totalHarga = parseInt(subTotal) + parseInt(costShipping);

    selectedService = e.target.options[e.target.selectedIndex].innerHTML;
    const grandTotal = document.querySelector("[data-total]");
    grandTotal.innerHTML = numberWithCommas(totalHarga);
});

const btnSelectCourier = document.querySelector(".select-courier");

const fetchRajaOngkirCosts = async (url) => {
    const data = await fetch(url, {}).then((resp) => resp.json());

    //
    btnSelectService.classList.remove("d-none");
    btnSelectService.innerHTML = "";
    let opt = document.createElement("option");
    opt.innerHTML = "Pilih Service";
    opt.selected = true;
    btnSelectService.appendChild(opt);
    // console.log(data);

    const elementService = data.raja_ongkir?.rajaongkir.results[0].costs;

    // console.log(data);
    // console.log(elementService);
    if (elementService === undefined || elementService.length == 0) {
        opt.innerHTML = "Service Tidak Tersedia";
        btnSelectService.setAttribute("disabled", "true");
    } else {
        for (const data of elementService) {
            selectedService = "";
            selectedService = data.service;
            let opt = document.createElement("option");
            opt.innerHTML = selectedService;
            opt.value = data.cost[0].value;
            // console.log(opt.value);
            // console.log(opt.value);
            // opt.setAttribute(
            //     "data-harga",
            //     elementService[i].cost[0].value
            // );
            btnSelectService.appendChild(opt);
        }
    }
    // console.log(btnSelectService);
};

let selectedCourier = "";
btnSelectCourier?.addEventListener("change", (e) => {
    selectedCourier = e.target.value;
    const courier = e.target.value;
    let urlRajaOngkirCost =
        "/cost-ongkir?" +
        new URLSearchParams({
            destination: kota,
            weight: totalBerat,
            courier,
        });
    // console.log(kota, totalBerat, courier);
    fetchRajaOngkirCosts(urlRajaOngkirCost);
});

// midtrans
let urlMidtrans = "/transaction";
var payButton = document.getElementById("btn-pay");
payButton?.addEventListener("click", async function () {
    // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
    const data = {
        user_id: 3,
        gross_amount: subTotal,
        ongkir_service: selectedService,
        ongkir_courier: selectedCourier,
        ongkir_cost: costShipping,
        first_name: fName,
        last_name: lName,
        email: email,
        phone: number,
        address: streetAddres,
        zip_code: zipCode,
        cities: selectedCity,
        province: selectedProvince,
        country: "Indonesia",
    };

    const { token } = await fetch(urlMidtrans, {
        method: "POST",
        body: new URLSearchParams(data),
    }).then((response) => response.json());

    window.snap.pay(token, {
        onSuccess: function (result) {
            /* You may add your own implementation here */
            alert("payment success!");
            console.log(result);
        },
        onPending: function (result) {
            /* You may add your own implementation here */
            alert("wating your payment!");
            console.log(result);
        },
        onError: function (result) {
            /* You may add your own implementation here */
            alert("payment failed!");
            console.log(result);
        },
        onClose: function () {
            /* You may add your own implementation here */
            alert("you closed the popup without finishing the payment");
        },
    });
});
