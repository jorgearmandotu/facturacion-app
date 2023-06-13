let selectProduct = document.querySelector('#selectProducts');
let inputQuantity = document.querySelector('#quantity');
let inputDescription = document.querySelector('#descriptionNote');
let itemsTotal = 0;
let itemsView = 0;
let formProducts = new FormData();

jQuery(function (){
    $('#selectProducts').select2({
        placeholder: 'Seleccione producto',
        selectOnclose: true,
    });
    $('#selectProducts').on('select2:open', function() {
        // $("#selectSupplier").trigger('select2:open');
        document.querySelector('.select2-search__field').focus();
    });
});

function keyPlus(){

}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('input').forEach( node => node.addEventListener('keypress', e => {
        if(e.key == 'Enter') {
            e.preventDefault();
        }
    }))
});


function add(){
    let product = selectProduct.value;
    let quantity = inputQuantity.value;
    let productText = selectProduct.options[selectProduct.selectedIndex].text;
    if(product == '' || quantity < 0 || quantity == '' ){
        messages('error', 'Selecione producto e ingrese cantidad', 'true');
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
    $('#selectProducts').val(null).trigger('change');
    inputQuantity.value = '';
    $('#selectProducts').focus();
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

function rowRemove(item){
    formProducts.delete(`item${item}`);
    formProducts.delete(`product${item}`);
    formProducts.delete(`cant${item}`);

    itemsTotal--;
    formProducts.append('totalItems', itemsTotal)

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
    let formNote = document.querySelector('#formNote');
    let dataNote = new FormData(formNote);
    dataNote.append('description', inputDescription.value);
    for (const [nombre, valor] of dataNote.entries()) {
        formProducts.append(nombre, valor);
      }
    //    const values = Object.fromEntries(formProductsList.entries());

      if(formProducts.get('typeNote') < 1 || formProducts.get('location') < 1){
        return messages('error', 'Verifique tipo de nota y ubicación', true)
      }

      if(itemsTotal < 1 || formProducts.get('totalItems') < 1){
        return messages('error', 'Ingrese productos en la nota', true)
      }

      //enviar a servidor nota
      const values = Object.fromEntries(formProducts.entries());
      console.log(values);
      sendNote(formProducts);
}

async function sendNote(data){//recibo formData
    try{
        const response = await fetch('/admin/notes', {
            method: 'Post',
            body: data,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        });
        if (!response.ok) {
            messages('error', 'Ocurio un error interno contacte al administrador del sistema ', true)
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const res = await response.json();

        if(res.status == 200){
            //Livewire.emit('lineAdded')
            messages('success', res.msg, false, 1500);
            //url =`../printShoppingInvoice/${res.invoice}`;
            // window.location.replace(`printShoppingInvoice/${res.invoice}`);
            //var win = window.open(url, '_blank');
            //win.focus();
            //productsTable.ajax.reload(null, false);
            //recargarTablas(table);
        }else{
            messages('error', res.msg, true);
        }
        //reset a formulario encabezados
        document.querySelector('#formNote').reset();
        $('#selectProduct').val(null).trigger('change');
        inputDescription.value = '';
        //elimino listado de productos
        const listProducts = document.getElementById('rowForm');
        while (listProducts.firstChild) {
            listProducts.removeChild(listProducts.firstChild);
          }

          itemsTotal = 0;
          itemsView = 0;

    }catch(error){
        console.error(error);
        return messages('error', 'Ocurio un error inesperado contacte al administrador del sistema', true)
    }
}
