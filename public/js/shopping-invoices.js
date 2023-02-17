
function addRow(){
    const rowForm = document.getElementById('rowForm');
    let row = document.createDocumentFragment();
    const divRow = document.createElement('div');
    divRow.setAttribute('class', 'form-row');
    const divNumber = document.createElement('div');
    divNumber.setAttribute('class', 'col-md-1 border border-dark p-0');
    const inputNumber = document.createElement('input');
    inputNumber.setAttribute('type', 'text');
    inputNumber.setAttribute('value', '10');
    inputNumber.setAttribute('class', 'form-control col-md-12');
    const divProduct = document.createElement('div');
    divProduct.setAttribute('class', 'col-md-4 border border-dark p-0');
    const inputProduct = document.createElement('input');
    inputProduct.setAttribute('type', 'text');
    inputProduct.setAttribute('value', 'product');
    inputProduct.setAttribute('class', 'form-control col-md-12');
    const divCant = document.createElement('div');
    divCant.setAttribute('class', 'col-md-2 border border-dark p-0')
    const inputCant = document.createElement('input');
    inputCant.setAttribute('type', 'number');
    inputCant.setAttribute('value', '20');
    inputCant.setAttribute('class', 'form-control col-md-12');
    const divUnit = document.createElement('div');
    divUnit.setAttribute('class', 'col-md-2 border border-dark p-0');
    const inputUnit = document.createElement('input');
    inputUnit.setAttribute('type', 'text');
    inputUnit.setAttribute('value', '0');
    inputUnit.setAttribute('class', 'form-control col-md-12');
    const divTotal = document.createElement('div');
    divTotal.setAttribute('class', 'col-md-2 border border-dark p-0');
    const inputTotal = document.createElement('input');
    inputTotal.setAttribute('type', 'text');
    inputTotal.setAttribute('value', '20000');
    inputTotal.setAttribute('class', 'form-control col-md-12');
    const divOptions = document.createElement('div');
    divOptions.setAttribute('class', 'col-md-1 border border-dark p-0')
    const buttonPlus = document.createElement('button');
    buttonPlus.setAttribute('class', 'btn btn-success');
    buttonPlus.setAttribute('type', 'button');
    buttonPlus.setAttribute('onclick', 'clickPlus(Event)');
    const icon = document.createElement('i');
    icon.setAttribute('class', 'fas fa-solid fa-plus');
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

$(document).ready(function() {
    $('#selectSupplier').select2();
    $('#selectProducts').select2();
});

addRow();

function clickPlus(e){
    //e.preventDefault();
    addRow();
}
