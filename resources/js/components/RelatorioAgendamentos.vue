<template>
    <!-- Estrutura do template do componente Vue -->
    <div class="container">
      <h1>Relatório de Agendamentos por Dia</h1>
      <!-- O gráfico será renderizado neste elemento canvas -->
      <canvas id="myChart"></canvas>
    </div>
  </template>
  
  <script>
    // Importação de funções do Vue e da biblioteca Chart.js
    import { defineComponent } from 'vue';
    import Chart from 'chart.js/auto';
  
    export default defineComponent({
      // Definição das propriedades recebidas pelo componente
      props: {
        dados: Array, // Propriedade "dados" que contém o array passado pelo Laravel
      },
      mounted() {
        // Quando o componente for montado, cria o gráfico
        this.createChart();
      },
      methods: {
        // Método responsável por criar o gráfico
        createChart() {
          // Obtém o contexto 2D do elemento canvas com ID "myChart"
          const ctx = document.getElementById('myChart').getContext('2d');
          
          // Instanciação do gráfico usando Chart.js
          new Chart(ctx, {
            type: 'line', // Define o tipo de gráfico como "linha"
            data: {
              // Define os rótulos do eixo X com os dias (extraídos dos dados)
              labels: this.dados.map(item => item.dia),
              datasets: [
                {
                  label: 'Total de Agendamentos', // Nome do conjunto de dados
                  data: this.dados.map(item => item.total), // Define os valores do eixo Y com os totais
                  borderColor: 'rgb(75, 192, 192)', // Cor da linha do gráfico
                  fill: false, // Define que o gráfico não será preenchido abaixo da linha
                },
              ],
            },
            options: {
              responsive: true, // Define que o gráfico será responsivo
              scales: {
                x: {
                  title: {
                    display: true, // Exibe o título no eixo X
                    text: 'Data', // Texto do título
                  },
                },
                y: {
                  title: {
                    display: true, // Exibe o título no eixo Y
                    text: 'Número de Agendamentos', // Texto do título
                  },
                },
              },
            },
          });
        },
      },
    });
  </script>
  