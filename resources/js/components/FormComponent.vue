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
        <label for="medico">Selecione o Médico:</label>
        <select id="medico" v-model="formData.medico" required>
            <option value="" disabled>Selecione um médico</option>
            <option v-for="medico in medicos" :key="medico" :value="medico">
            {{ medico }}
            </option>
        </select>
        </div>
  
        <!-- Campo: Data e Hora -->
        <div class="form-group">
          <label for="dataHora">Data e Hora</label>
          <input
            type="datetime-local"
            id="dataHora"
            v-model="formData.dataHora"
            required
          />
        </div>
  
        <!-- Campo: Observações -->
        <div class="form-group">
          <label for="observacoes">Observações</label>
          <textarea
            id="observacoes"
            v-model="formData.observacoes"
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
          dataHora: this.initialData.dataHora || "",
          observacoes: this.initialData.observacoes || "",
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
      submitForm() {
        this.$emit("submit", this.formData);
      },
      // Cancelar a operação
      cancelForm() {
        this.$emit("cancel");
      },
    },
  };
  </script>  