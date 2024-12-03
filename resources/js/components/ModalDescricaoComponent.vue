<template>
    <!-- Modal -->
    <div v-if="isModalOpen" class="modal fade show" tabindex="-1" style="display: block;" aria-hidden="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Descrição da Consulta</h5>
            <button type="button" class="btn-close" @click="closeModal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>{{ activeConsulta.descricao }}</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="closeModal">Fechar</button>
            <a :href="`${routeEdit}/${activeConsulta.id}`" class="btn btn-primary">Editar</a>
            <form :action="`${routeDestroy}/${activeConsulta.id}`" method="POST" style="display: inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Excluir</button>
            </form>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
export default {
  props: {
    consultas: Array, // Lista de consultas
    routeEdit: String, // URL da rota de edição
    routeDestroy: String, // URL da rota de exclusão
  },
  data() {
    return {
      activeConsultaId: null, // Armazena o id da consulta ativa para mostrar a descrição
      isModalOpen: false, // Controla a exibição do modal
      activeConsulta: {} // Consulta ativa que será exibida no modal
    };
  },
  methods: {
    // Abre o modal e carrega a consulta
    openModal(id) {
      this.activeConsultaId = id;
      this.activeConsulta = this.consultas.find(c => c.id === id);
      this.isModalOpen = true;
    },
    // Fecha o modal
    closeModal() {
      this.isModalOpen = false;
      this.activeConsultaId = null;
      this.activeConsulta = {};
    },
    // Formata a data para exibição
    formatDate(date) {
      return new Date(date).toLocaleString('pt-BR', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
      });
    },
  },
};
</script>

<style scoped>
/* Estilos específicos para o modal */
.modal {
  display: block;
  background-color: rgba(0, 0, 0, 0.5);
}

.modal-dialog {
  max-width: 800px;
}

.modal-header .btn-close {
  background: none;
  border: none;
  font-size: 1.5rem;
}

.modal-footer .btn {
  margin-left: 10px;
}
</style>
