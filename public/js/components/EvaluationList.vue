<template>
  <div class="evaluation-list">
    <div class="evaluation-list-header">
      <h2>{{ title }}</h2>
      <button @click="showAddForm" class="btn btn-primary">
        <i class="fas fa-plus"></i> Nouvelle évaluation
      </button>
    </div>

    <div v-if="showForm" class="evaluation-form">
      <form @submit.prevent="handleSubmit">
        <div class="form-group">
          <label>Titre</label>
          <input v-model="form.title" type="text" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Date</label>
          <input v-model="form.date" type="date" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Type</label>
          <select v-model="form.type" class="form-control" required>
            <option value="examen">Examen</option>
            <option value="devoir">Devoir</option>
            <option value="tp">TP</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <button type="button" @click="cancelForm" class="btn btn-secondary">Annuler</button>
      </form>
    </div>

    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>Titre</th>
            <th>Date</th>
            <th>Type</th>
            <th>Moyenne</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="evaluation in evaluations" :key="evaluation.id">
            <td>{{ evaluation.title }}</td>
            <td>{{ formatDate(evaluation.date) }}</td>
            <td>{{ evaluation.type }}</td>
            <td>{{ evaluation.average_grade }}</td>
            <td>
              <button class="btn btn-sm btn-info" @click="editEvaluation(evaluation)">
                <i class="fas fa-edit"></i>
              </button>
              <button class="btn btn-sm btn-danger" @click="deleteEvaluation(evaluation.id)">
                <i class="fas fa-trash"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: {
    title: {
      type: String,
      default: 'Liste des évaluations'
    }
  },
  data() {
    return {
      evaluations: [],
      showForm: false,
      form: {
        id: null,
        title: '',
        date: '',
        type: 'examen'
      }
    };
  },
  created() {
    this.fetchEvaluations();
  },
  methods: {
    async fetchEvaluations() {
      try {
        const response = await axios.get('/api/evaluations');
        this.evaluations = response.data;
      } catch (error) {
        console.error('Error fetching evaluations:', error);
      }
    },
    showAddForm() {
      this.form = {
        id: null,
        title: '',
        date: '',
        type: 'examen'
      };
      this.showForm = true;
    },
    cancelForm() {
      this.showForm = false;
    },
    async handleSubmit() {
      try {
        if (this.form.id) {
          await axios.put(`/api/evaluations/${this.form.id}`, this.form);
        } else {
          await axios.post('/api/evaluations', this.form);
        }
        this.showForm = false;
        this.fetchEvaluations();
      } catch (error) {
        console.error('Error saving evaluation:', error);
      }
    },
    editEvaluation(evaluation) {
      this.form = { ...evaluation };
      this.showForm = true;
    },
    async deleteEvaluation(id) {
      if (confirm('Êtes-vous sûr de vouloir supprimer cette évaluation ?')) {
        try {
          await axios.delete(`/api/evaluations/${id}`);
          this.fetchEvaluations();
        } catch (error) {
          console.error('Error deleting evaluation:', error);
        }
      }
    },
    formatDate(date) {
      const d = new Date(date);
      return d.toLocaleDateString('fr-FR');
    }
  }
};
</script>

<style scoped>
.evaluation-list {
  background: white;
  border-radius: 8px;
  padding: 1.5rem;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.evaluation-list-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1.5rem;
}

.evaluation-form {
  background: #f8f9fa;
  padding: 1.5rem;
  border-radius: 4px;
  margin-bottom: 1.5rem;
}

.form-group {
  margin-bottom: 1rem;
}

.form-control {
  width: 100%;
  padding: 0.5rem;
  border: 1px solid #ddd;
  border-radius: 4px;
}

.btn {
  padding: 0.5rem 1rem;
  border-radius: 4px;
  cursor: pointer;
}

.table {
  width: 100%;
  border-collapse: collapse;
}

.table th,
.table td {
  padding: 0.75rem;
  border-bottom: 1px solid #ddd;
}

.table th {
  background: #f8f9fa;
}

.btn-sm {
  padding: 0.25rem 0.5rem;
  font-size: 0.875rem;
}
</style>
