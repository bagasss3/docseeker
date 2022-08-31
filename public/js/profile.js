// Dropdown
let options = document.getElementById("options");
let optionList = ["belum bayar", "dikemas", "di kirim"];

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
        options.insertAdjacentElement("afterbegin", pickedOption);

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

function createOptions() {
    optionList.forEach((element) => {
        if (options.firstElementChild.textContent !== element) {
            let option = document.createElement("div");
            option.className = "option";
            option.textContent = element;

            options.firstElementChild.insertAdjacentElement("afterend", option);
        }
    });
}

const listNav = document.querySelectorAll(".profile-nav-menu li");
const listMenu = document.querySelectorAll("[data-menu-profile]");

console.log(listMenu);
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
