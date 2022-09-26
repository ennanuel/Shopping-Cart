let image, image2, select, prodName, price, quantity, hiddenImg, addProdBtn, editProdBtn, addForm, editForm, editTitle, msg;

[image, image2, select, prodName, price, quantity, hiddenImg, addProdBtn, editProdBtn, addForm, editForm, editTitle, msg] = 
    ['image', 'addImage', 'select-product', 'name', 'price', 'quantity', 'hidden-input', 'add-prod-switch', 'edit-prod-switch', 'add-product', 'edit-product', 'edit-title', 'msg']
        .map(elem => document.getElementById(elem));

const addImage = (e) => {
    let img;

    if(e.target.id == "image") {
        img = document.getElementById("edit-img");
    } else {
        img = document.getElementById("add-img");
        console.log(img);
    }

    if(e.target.value.length > 0) {
        const files = e.target.files;
        const file = files[0];
        const reader = new FileReader();

        reader.readAsDataURL(file);
        reader.onload = () => { img.src = reader.result };
    }
};

image.addEventListener("change", addImage);
image2.addEventListener("change", addImage);

const selectProduct = (e) => {

    let img = document.getElementById("edit-img");
    
    if(e.target.value === "") {

        prodName.value = "";
        editTitle.innerHTML = "Edit Product";
        price.value = "";
        quantity.value = "";
        img.src = "./images/empty.png";
        hiddenImg.value = "";
        return;

    }

    let product = document.getElementById(e.target.value);
    let val = product.dataset;
    let src = "images/products/" + val['img'];

    prodName.value = val['title'];
    editTitle.innerHTML = val['title'];
    price.value = val['price'];
    quantity.value = val['quantity'];
    img.src = src;
    hiddenImg.value = val['img'];

}

const changeTitle = (e) => {
    let text = e.target.value.length > 0? e.target.value: "Input Name";
    editTitle.innerHTML = text;
}

prodName.addEventListener('input', changeTitle)

select.addEventListener('change', selectProduct);

const toggleAdd = (e) => {
    addForm.style.display = "block";
    editForm.style.display = "none";
    e.target.style.backgroundColor= "#92b7c3";
    e.target.style.top = "2px";
    editProdBtn.style.backgroundColor = "#ffd700";
    editProdBtn.style.top = "0";
    msg.innerHTML = "";
}

const toggleEdit = (e) => {
    editForm.style.display = "block";
    addForm.style.display = "none";
    e.target.style.backgroundColor= "#dbba02";
    e.target.style.top = "2px";
    addProdBtn.style.backgroundColor = "#add8e6";
    addProdBtn.style.top = "0";
    msg.innerHTML = "";
}

addProdBtn.addEventListener('click', toggleAdd);
editProdBtn.addEventListener('click', toggleEdit);