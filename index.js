const path = require('path')
const XLSX = require('xlsx');

const filename = path.resolve(__dirname, 'upload', 'historico-de-vendas-2020-11-01-2020-11-30.xls');


function Somar() {
    var soma = 0;

    for (var i = arguments.length - 1; i >= 0; i--) {
        soma += Number(arguments[i]);
    }

    return soma;
}

let arrVendas = [];

async function readExcelFile() {

    /* data is a node Buffer that can be passed to XLSX.read */
    let workbook = XLSX.readFile(filename);
    /* convert from workbook to array of arrays */
    let first_worksheet = workbook.Sheets[workbook.SheetNames[0]];
    let data = XLSX.utils.sheet_to_json(first_worksheet, { header: 1 });


    let valorBruto;
    let valorLiquido;
    let valorBrutoVendaSanitized;
    let valorLiquidoVendaSanitized;
    let valorDesps;
    let valorDespsSanitized;

    //console.log(data[0])  Cabeçalho
    //console.log(data[1])  Título Extrato
    //console.log(data[2])  Período
    //console.log(data[4])  Colunas
    //console.log(data[5])  conteúdo da primeira linha
    //console.log(data)

    //Começa a realizar a leitura do arquivo a partir da linha 5
    for (let index = 5; index < data.length; index++) {

        // Captura os valores da forma que vem do arquivo
        //valorBruto = data[index][2]
        dataVenda = data[index][0]
        valorBruto = data[index][6]
        valorLiquido = data[index][10]
        valorDesps = data[index][8]

        //Captura apenas a data sem o horário
        dataVenda = dataVenda.substr(0, 10)

        // Converte os arquivos em formato de numeração decimal
        valorBrutoVendaSanitized = valorBruto.replace('R$ ', '')
        valorBrutoVendaSanitized = valorBrutoVendaSanitized.trim()
        valorBrutoVendaSanitized = valorBrutoVendaSanitized.replace(' ', '')
        valorBrutoVendaSanitized = valorBrutoVendaSanitized.replace(',', '.')
        valorBrutoVendaSanitized = (Number(valorBrutoVendaSanitized)).toFixed(2)

        valorLiquidoVendaSanitized = valorLiquido.replace('R$ ', '')
        valorLiquidoVendaSanitized = valorLiquidoVendaSanitized.trim()
        valorLiquidoVendaSanitized = valorLiquidoVendaSanitized.replace(' ', '')
        valorLiquidoVendaSanitized = valorLiquidoVendaSanitized.replace(',', '.')
        valorLiquidoVendaSanitized = (Number(valorLiquidoVendaSanitized)).toFixed(2)

        valorDespsSanitized = valorDesps.replace('-R$ ', '')
        valorDespsSanitized = valorDespsSanitized.trim()
        valorDespsSanitized = valorDespsSanitized.replace(',', '.')
        valorDespsSanitized = (Number(valorDespsSanitized)).toFixed(2)

        var i = arrVendas.indexOf(arrVendas.filter((item) => item.data_venda == dataVenda)[0], 0);

        if (i > -1) {

            //Altera o array atual
            arrVendas[i] = {
                'data_venda': dataVenda,
                'venda_bruta': (Somar(valorBrutoVendaSanitized, arrVendas[i].venda_bruta).toFixed(2)),
                'despesas': (Somar(valorDespsSanitized, arrVendas[i].despesas).toFixed(2)),
                'venda_liquida': (Somar(valorLiquidoVendaSanitized, arrVendas[i].venda_liquida).toFixed(2))
            }

        } else {
            //cria um novo item no array
            arrVendas.unshift({
                'data_venda': dataVenda,
                'venda_bruta': (Number(valorBrutoVendaSanitized)).toFixed(2),
                'despesas': (Number(valorDespsSanitized)).toFixed(2),
                'venda_liquida': (Number(valorLiquidoVendaSanitized)).toFixed(2)
            })
        }

    }

}

readExcelFile();

let valorTotalBruto = arrVendas.reduce(function (acumulador, valorAtual) {
    return Number(acumulador) + Number(valorAtual)
})
console.log(arrVendas)
console.log(valorTotalBruto)