const TabelaINSS = require('../database/inss.json')
const PDFExtract = require('pdf.js-extract').PDFExtract;
const pdfExtract = new PDFExtract();
const options = {};

const rgxData = /^(0?[1-9]|1[0-2])\/\d{4}$/
const rgxValor = /^\d+(?:\,\d{1,2})$/
const rgxCNPJ = /(^\d{2}\.\d{3}\.\d{3}$)|(^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$)/ // cnpj básico + cnpj completo
const rgxTipoFiliado = /Empregado|Contribuinte Individual/

// Funções a serem utilziadas no array reduce
const soma = (accumulator, currentValue) => accumulator + currentValue.remuneracao;
const somaCausa = (accumulator, currentValue) => accumulator + Number(currentValue.valor_a_restituir);

let txtData, txtValor, txtCNPJ, txtRazaoSocial, txtTipoFiliado, aliqINSS

let contribuicoes = []


function PesquisaTabela(competencia, valor) {
  // Inicializa a função com array vazio
  const tetosSplitCompetencia = []
  const competenciaSplit = competencia.split('/')
  let tabela = {}
  let faixas = []
  let faixa = []

  // faz o mapeamento do array original e retorna a data separada por mês e ano em um novo array de alementos
  TabelaINSS.map(item => {
    const competenciaSplit = item.competencia.split('/')
    tetosSplitCompetencia.push({ mes: competenciaSplit[0], ano: competenciaSplit[1], valor_teto: item.valor_teto_maximo, faixas: item.faixas })
  })

  // Faz a busca dentro do proprio ano
  tabela = tetosSplitCompetencia.find(item => item.ano <= competenciaSplit[1] && item.mes <= competenciaSplit[0])


  // caso tenha tido sucesso na busca
  if (!tabela)
    tabela = tetosSplitCompetencia.find(item => item.ano < competenciaSplit[1])

  faixas = tabela.faixas
  faixa = faixas.find(i => i.ate_valor >= valor)

  if (!faixa)
    faixa = faixas[faixas.length - 1]

  return { ate_valor: faixa.ate_valor, aliq: faixa.aliq, valor_teto: tabela.valor_teto }


}

function formatDecimal(valor, tipo) {
  if (tipo === 'br') {
    return valor.replace('.', '')
  } else {
    let newValor = valor.replace('.', '')
    return newValor.replace(',', '.')
  }
}

module.exports = {
  processaArquivo(req, res) {

    const arquivo = req.file

    pdfExtract.extract(arquivo.path, options).then(data => {
      contribuicoes = []

      // Identifica a quantidade de páginas e inicia a varredura página a página
      for (const pagina in data.pages) {

        // Identifica o conteudo de cada página, célula a célula do pdf extraído
        for (let i = 0; i < data.pages[pagina].content.length - 1; i++) {

          // Dados do empregador/vinculo
          if (rgxCNPJ.exec(data.pages[pagina].content[i].str) !== null) {
            txtCNPJ = data.pages[pagina].content[i].str
            txtRazaoSocial = data.pages[pagina].content[i + 1].str
            txtTipoFiliado = data.pages[pagina].content[i + 2].str
          }

          if (rgxTipoFiliado.exec(data.pages[pagina].content[i].str) !== null) {
            txtTipoFiliado = data.pages[pagina].content[i].str
          }

          txtData = data.pages[pagina].content[i].str

          if (rgxData.exec(txtData) !== null)
            txtValor = formatDecimal(data.pages[pagina].content[i + 1].str, 'br')
          if (rgxValor.exec(txtValor) !== null) {

            // Se o contribuinte for empregado então consultaremos a tabela do INSS
            if (txtTipoFiliado === 'Empregado')
              aliqINSS = PesquisaTabela(txtData, Number(formatDecimal(txtValor)))
            else
              aliqINSS.aliq = 20 // 20% COntribuinte individual

            contribuicoes.push({
              competencia: txtData,
              remuneracao: Number(formatDecimal(txtValor)),
              aliq: aliqINSS.aliq,
              valor_contribuicao: ((Number(formatDecimal(txtValor)) * aliqINSS.aliq) / 100).toFixed(2),
              cnpj: txtCNPJ,
              razao_social: txtRazaoSocial,
              tipo_filiado: txtTipoFiliado
            })
            txtData = null
            txtValor = null

          }
        }
      }

      let resposta = []
      let contribuicoesAcimadoTeto = []

      contribuicoes.map((item) => {

        let indexOfCompetencia = resposta.findIndex(i => i.competencia === item.competencia)


        if (indexOfCompetencia === -1) {
          let detalhes = contribuicoes.filter((i) => i.competencia == item.competencia);
          let total = detalhes.reduce(soma, 0)
          let tetoInss = PesquisaTabela(item.competencia, total)

          resposta.push({ competencia: item.competencia, detalhes, total: total.toFixed(2) })

          // Retorna a maior alíquota encontrada entre duas ou mais contribuições para cálculo da devolução
          let maiorAliquota
          let aliquotas = []
          detalhes.map(i => aliquotas.push(Number(i.aliq)))
          maiorAliquota = Math.max(...aliquotas)

          if (total > tetoInss.valor_teto) contribuicoesAcimadoTeto.push({
            competencia: item.competencia,
            detalhes,
            total: total.toFixed(2),
            teto_inss: tetoInss.valor_teto,
            remuneracao_acima_teto: (total - tetoInss.valor_teto).toFixed(2),
            aliq: maiorAliquota,
            valor_a_restituir: (((total - tetoInss.valor_teto) * maiorAliquota) / 100).toFixed(2)
          })
        }
      })

      const saldo_a_restituir = contribuicoesAcimadoTeto.reduce(somaCausa, 0)

      return res.render('relatorio_inss', { layout: false, contribuicoesAcimadoTeto: contribuicoesAcimadoTeto, saldo_a_restituir: saldo_a_restituir.toFixed(2) })
    })



  }

}


