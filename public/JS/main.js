var products = []

if (localStorage.getItem("items") == null || products.length == 0) {
    products = []

} else {
    products = JSON.parse(localStorage.getItem("items"))
    display()
}

var productName = document.getElementById("ProductName")
var productCategory = document.getElementById("ProductCategory")
var productPrice = document.getElementById("ProductPrice")
var productDescription = document.getElementById("ProductDescription")


function setData() {

    if(productName.value==0){
        document.getElementById("alert").style.display="block"
        document.getElementById("alert").innerHTML="Enter a valid name"

    }
    else{
        var product = {
            productName: productName.value,
            productCategory: productCategory.value,
            productPrice: productPrice.value,
            productDescription: productDescription.value
        }
        products.push(product)

        localStorage.setItem("items", JSON.stringify(products))
        display()
        clear()
    }



}



function display() {
    console.log(products.length);
    var copaya = ``;
    for (var i = 0; i < products.length; i++) {
        copaya += `<tr>
            <td id="id">${i}</td>
            <td>${products[i].productName}</td>
            <td>${products[i].productCategory}</td>
            <td>${products[i].productPrice}</td>
            <td>${products[i].productDescription}</td>
            <td><button onclick="Update(${i})" class="btn btn-info">Update</button></td>
            <td><button onclick="Delete(${i})" class="btn btn-danger">Delete</button></td>
        </tr>`

    }
    document.getElementById("demo").innerHTML = copaya


}


function Delete(index) {
    products.splice(index, 1)
    localStorage.setItem("items", JSON.stringify(products))
    display()

}


function Update(index) {
    if (productName.value == 0) {
        document.getElementById("ProductName").value = products[index].productName
        document.getElementById("ProductCategory").value = products[index].productCategory
        document.getElementById("ProductPrice").value = products[index].productPrice
        document.getElementById("ProductDescription").value = products[index].productDescription
    }

    else{
        updateprodect = {
            productName: productName.value,
            productCategory: productCategory.value,
            productPrice: productPrice.value,
            productDescription: productDescription.value
        }

        console.log(products.splice(index, 1, updateprodect));
        localStorage.setItem("items", JSON.stringify(products))
        display()
        clear()
    }
}
function clear() {
    productName.value = ""
    productCategory.value = ""
    productPrice.value = ""
    productDescription.value = ""
}


function search() {
    var textSearch = document.getElementById('search').value
    // console.log(textSearch);
    var copaya2 = ``
    for (var i = 0; i < products.length; i++) {
        if (products[i].productName.toLowerCase().includes(textSearch.toLowerCase())) {
            copaya2 += `<tr>
            <td>${i+1}</td>
            <td>${products[i].productName}</td>
            <td>${products[i].productCategory}</td>
            <td>${products[i].productPrice}</td>
            <td>${products[i].productDescription}</td>
            <td><button onclick="Update(${i})" class="btn btn-info">Update</button></td>
            <td><button onclick="Delete(${i})" class="btn btn-danger">Delete</button></td>
        </tr>`
        }
        document.getElementById("demo").innerHTML = copaya2

    }
}
