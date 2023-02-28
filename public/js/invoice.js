let inputStock = document.querySelector("#inputQuantityStock");
let inputTotalInvoice = document.querySelector("#inputValueTotal");
let productsView = 0;
let productsList = 0;
let totalInvoice = 0;
let formProductsList = new FormData();

//invoice
$(document).ready(function () {
    $("#selectProducts").select2();
});

$("#selectProducts").on("select2:select", function (e) {
    let value = e.target.value;
    Livewire.emit("changeProduct", value);
});

function add() {
    let form = document.querySelector("#formProduct");
    let data = new FormData(form);
    const values = Object.fromEntries(data.entries());

    if (values.product < 1 || values.quantity < 1) {
        return messages("error", "No es posible agregar el producto", true);
    }
    productsView++;
    productsList++;
    let productText = $("#selectProducts :selected").text();
    let tax = values.tax;


    formProductsList.append('totalView', productsView);
    formProductsList.append(`product${productsView}`, values.product);
    formProductsList.append(`quantity${productsView}`, values.quantity);

    addRow(values.quantity, values.vlrUnit, values.total, productsView, productText, productsList, tax);
    form.reset();
    $("#selectProducts").val(null).trigger("change");
}

function addRow(quantity, vlrUnit, VlrTotal, item, productText, itemsTotal, tax) {
    const rowForm = document.getElementById("rowForm");
    let row = document.createDocumentFragment();
    const divRow = document.createElement("div");
    divRow.setAttribute("class", "form-row");
    divRow.setAttribute("id", `row${item}`);
    const divNumber = document.createElement("div");
    divNumber.setAttribute("class", "col-md-1 border border-dark p-0");
    const inputNumber = document.createElement("input");
    inputNumber.setAttribute("type", "text");
    inputNumber.setAttribute("value", itemsTotal);
    inputNumber.setAttribute("id", `number${item}`);
    inputNumber.setAttribute("class", "form-control col-md-12 inputDisabled");
    inputNumber.setAttribute("disabled", "");
    const divProduct = document.createElement("div");
    divProduct.setAttribute("class", "col-md-4 border border-dark p-0");
    const inputProduct = document.createElement("input");
    inputProduct.setAttribute("type", "text");
    inputProduct.setAttribute("value", productText);
    inputProduct.setAttribute("class", "form-control col-md-12 inputDisabled");
    inputProduct.setAttribute("disabled", "");
    const divCant = document.createElement("div");
    divCant.setAttribute("class", "col-md-1 border border-dark p-0");
    const inputCant = document.createElement("input");
    inputCant.setAttribute("type", "number");
    inputCant.setAttribute("value", quantity);
    inputCant.setAttribute("class", "form-control col-md-12 inputDisabled");
    inputCant.setAttribute("disabled", "");
    const divUnit = document.createElement("div");
    divUnit.setAttribute("class", "col-md-2 border border-dark p-0");
    const inputUnit = document.createElement("input");
    inputUnit.setAttribute("type", "text");
    inputUnit.setAttribute(
        "value",
        new Intl.NumberFormat("es-CO", {
            style: "currency",
            currency: "COP",
        }).format(vlrUnit)
    );
    inputUnit.setAttribute("class", "form-control col-md-12 inputDisabled");
    inputUnit.setAttribute("disabled", "");
    const divTax = document.createElement("div");
    divTax.setAttribute("class", "col-md-1 border border-dark p-0");
    const inputTax = document.createElement("input");
    inputTax.setAttribute("type", "text");
    inputTax.setAttribute("value", tax);
    inputTax.setAttribute("class", "form-control col-md-12 inputDisabled");
    inputTax.setAttribute("disabled", "");
    const divTotal = document.createElement("div");
    divTotal.setAttribute("class", "col-md-2 border border-dark p-0");
    const inputTotal = document.createElement("input");
    inputTotal.setAttribute("type", "text");
    inputTotal.setAttribute(
        "value",
        new Intl.NumberFormat("es-CO", {
            style: "currency",
            currency: "COP",
        }).format(Number(VlrTotal)+(VlrTotal*tax/100))
    );
    inputTotal.setAttribute("class", "form-control col-md-12 inputDisabled");
    inputTotal.setAttribute("disabled", "");
    const divOptions = document.createElement("div");
    divOptions.setAttribute("class", "col-md-1  ");
    const buttonPlus = document.createElement("button");
    buttonPlus.setAttribute("class", "btn btn-danger");
    buttonPlus.setAttribute("type", "button");
    buttonPlus.setAttribute("onclick", `rowRemove(${item}, ${VlrTotal})`);
    const icon = document.createElement("i");
    icon.setAttribute("class", "far fa-trash-alt");
    buttonPlus.appendChild(icon);
    divOptions.append(buttonPlus);

    divProduct.append(inputProduct);
    divNumber.append(inputNumber);
    divCant.append(inputCant);
    divUnit.append(inputUnit);
    divTotal.append(inputTotal);
    divTax.append(inputTax);
    divRow.appendChild(divNumber);
    divRow.appendChild(divProduct);
    divRow.appendChild(divCant);
    divRow.appendChild(divUnit);
    divRow.appendChild(divTax);
    divRow.appendChild(divTotal);
    divRow.appendChild(divOptions);
    row.appendChild(divRow);

    rowForm.appendChild(row);
    totalInvoice += quantity * vlrUnit +(quantity * vlrUnit * tax /100);
    new Intl.NumberFormat("es-CO", {
        style: "currency",
        currency: "COP",
    }).format(row.precio);
    inputTotalInvoice.value = new Intl.NumberFormat("es-CO", {
        style: "currency",
        currency: "COP",
    }).format(totalInvoice);
}

function rowRemove(item, valueTotal){
    formProductsList.delete(`product${item}`);
    formProductsList.delete(`quantity${item}`);

    productsList--;
    // formProductsList.append('totalItems', itemsTotal)
    totalInvoice -= valueTotal;
    inputTotalInvoice.value = new Intl.NumberFormat("es-CO", { style: "currency", currency: "COP",}).format(totalInvoice);

    let row = document.getElementById(`row${item}`);
    rowForm.removeChild(row);

    let val = 1;
    for(i = 0; i<productsView; i++){
        let input = document.getElementById(`number${i+1}`);
        if(input !== null){
            input.value = val;
            val++;
        }
    }

}

function send(){
    let formClient = document.querySelector('#formClient');
    let dataClient = new FormData(formClient);
    for (const [nombre, valor] of dataClient.entries()) {
        formProductsList.append(nombre, valor);
      }
      const values = Object.fromEntries(formProductsList.entries());
      if(values.dni === '' || values.nameClient === '' || values.document_type < 1){
        return messages('error', 'Verifique datos de cliente', true)
      }

      if(productsList < 1 || values.totalView < 1){
        return messages('error', 'Ingrese productos a facturar', true)
      }

      let listado = Object.fromEntries(formProductsList.entries());
      console.log(listado);
      //enviar a servidor factura
      sendInvoice(formProductsList);
}

async function sendInvoice(data){//recibo formData
    try{
        const response = await fetch('/admin/facturacion', {
            method: 'Post',
            body: data,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        });
        if (!response.ok) {
            messages('error', 'Ocurrió un error interno, contacte al administrador del sistema', true)
            throw new Error(`HTTP error! status: ${response.status}`);
          }

          const res = await response.json();

        if(res.status == 200){
            //Livewire.emit('lineAdded')
            messages('success', res.msg, false, 1500);
            //productsTable.ajax.reload(null, false);
            //recargarTablas(table);
        }else{
            messages('error', res.msg, true);
        }
        //reset a formulario encabezados
        document.querySelector('#formClient').reset();
        //$('#selectProducts').val(null).trigger('change');
        //elimino listado de productos
        const listProducts = document.getElementById('rowForm');
        while (listProducts.firstChild) {
            listProducts.removeChild(listProducts.firstChild);
          }

          productsList = 0;
          productsView = 0;
          totalInvoice = 0;
          inputTotalInvoice.value = new Intl.NumberFormat("es-CO", { style: "currency", currency: "COP",}).format(totalInvoice);
        // for(let i=0; i<itemsView){

        // }
    }catch(error){
        console.error(error);
        return messages('error', 'Ocurrió un error inesperado, contacte al administrador del sistema', true)
    }
}
