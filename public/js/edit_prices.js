let precios = document.querySelectorAll('.price');
let utilidad = document.querySelectorAll('.utilidad');
let numeroDePrecios = document.querySelector('#count').value;
const rows = document.querySelector('#newRow');
const costo = document.querySelector('#costo').value;

for(let i=0; i<precios.length; i++){
    if(!precios[i].onchange){
        precios[i].addEventListener('change', (e)=>{
            changePrice(i);
        });
    }
    if(!utilidad[i].onchange){
        utilidad[i].addEventListener('change', (e)=>{
            changeUtilidad(i);
        });
    }
}


function changePrice(input){
    console.log('precio');
    let valuePrice = precios[input].value;
    console.log(valuePrice);
    utilidad[input].value = (Number(valuePrice-costo)/costo*100).toFixed(2);

}

function changeUtilidad(input){
    console.log('utilidad');
    let valueUtilidad = utilidad[input].value;
    precios[input].value = (Number(costo)+costo*valueUtilidad/100).toFixed(0);
}

function addPriceRow(){
    numeroDePrecios++;
    console.log('add');
    let fragment = document.createDocumentFragment();
    let row = document.createElement('div');
    row.setAttribute('class', 'row')
    let cellName = document.createElement('div');
    cellName.setAttribute('class', 'col-md-3');
    let inputName = document.createElement('input');
    inputName.setAttribute('class', 'form-control');
    inputName.setAttribute('type', 'text');
    inputName.setAttribute('value', `precio ${numeroDePrecios}`);
    inputName.setAttribute('name', 'name_precio[]')
    cellName.appendChild(inputName);
    row.appendChild(cellName);
    let cellUtilidad = document.createElement('div');
    cellUtilidad.setAttribute('class', 'col-md-3');
    let inputUtilidad = document.createElement('input');
    inputUtilidad.setAttribute('class', 'form-control utilidad');
    inputUtilidad.setAttribute('id', `utilidad${numeroDePrecios}`);
    inputUtilidad.setAttribute('type', 'number');
    inputUtilidad.setAttribute('step', '0.01');
    inputUtilidad.setAttribute('name', 'utilidad[]');
    inputUtilidad.setAttribute('value', '');
    cellUtilidad.appendChild(inputUtilidad);
    row.appendChild(cellUtilidad);
    let cellPrecio = document.createElement('div');
    cellPrecio.setAttribute('class', 'col-md-3');
    let inputPrecio = document.createElement('input');
    inputPrecio.setAttribute('class', 'form-control price');
    inputPrecio.setAttribute('type', 'number');
    inputPrecio.setAttribute('step', '0.01');
    inputPrecio.setAttribute('name', 'value_price[]');
    inputPrecio.setAttribute('id', `price${numeroDePrecios}`);
    inputPrecio.setAttribute('value', '');
    cellPrecio.appendChild(inputPrecio);
    //row.appendChild(cellPrecio);

    let inputId = document.createElement('input');
    inputId.setAttribute('class', 'form-control');
    inputId.setAttribute('type', 'hidden');
    inputId.setAttribute('name', 'price_id[]');
    inputId.setAttribute('value', 'newPrecio');
    cellPrecio.appendChild(inputId);
    row.appendChild(cellPrecio);

    fragment.appendChild(row);
    rows.appendChild(fragment);

    precios = document.querySelectorAll('.price');
    utilidad = document.querySelectorAll('.utilidad');
    // precios[numeroDePrecios-1].addEventListener('change', (e)=>{
    //     changePrice(numeroDePrecios-1);
    // });
    // utilidad[numeroDePrecios-1].addEventListener('change', (e)=>{
    //     changeUtilidad(numeroDePrecios-1);
    // });
    for(let i=0; i<precios.length; i++){
        if(!precios[i].onchange){
            precios[i].addEventListener('change', (e)=>{
                changePrice(i);
            });
        }
        if(!utilidad[i].onchange){
            utilidad[i].addEventListener('change', (e)=>{
                changeUtilidad(i);
            });
        }
    }
}
