import './bootstrap';
import { createApp } from 'vue';


const app = createApp({});

// Exemplo de componente básico
import ExampleComponent from './components/ExampleComponent.vue';
app.component('example-component', ExampleComponent);

// Componente de index
import IndexComponent from './components/IndexComponent.vue';
app.component('index-component', IndexComponent);

// Componente de formulário
import FormComponent from './components/FormComponent.vue';
app.component('form-component', FormComponent);

// Componente de modal (descrição)
import ModalDescricaoComponent from './components/ModalDescricaoComponent.vue';
app.component('modal-descricao-component', ModalDescricaoComponent);

// Componente de relatório de agendamentos
import RelatorioAgendamentos from './components/RelatorioAgendamentos.vue';
app.component('relatorio-agendamentos', RelatorioAgendamentos);

app.mount('#app');
