let inputCode = document.querySelector('#inputCode');
let inputStock = document.querySelector('#existenciaFrom');
let inputQuantity = document.querySelector('#quantity');
let selectFrom = document.querySelector('#selectFrom');
let selectTo = document.querySelector('#selectTo');
let labelProduct = document.querySelector('#nameProduct');
// let formProduct = document.querySelector('form-products');

function addInput(){
    let new_inputs = document.getElementById('tbody');
    let new_inputsform = document.getElementById('form-products')
    let newrow = document.createElement('tr');
    //newrow.className = "row";
    let newcell = document.createElement('td');
    let input = document.createElement('input');
    input.type = "hidden";
    input.name = "newCode[]";
    input.value = inputCode.value;
    let label = document.createElement('label');
    label.className = "form-control";
    label.textContent = `${labelProduct.textContent} `;
    new_inputsform.appendChild(input);
    newcell.appendChild(label);
    newrow.appendChild(newcell);
    input = document.createElement('input');
    input.type = "hidden";
    input.name = "newQuantity[]";
    input.value = inputQuantity.value;
    label = document.createElement('label');
    label.textContent = `${inputQuantity.value}`;
    label.className = "form-control";
    newcell = document.createElement('td');
    new_inputsform.appendChild(input);
    newcell.appendChild(label);
    newrow.appendChild(newcell);
    input = document.createElement('input');
    input.type = "hidden";
    input.name = "newFrom[]";
    input.value = selectFrom.value;
    label = document.createElement('label');
    label.className = "form-control";
    label.textContent = `${selectFrom.options[selectFrom.selectedIndex].text}`;
    newcell = document.createElement('td');
    new_inputsform.appendChild(input);
    newcell.appendChild(label);
    newrow.appendChild(newcell);
    input = document.createElement('input');
    input.type = "hidden";
    input.name = "newTo[]";
    input.value = selectTo.value;
    label = document.createElement('label');
    label.textContent = `${selectTo.options[selectTo.selectedIndex].text}`;
    label.className = "form-control";
    newcell = document.createElement('td');
    new_inputsform.appendChild(input);
    newcell.appendChild(label);
    newrow.appendChild(newcell);
    new_inputs.appendChild(newrow);
    Livewire.emit('resetForm')
}

function generarTraslado(e){
    // e.preventDefault();
    let formTransfer = document.querySelector('#form-products');
    let dataTransfer = new FormData(formTransfer);
    const valores = Object.fromEntries(dataTransfer.entries());
    console.log(valores);
}

$(document).ready(function () {
    $("#selectProducts").select2({
        placeholder: 'Seleccione un producto',
        allowClear: true,
    });
});
