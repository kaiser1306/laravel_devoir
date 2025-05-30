<template>
  <div class="student-list">
    <div class="student-list-header">
      <h2>{{ title }}</h2>
      <button @click="showAddForm" class="btn btn-primary">
        <i class="fas fa-plus"></i> Nouvel étudiant
      </button>
    </div>

    <div v-if="showForm" class="student-form">
      <form @submit.prevent="handleSubmit">
        <div class="form-group">
          <label>Nom</label>
          <input v-model="form.last_name" type="text" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Prénom</label>
          <input v-model="form.first_name" type="text" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Date de naissance</label>
          <input v-model="form.birthdate" type="date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <button type="button" @click="cancelForm" class="btn btn-secondary">Annuler</button>
      </form>
    </div>

    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>Nom complet</th>
            <th>Date de naissance</th>
            <th>Moyenne</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="student in students" :key="student.id">
            <td>{{ student.full_name }}</td>
            <td>{{ formatDate(student.birthdate) }}</td>
            <td>{{ student.average_grade }}</td>
            <td>
              <button class="btn btn-sm btn-info" @click="editStudent(student)">
                <i class="fas fa-edit"></i>
              </button>
              <button class="btn btn-sm btn-danger" @click="deleteStudent(student.id)">
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
      default: 'Liste des étudiants'
    }
  },
  data() {
    return {
      students: [],
      showForm: false,
      form: {
        id: null,
        first_name: '',
        last_name: '',
        birthdate: ''
      }
    };
  },
  created() {
    this.fetchStudents();
  },
  methods: {
    async fetchStudents() {
      try {
        const response = await axios.get('/api/students');
        this.students = response.data;
      } catch (error) {
        console.error('Error fetching students:', error);
      }
    },
    showAddForm() {
      this.form = {
        id: null,
        first_name: '',
        last_name: '',
        birthdate: ''
      };
      this.showForm = true;
    },
    cancelForm() {
      this.showForm = false;
    },
    async handleSubmit() {
      try {
        if (this.form.id) {
          await axios.put(`/api/students/${this.form.id}`, this.form);
        } else {
          await axios.post('/api/students', this.form);
        }
        this.showForm = false;
        this.fetchStudents();
      } catch (error) {
        console.error('Error saving student:', error);
      }
    },
    editStudent(student) {
      this.form = { ...student };
      this.showForm = true;
    },
    async deleteStudent(id) {
      if (confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?')) {
        try {
          await axios.delete(`/api/students/${id}`);
          this.fetchStudents();
        } catch (error) {
          console.error('Error deleting student:', error);
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
.student-list {
  background: white;
  border-radius: 8px;
  padding: 1.5rem;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.student-list-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1.5rem;
}

.student-form {
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
