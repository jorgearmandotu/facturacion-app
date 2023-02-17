let selectProducts = document.getElementById('selectProducts');
let inputQuantity = document.getElementById('inputQuantity');
let inputVlrUnit = document.getElementById('inputVlrUnitario');
let inputVlrTotal = document.getElementById('inputVlrTotal');
let formProducts = document.getElementById('formProducts');
let itemsTotal = 0;
let itemsView = 0;

let formProductsList = new FormData();

function changeVlrUnit(){
    if(inputQuantity !== '' && inputVlrTotal !== ''){
        inputVlrTotal.value = Number(inputQuantity.value)*inputVlrUnit.value;
    }
}

function addRow(quantity, vlrUnit, VlrTotal, item, productText, itemsTotal){
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
    divProduct.setAttribute('class', 'col-md-5 border border-dark p-0');
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
    inputUnit.setAttribute('value', vlrUnit);
    inputUnit.setAttribute('class', 'form-control col-md-12 inputDisabled');
    inputUnit.setAttribute('disabled', '');
    const divTotal = document.createElement('div');
    divTotal.setAttribute('class', 'col-md-2 border border-dark p-0');
    const inputTotal = document.createElement('input');
    inputTotal.setAttribute('type', 'text');
    inputTotal.setAttribute('value', VlrTotal);
    inputTotal.setAttribute('class', 'form-control col-md-12 inputDisabled');
    inputTotal.setAttribute('disabled', '');
    const divOptions = document.createElement('div');
    divOptions.setAttribute('class', 'col-md-1  ')
    const buttonPlus = document.createElement('button');
    buttonPlus.setAttribute('class', 'btn btn-danger');
    buttonPlus.setAttribute('type', 'button');
    buttonPlus.setAttribute('onclick', `rowRemove(${item})`);
    const icon = document.createElement('i');
    icon.setAttribute('class', 'far fa-trash-alt');
    buttonPlus.appendChild(icon);
    divOptions.append(buttonPlus);


    divProduct.append(inputProduct);
    divNumber.append(inputNumber);
    divCant.append(inputCant);
    divUnit.append(inputUnit);
    divTotal.append(inputTotal);
    divRow.appendChild(divNumber);
    divRow.appendChild(divProduct);
    divRow.appendChild(divCant);
    divRow.appendChild(divUnit);
    divRow.appendChild(divTotal);
    divRow.appendChild(divOptions);
    row.appendChild(divRow);

    rowForm.appendChild(row);
}

function messages(icon, title, button, timer){
    Swal.fire({
        //position: 'center',
        type: icon,
        title: title,
        showConfirmButton: button,
        timer: timer
      })

}

$(document).ready(function() {
    $('#selectSupplier').select2();
    $('#selectProducts').select2();
});

//addRow();

function clickPlus(e){
    //e.preventDefault();
    addRow();
}

function add(){
    let quantity = inputQuantity.value;
    let vlrUnit = inputVlrUnit.value;
    let VlrTotal = inputVlrTotal.value;
    let productText = selectProducts.options[selectProducts.selectedIndex].text;
    let product = selectProducts.value;
    if(quantity !== '' && vlrUnit !== '' && VlrTotal !== '' && product > 0){
        itemsTotal++;
        itemsView++;

        formProductsList.append(`totalItems`, itemsTotal);
        formProductsList.append(`totalView`, itemsView);
        formProductsList.append(`item${itemsView}`, itemsTotal);
        formProductsList.append(`product${itemsView}`, product);
        formProductsList.append(`cant${itemsView}`, quantity);
        formProductsList.append(`vlrUnit${itemsView}`, vlrUnit);

        addRow(quantity, vlrUnit, VlrTotal, itemsView, productText, itemsTotal);
        formProducts.reset();
        $('#selectProducts').val(null).trigger('change');


        const values = Object.fromEntries(formProductsList.entries());
        console.log(values);
    }
}

function rowRemove(item){
    formProductsList.delete(`item${item}`);
    formProductsList.delete(`product${item}`);
    formProductsList.delete(`cant${item}`);
    formProductsList.delete(`vlrUnit${item}`);
    itemsTotal--;
    formProductsList.append('totalItems', itemsTotal)

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

    const values = Object.fromEntries(formProductsList.entries());
        console.log(values);
}

function send(){
    let formSupplier = document.querySelector('#formSupplier');
    let dataSupllier = new FormData(formSupplier);
    for (const [nombre, valor] of dataSupllier.entries()) {
        formProductsList.append(nombre, valor);
      }
      const values = Object.fromEntries(formProductsList.entries());
      if(values.date == '' || values.numberInvoice == '' || values.supplier < 1){
        return messages('error', 'Verifique Proveedor, numero de factura y fecha', true)
      }
      console.log('despues de if');
      console.log(values);
}
