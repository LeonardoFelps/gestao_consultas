<template>
    <div class="consulta-form">
      <h2 v-if="isEditMode">Editar Consulta</h2>
      <h2 v-else>Adicionar Consulta</h2>
      
  
      <form @submit.prevent="submitForm">
        <!-- Campo: Nome do Paciente -->
        <div class="form-group">
          <label for="paciente">Nome do Paciente</label>
          <input
            type="text"
            id="paciente"
            v-model="formData.paciente"
            placeholder="Digite o nome do paciente"
            required
          />
        </div>
  
        <!-- Campo: Médico -->
        <div class="form-group">
        <label for="medico">Selecione o(a) Médico(a):</label>
        <select id="medico" v-model="formData.medico" required>
            <option value="" disabled>Selecione um(a) médico(a)</option>
            <option v-for="medico in medicos" :key="medico" :value="medico.nome">
              {{ medico.especializacao }} - {{ medico.nome }}
            </option>
        </select>
        </div>
  
        <!-- Campo: Data e Hora -->
        <div class="form-group">
          <label for="dataehora">Data e Hora</label>
          <input
            type="datetime-local"
            id="dataehora"
            v-model="formData.dataehora"
            required
          />
        </div>
  
        <!-- Campo: Observações -->
        <div class="form-group">
          <label for="descricao">Observações</label>
          <textarea
            id="descricao"
            v-model="formData.descricao"
            placeholder="Digite observações (opcional)"
          ></textarea>
        </div>
  
        <!-- Botões -->
        <div class="form-actions">
          <button type="submit" class="btn btn-primary">
            {{ isEditMode ? "Salvar Alterações" : "Adicionar Consulta" }}
          </button>
          <button type="button" class="btn btn-secondary" @click="cancelForm">
            Cancelar
          </button>
        </div>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      // Dados para edição (opcional)
      initialData: {
        type: Object,
        default: () => ({}),
      },
      medicos: {
        type: Array,
        required: true, // Lista de médicos para o dropdown
      },
    },
    data() {
      return {
        // Dados do formulário
        formData: {
          paciente: this.initialData.paciente || "",
          medico: this.initialData.medico || "",
          dataehora: this.initialData.dataehora || "",
          descricao: this.initialData.descricao || "",
        },
      };
    },
    computed: {
      // Determina se é modo edição
      isEditMode() {
        return !!this.initialData.id;
      },
    },
    methods: {
      // Submissão do formulário
      async submitForm() {
        try {
          const response = await fetch('/store', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(this.formData)
          });

          if (!response.ok) {
            throw new Error('Erro ao enviar o formulário.');
          }

          // Obtenha a resposta em formato JSON
          const data = await response.json();

          // Exemplo: Você pode armazenar a resposta no estado do Vue (data)
          this.responseData = data;
          
          // Acessar o retorno do servidor
          console.log('Resposta do servidor:', data);
          
          // Caso precise, pode manipular o retorno da resposta
          if (data.message === 'ok') {
            console.log('Mensagem retornada:', data.message);
            // Exibir uma mensagem de sucesso
            alert('Formulário enviado com sucesso!');
          } else{
            console.log('Mensagem retornada:', data.message);
            // Exibir uma mensagem de sucesso
            alert(data.message);
          }

        } catch (error) {
          console.error(error);
          alert('Ocorreu um erro ao enviar o formulário.');
        }
      },  


    
      // Cancelar a operação
      cancelForm() {
        this.$emit("cancel");
      },
    },
  };
  </script>  