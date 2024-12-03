<template>
    <div class="container">
      <h1>Relatório de Agendamentos por Dia</h1>
      <canvas id="myChart"></canvas>
    </div>
  </template>
  
  <script>
  import { defineComponent, watch, onMounted } from 'vue';
  import Chart from 'chart.js/auto';
  
  export default defineComponent({
    props: {
      dados: Array,  // A propriedade que recebe os dados do Blade
    },
    mounted() {
      this.createChart();
    },
    methods: {
      createChart() {
        const ctx = document.getElementById('myChart').getContext('2d');
        new Chart(ctx, {
          type: 'line',  // Tipo de gráfico
          data: {
            labels: this.dados.map(item => item.dia),  // Eixo X: datas
            datasets: [
              {
                label: 'Total de Agendamentos',
                data: this.dados.map(item => item.total),  // Eixo Y: número de agendamentos
                borderColor: 'rgb(75, 192, 192)',
                fill: false,
              },
            ],
          },
          options: {
            responsive: true,
            scales: {
              x: {
                title: {
                  display: true,
                  text: 'Data',
                },
              },
              y: {
                title: {
                  display: true,
                  text: 'Número de Agendamentos',
                },
              },
            },
          },
        });
      },
    },
  });
  </script>
  