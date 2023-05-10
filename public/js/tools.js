const inputvalue = document.getElementById('inputValor');
const aPagar = document.getElementById('aPagar');
const inputAnticipo = document.getElementById('inputAnticipo');
const anticipo = document.getElementById('anticipo');

if(inputvalue && aPagar){
    inputvalue.addEventListener('input', function (e){
        const value = inputvalue.value;

      // Convertir el valor en un número y formatearlo con separadores de miles
        const formattedValue = Number(value).toLocaleString('es-CO');

         // Establecer el valor formateado como el nuevo valor del input
        //   inputvalue.value = formattedValue;
        aPagar.textContent = ` ${formattedValue}`;
    });
}

if(inputAnticipo && anticipo){
    inputAnticipo.addEventListener('input', function (e){
        const value = inputAnticipo.value;

      // Convertir el valor en un número y formatearlo con separadores de miles
        const formattedValue = Number(value).toLocaleString('es-CO');

         // Establecer el valor formateado como el nuevo valor del input
        //   inputvalue.value = formattedValue;
        anticipo.textContent = `  ${formattedValue}`;
    });
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

let btnSubmit = document.querySelector('#submit');
let btnSubmitForm = document.querySelector('#btnSubmit');

if(btnSubmit){
    btnSubmit.addEventListener('click', (e)=>{
        e.preventDefault();
        //console.log(document.formSubmit);
    });
}
if(btnSubmitForm){
    btnSubmitForm.addEventListener('click', () => {
        // let formShop = document.querySelector('#formSupplier');
        // if(formShop){
        //     formShop.submit();
        // }
        let form = document.querySelector('#formSubmit');
        form.submit();
    });
}


// window.addEventListener("keydown", (e) => {
//     if(e.key == "Enter"){
//         e.preventDefault();
//         return false;
//     }
// });
