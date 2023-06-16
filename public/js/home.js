let graphicDailyCash;
graficar();
let labels;
let data;
async function graficar() {
    //buscar producto y cargar formulario con datos
    let uri = `admin/dailySalesCash`;
    let response = await fetch(uri);

    if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
    }

    const sales = await response.json();

    let users = [];
    // console.log(sales);

    //  const uniqueModels = [...new Set(sales.map(venta => venta.user))];

    // let datos = models.map(currentModel => sales.filter(venta => venta.user === currentModel).user);
    //  let datos = uniqueModels.map(currentModel => sales.filter(sal => sal.user ===currentModel));
    // console.log(uniqueModels);
    // console.log(models);
    //  console.log(datos);

    for (sale of sales) {
        let userSelect = {
            name: sale.user,
            sales: sale.total,
        };
        // console.log(userSelect);
        let user = users.find(function (usuario) {
            return usuario.name === userSelect.name;
        });
        if (user) {
            user.sales = parseFloat(user.sales) + parseFloat(userSelect.sales);
        } else {
            users.push(userSelect);
        }
    }
    labels = users.map(function (objeto) {
        return objeto.name;
    });
    data = users.map(function (objeto) {
        return objeto.sales;
    });

    let ctx = document.getElementById("dailySalesCash");
    ctx.height = 100;
    graphicDailyCash = new Chart(ctx, {
        type: "bar",
        data: {
            labels: labels,//["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
            datasets: [
                {
                    label: "Monto recaudado",
                    data: data,//[12, 19, 3, 5, 2, 3],
                    borderWidth: 1,
                    backgroundColor: [
                        'rgba(54, 162, 235)',
                        // 'rgba(255, 159, 64)',
                        // 'rgba(153, 102, 255)',
                        // 'rgba(75, 192, 192)',
                        // 'rgba(255, 206, 86)',
                        // 'rgba(255, 99, 132)',
                    ],
                    maxBarThickness: 30,
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
            title: {
                display: true,
                text: 'Recaudo en efectivo del día'
            },
            plugins: {
                legend: { display: false },
                title: {display: true, text: 'Recaudo del día en efectivo'}
            }
        },
    });
}
let a = 0;
let refresh = setInterval(reloadGraph, 60000);
function reloadGraph(){
    // graphicDailyCash.clear();
    // graphicDailyCash.destroy();
    // graficar();
    actualizarData();
}

async function actualizarData(){
    let uri = `admin/dailySalesCash`;
    let response = await fetch(uri);

    if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
    }

    const sales = await response.json();

    let users = [];

    for (sale of sales) {
        let userSelect = {
            name: sale.user,
            sales: sale.total,
        };
        // console.log(userSelect);
        let user = users.find(function (usuario) {
            return usuario.name === userSelect.name;
        });
        if (user) {
            user.sales = parseFloat(user.sales) + parseFloat(userSelect.sales);
        } else {
            users.push(userSelect);
        }
    }
    labels = users.map(function (objeto) {
        return objeto.name;
    });
    data = users.map(function (objeto) {
        return objeto.sales;
    });

    graphicDailyCash.data.datasets[0].data = data;
    graphicDailyCash.update();
}

