let selectProducts = document.getElementById('selectProducts');
let selectTax = document.getElementById('selectTax');
let inputQuantity = document.getElementById('inputQuantity');
let inputLocation = document.getElementById('location');
let inputVlrUnit = document.getElementById('inputVlrUnitario');
let inputVlrTotal = document.getElementById('inputVlrTotal');
let formProducts = document.getElementById('formProducts');
let inputTotalIva = document.getElementById('inputIvaTotal');
let inputTotalInvoice = document.getElementById('inputValueTotal');
let itemsTotal = 0;
let itemsView = 0;
let totalIva = 0;
let totalInvoice = 0;
inputTotalIva.value = new Intl.NumberFormat("es-CO", { style: "currency", currency: "COP",}).format(totalIva);
inputTotalInvoice.value = new Intl.NumberFormat("es-CO", { style: "currency", currency: "COP",}).format(totalInvoice);

let formProductsList = new FormData();

function changeVlrUnit(){
    if(inputQuantity !== '' && inputVlrTotal !== ''){
        inputVlrTotal.value = Number(inputQuantity.value)*inputVlrUnit.value;
        inputVlrTotal.innerHTML = new Intl.NumberFormat("es-CO", { style: "currency", currency: "COP",}).format(Number(inputQuantity.value)*inputVlrUnit.value);
    }
}

function addRow(quantity, vlrUnit, VlrTotal, item, productText, itemsTotal, taxtText, taxValue){
    const rowForm = document.getElementById('rowForm');
    let row = document.createDocumentFragment();
    const divRow = document.createElement('div');
    divRow.setAttribute('class', 'form-row');
    divRow.setAttribute('id', `row${item}`);
    const divNumber = document.createElement('div');
    divNumber.setAttribute('class', 'col-md-1 border border-dark p-0');
    const inputNumber = document.createElement('input');
    inputNumber.setAttribute('type', 'text');
    inputNumber.setAttribute('value', itemsTotal);
    inputNumber.setAttribute('id', `number${item}`);
    inputNumber.setAttribute('class', 'form-control col-md-12 inputDisabled');
    inputNumber.setAttribute('disabled', '');
    const divProduct = document.createElement('div');
    divProduct.setAttribute('class', 'col-md-4 border border-dark p-0');
    const inputProduct = document.createElement('input');
    inputProduct.setAttribute('type', 'text');
    inputProduct.setAttribute('value', productText);
    inputProduct.setAttribute('class', 'form-control col-md-12 inputDisabled');
    inputProduct.setAttribute('disabled', '');
    const divCant = document.createElement('div');
    divCant.setAttribute('class', 'col-md-1 border border-dark p-0')
    const inputCant = document.createElement('input');
    inputCant.setAttribute('type', 'number');
    inputCant.setAttribute('value', quantity);
    inputCant.setAttribute('class', 'form-control col-md-12 inputDisabled');
    inputCant.setAttribute('disabled', '');
    const divUnit = document.createElement('div');
    divUnit.setAttribute('class', 'col-md-2 border border-dark p-0');
    const inputUnit = document.createElement('input');
    inputUnit.setAttribute('type', 'text');
    inputUnit.setAttribute('value', new Intl.NumberFormat("es-CO", { style: "currency", currency: "COP",}).format(vlrUnit));
    inputUnit.setAttribute('class', 'form-control col-md-12 inputDisabled');
    inputUnit.setAttribute('disabled', '');
    const divTaxt = document.createElement('div');
    divTaxt.setAttribute('class', 'col-md-1 border border-dark p-0');
    const inputTax = document.createElement('input');
    inputTax.setAttribute('class', 'form-control col-md-12 inputDisabled');
    inputTax.setAttribute('disabled', '');
    inputTax.setAttribute('type', 'text');
    inputTax.setAttribute('value', taxValue);

    const divTotal = document.createElement('div');
    divTotal.setAttribute('class', 'col-md-2 border border-dark p-0');
    const inputTotal = document.createElement('input');
    inputTotal.setAttribute('type', 'text');
    inputTotal.setAttribute('value', new Intl.NumberFormat("es-CO", { style: "currency", currency: "COP",}).format(vlrUnit*quantity));
    inputTotal.setAttribute('class', 'form-control col-md-12 inputDisabled  text-right');
    inputTotal.setAttribute('disabled', '');
    const divOptions = document.createElement('div');
    divOptions.setAttribute('class', 'col-md-1  ')
    const buttonPlus = document.createElement('button');
    buttonPlus.setAttribute('class', 'btn btn-danger');
    buttonPlus.setAttribute('type', 'button');
    buttonPlus.setAttribute('onclick', `rowRemove(${item}, ${VlrTotal}, ${taxValue}, ${vlrUnit*quantity})`);
    const icon = document.createElement('i');
    icon.setAttribute('class', 'far fa-trash-alt');
    buttonPlus.appendChild(icon);
    divOptions.append(buttonPlus);


    divProduct.append(inputProduct);
    divNumber.append(inputNumber);
    divCant.append(inputCant);
    divUnit.append(inputUnit);
    divTaxt.append(inputTax);
    divTotal.append(inputTotal);
    divRow.appendChild(divNumber);
    divRow.appendChild(divProduct);
    divRow.appendChild(divCant);
    divRow.appendChild(divUnit);
    divRow.appendChild(divTaxt);
    divRow.appendChild(divTotal);
    divRow.appendChild(divOptions);
    row.appendChild(divRow);

    rowForm.appendChild(row);
    totalIva += quantity*(vlrUnit*taxValue/100);
    totalInvoice += quantity*(vlrUnit*taxValue/100 + Number(vlrUnit));
    // totalInvoice += quantity*vlrUnit+totalIva;
    new Intl.NumberFormat("es-CO", {
        style: "currency",
        currency: "COP",
    }).format(row.precio);
    inputTotalIva.value = new Intl.NumberFormat("es-CO", { style: "currency", currency: "COP",}).format(totalIva);
    inputTotalInvoice.value = new Intl.NumberFormat("es-CO", { style: "currency", currency: "COP",}).format(totalInvoice);
}


jQuery(function($) {
    $('#selectSupplier').select2({
        placeholder: 'Seleccione un proveedor',
    });
    $('#selectSupplier').on('select2:open', function() {
        // $("#selectSupplier").trigger('select2:open');
        document.querySelector('.select2-search__field').focus();
    });
    $('#selectSupplier').on('select2:select', function() {
        // $("#selectSupplier").trigger('select2:open');
        document.querySelector('#location').focus();
    });
    // $("#selectSupplier").on('select2:opening', function (e) {
    //     // Establece el enfoque en la entrada de búsqueda del Select2

    //     $('.select2-search__field').trigger('focus');
    //   });
    // $('#selectProducts').select2({
    //     placeholder: 'Seleccione un Producto',
    // });
});

// document.addEventListener('livewire:load', function(){
//     $('#selectProducts').on('change', function(){
//         alert(this.value);
//         @this.set('productId', this.value);
//     });
// });

//addRow();

function clickPlus(e){
    //e.preventDefault();
    addRow();
}

function add(){
    let quantity = inputQuantity.value;
    let location = inputLocation.value;
    let vlrUnit = inputVlrUnit.value;
    let productText = selectProducts.options[selectProducts.selectedIndex].text;
    let product = selectProducts.value;
    let tax = selectTax.value;
    let VlrTotal = (inputVlrTotal.value + inputVlrTotal.value*tax/100);
    let taxText = selectTax.options[selectTax.selectedIndex].text;
    if(quantity !== '' && vlrUnit !== '' && VlrTotal !== '' && product > 0){
        itemsTotal++;
        itemsView++;

        formProductsList.append(`totalItems`, itemsTotal);
        formProductsList.append(`totalView`, itemsView);
        formProductsList.append(`item${itemsView}`, itemsTotal);
        formProductsList.append(`product${itemsView}`, product);
        formProductsList.append(`cant${itemsView}`, quantity);
        formProductsList.append(`vlrUnit${itemsView}`, vlrUnit);
        formProductsList.append(`tax${itemsView}`, tax);
        formProductsList.append(`location${itemsView}`, location);

        addRow(quantity, vlrUnit, VlrTotal, itemsView, productText, itemsTotal, taxText, tax);
        formProducts.reset();
        $('#selectProducts').val(null).trigger('change');


    }
}

function rowRemove(item, valueTotal, taxValue, valueSinIva){
    formProductsList.delete(`item${item}`);
    formProductsList.delete(`product${item}`);
    formProductsList.delete(`cant${item}`);
    formProductsList.delete(`vlrUnit${item}`);
    formProductsList.delete(`tax${item}`);
    formProductsList.delete(`location${item}`);

    itemsTotal--;
    formProductsList.append('totalItems', itemsTotal)
    totalInvoice -= valueTotal;
    totalIva -= (valueSinIva*taxValue/100);
    inputTotalIva.value = new Intl.NumberFormat("es-CO", { style: "currency", currency: "COP",}).format(totalIva);
    inputTotalInvoice.value = new Intl.NumberFormat("es-CO", { style: "currency", currency: "COP",}).format(totalInvoice);

    let row = document.getElementById(`row${item}`);
    rowForm.removeChild(row);

    let val = 1;
    for(i = 0; i<itemsView; i++){
        let input = document.getElementById(`number${i+1}`);
        if(input !== null){
            input.value = val;
            val++;
        }
    }

}

function send(){
    let formSupplier = document.querySelector('#formSupplier');
    let dataSupllier = new FormData(formSupplier);
    for (const [nombre, valor] of dataSupllier.entries()) {
        formProductsList.append(nombre, valor);
      }
    //    const values = Object.fromEntries(formProductsList.entries());

      if(formProductsList.get('date') == '' || formProductsList.get('numberInvoice') == '' || formProductsList.get('supplier_id') < 1 || formProductsList.get('location') < 1){
        return messages('error', 'Verifique Proveedor, numero de factura, ubicación y fecha', true)
      }

      if(itemsTotal < 1 || formProductsList.get('totalItems') < 1){
        return messages('error', 'Ingrese productos de factura', true)
      }

      //enviar a servidor factura
      sendInvoice(formProductsList);
}

async function sendInvoice(data){//recibo formData
    try{
        const response = await fetch('/admin/shopping-invoices', {
            method: 'Post',
            body: data,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        });
        if (!response.ok) {
            messages('error', 'Ocurio un error interno contacte al administrador del sistema', true)
            throw new Error(`HTTP error! status: ${response.status}`);
          }

          const res = await response.json();

        if(res.status == 200){
            //Livewire.emit('lineAdded')
            messages('success', res.msg, false, 1500);
            url =`../printShoppingInvoice/${res.invoice}`;
            // window.location.replace(`printShoppingInvoice/${res.invoice}`);
            var win = window.open(url, '_blank');
            //win.focus();
            //productsTable.ajax.reload(null, false);
            //recargarTablas(table);
        }else{
            messages('error', res.msg, true);
        }
        //reset a formulario encabezados
        document.querySelector('#formSupplier').reset();
        $('#selectSupplier').val(null).trigger('change');
        //elimino listado de productos
        const listProducts = document.getElementById('rowForm');
        while (listProducts.firstChild) {
            listProducts.removeChild(listProducts.firstChild);
          }

          itemsTotal = 0;
          itemsView = 0;
          totalInvoice = 0;
          inputTotalInvoice.value = new Intl.NumberFormat("es-CO", { style: "currency", currency: "COP",}).format(totalInvoice);
        // for(let i=0; i<itemsView){

        // }
    }catch(error){
        console.error(error);
        return messages('error', 'Ocurio un error inesperado contacte al administrador del sistema', true)
    }
}

selectProducts.addEventListener('change', (eventy) => {
});
