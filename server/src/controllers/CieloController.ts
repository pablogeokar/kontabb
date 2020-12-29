import { Request, Response } from 'express'
import path from 'path'
import XLSX from 'xlsx'

interface iDados {
    dataVenda: String
}

let arrVendas: [] = [];

function Somar() {
    var soma = 0;

    for (var i = arguments.length - 1; i >= 0; i--) {
        soma += Number(arguments[i]);
    }

    return soma;
}

async function processaArquivo(path: String) {
    /* data is a node Buffer that can be passed to XLSX.read */
    let workbook = XLSX.readFile(String(path));
    /* convert from workbook to array of arrays */
    let first_worksheet = workbook.Sheets[workbook.SheetNames[0]];
    let data = XLSX.utils.sheet_to_json(first_worksheet, { header: 1 });

    let dataVenda = '';
    let valorBruto = 0;
    let valorLiquido = 0;
    let valorBrutoVendaSanitized = 0;
    let valorLiquidoVendaSanitized = 0;
    let valorDesps = 0;
    let valorDespsSanitized = 0;

    for (let index: number = 5; index < data.length; index++) {

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

    return arrVendas


}

export default {

    async create(req: Request, res: Response) {
        const requestFiles = req.files as Express.Multer.File[]

        // Faz a varredura em todos os arquivos que foram enviados
        const files = requestFiles.map(file => {
            return { documento: file.filename }
        })

        // Nome e caminho do arquivo do excel a ser processado
        const filename = path.resolve(__dirname, '..', '..', 'uploads', files[0].documento);

        const dados = await processaArquivo(filename)

        return res.json({ files, dados })
    }
}