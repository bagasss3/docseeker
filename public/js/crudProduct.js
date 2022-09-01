// Data table
$(function () {
    $("#example1")
        .DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
        })
        .buttons()
        .container()
        .appendTo("#example1_wrapper .col-md-6:eq(0)");
});

// Modal delete
/**
 * @type {HTMLDivElement} modalText
 */
const modalText = document.querySelector("#modal-danger p");
/**
 * @type {HTMLFormElement} modalForm
 */
const modalForm = document.querySelector("#modal-danger form");

document.addEventListener("click", (e) => {
    /**
     * @type {HTMLDivElement} target
     */
    let target = e.target;
    if (target.closest("[data-target='#modal-danger']") === null) return;
    target = target.closest("[data-target='#modal-danger']");
    // console.log("HERE", target);
    const text = target.getAttribute("data-message");
    const id = target.getAttribute("data-id");
    // console.log(text, id);

    const url = `/admin/product/${id}`;

    modalForm.setAttribute("action", url);
    modalText.innerHTML = text;
});

// End modal delete

// Edit modal
const /**@typeof {HTMLFormElement} */ editForm =
        document.querySelector("#edit-form");
const /**@typeof {HTMLInputElement} */ editName =
        document.querySelector("#name");
const /**@typeof {HTMLInputElement} */ editHarga =
        document.querySelector("#harga");
const /**@typeof {HTMLInputElement} */ editStock =
        document.querySelector("#stock");
const /**@typeof {HTMLInputElement} */ editCategory =
        document.querySelector("#category");
const /**@typeof {HTMLInputElement} */ editGender =
        document.querySelector("#gender");
const /**@typeof {HTMLInputElement} */ editbrand =
        document.querySelector("#brand");
const /**@typeof {HTMLTextAreaElement} */ editDesc =
        document.querySelector("#desc");

document.addEventListener("click", (e) => {
    /**
     * @type {HTMLDivElement} target
     */
    let target = e.target;
    if (target.closest("[data-target='#modal-edit']") === null) return;
    target = target.closest("[data-target='#modal-edit']");

    const id = target.getAttribute("data-id");

    const url = `/api/products/${id}`;
    const urlUpdate = `/admin/product/${id}`;
    editForm.setAttribute("action", urlUpdate);
    fetch(urlUpdate)
        .then((response) => response.json())
        .then((data) => {
            editName.value = data.product_title;
            editHarga.value = data.product_harga;
            editStock.value = data.stock;
            editCategory.value = data.product_cat;
            editGender.value = data.product_gender;
            editbrand.value = data.product_brand;
            editDesc.value = data.product_desc;
        });
});
