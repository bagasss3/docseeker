// Dropdown
let options = document.getElementById("options");
let optionList = [
    "Send",
    "Canceled",
    "Returned",
    "Packed",
    "Finished",
    "Accepted",
];

let isOpen = false;

options.addEventListener("click", addToUIOptions);

function addToUIOptions(e) {
    if (e.target.classList.contains("hide-option")) {
        controlOptions(e);
    } else {
        const pickedOption = e.target;

        if (options.firstElementChild.classList.contains("hide-option")) {
            options.removeChild(options.firstElementChild);
        }
        let div = document.createElement("div");
        div.innerHTML = pickedOption.innerHTML;
        div.classList.add("option");
        options.insertAdjacentElement("afterbegin", div);

        deleteOptions();
        controlOptions(e);
    }
}

function controlOptions(e) {
    if (isOpen === false) {
        createOptions();
        options.classList.add("opened");
        isOpen = true;
    } else {
        deleteOptions();
        options.classList.remove("opened");
        isOpen = false;
    }
}

function deleteOptions() {
    while (options.childElementCount > 1) {
        options.removeChild(options.lastElementChild);
    }
}

let selectedOption = "";
function createOptions() {
    optionList.forEach((selectedOption) => {
        if (options.firstElementChild.textContent !== selectedOption) {
            let option = document.createElement("div");
            option.className = "option asd";
            option.textContent = selectedOption;
            options.firstElementChild.insertAdjacentElement("afterend", option);
        }
    });
}

document.addEventListener(
    "click",
    /**
     * @param {Event & {target: HTMLDivElement}} e
     */ async (e) => {
        // console.log(e.target.classList.contains("asd"));
        if (e.target.classList.contains("asd") == false) return;

        // variabel isi
        let selectOption = { status: e.target.innerHTML };

        fetchTest(selectOption);
    }
);

let urlFilterOrders = "/profile/orders";
const fetchTest = async (pilihan) => {
    const data = await fetch(urlFilterOrders, {
        body: JSON.stringify(pilihan),
        method: "POST",
        headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
    }).then((response) => response.json());

    const tabelTBody = document.querySelector(".order-body");

    tabelTBody.innerHTML = "";

    for (const item of data.data) {
        console.log(item);

        let template = `         <tr>
        <!-- <th scope="row" data-id="">12324242</th> -->
        <th> ${item.id}</th>
        <td> ${item.status}</td>
        <td>
            <a type="button" class="btn btn-primary" href="profile/orders/${item.id}">Detail</a>
        </td>
    </tr>`;

        tabelTBody.insertAdjacentHTML("afterbegin", template);
    }
};

const listNav = document.querySelectorAll(".profile-nav-menu li");
const listMenu = document.querySelectorAll("[data-menu-profile]");

// console.log(listMenu);
// menu nav
document.addEventListener("click", (e) => {
    /**
     * @type {HTMLDivElement} target
     */

    const target = e.target;

    if (target.closest(".profile-nav-menu li") == null) {
        return;
    }

    const activeMenu = target.getAttribute("data-menu-active-profile");

    for (const node of listMenu) {
        const isNotActive =
            activeMenu !== node.getAttribute("data-menu-profile");
        node.classList.toggle("d-none", isNotActive);
    }
    for (const node of listNav) {
        const isNotActive =
            activeMenu === node.getAttribute("data-menu-active-profile");
        node.classList.toggle("active", isNotActive);
    }
});
