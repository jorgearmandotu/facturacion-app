let selectProduct = document.querySelector('#selectProducts');
let inputQuantity = document.querySelector('#quantity');
let itemsTotal = 0;
let itemsView = 0;
let formProducts = new FormData();

jQuery(function (){
    $('#selectProducts').select2({
        placeholder: 'Seleccione producto',
    });
});

function add(){
    let product = selectProduct.value;
    let quantity = inputQuantity.value;
    let productText = selectProduct.options[selectProduct.selectedIndex].text;

    if(product == '' || quantity < 0 || typeof(quantity) !== 'number' || typeof(product !== 'number')){
        return
    }
    itemsTotal++;
    itemsView++;

    formProducts.append(`totalItems`, itemsTotal);
    formProducts.append(`totalView`, itemsView);
    formProducts.append(`item${itemsView}`, itemsTotal);
    formProducts.append(`product${itemsView}`, product);
    formProducts.append(`cant${itemsView}`, quantity);

    addRow(quantity, itemsView, productText, itemsTotal);
    formProducts.reset();
    $('#selectProducts').val(null).trigger('change');

}

function addRow(quantity, itemsView, productText, itemsTotal) {
    const rowForm = document.getElementById('rowForm');
    let row = document.createDocumentFragment();
    const divRow = document.createElement('div');
    divRow.setAttribute('class', 'form-row');
    divRow.setAttribute('id', `row${itemsView}`);
    const divNumber = document.createElement('div');
    divNumber.setAttribute('class', 'col-md-1 border border-dark p-0');
    const inputNumber = document.createElement('input');
    inputNumber.setAttribute('type', 'text');
    inputNumber.setAttribute('value', itemsTotal);
    inputNumber.setAttribute('id', `number${itemsView}`);
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


    const divOptions = document.createElement('div');
    divOptions.setAttribute('class', 'col-md-1  ')
    const buttonPlus = document.createElement('button');
    buttonPlus.setAttribute('class', 'btn btn-danger');
    buttonPlus.setAttribute('type', 'button');
    buttonPlus.setAttribute('onclick', `rowRemove(${itemsView})`);
    const icon = document.createElement('i');
    icon.setAttribute('class', 'far fa-trash-alt');
    buttonPlus.appendChild(icon);
    divOptions.append(buttonPlus);


    divProduct.append(inputProduct);
    divNumber.append(inputNumber);
    divCant.append(inputCant);
    divRow.appendChild(divNumber);
    divRow.appendChild(divProduct);
    divRow.appendChild(divCant);
    divRow.appendChild(divOptions);
    row.appendChild(divRow);

    rowForm.appendChild(row);

}
