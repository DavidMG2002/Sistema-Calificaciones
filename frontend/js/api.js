// Configuración base de la API
const API_BASE_URL = 'http://localhost/examenes_proyecto/api.php';

// Clase para manejar todas las peticiones a la API
class API {
    
    // ========== ALUMNOS ==========
    static async getAlumnos() {
        try {
            const response = await fetch(`${API_BASE_URL}/alumnos`);
            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Error al obtener alumnos:', error);
            throw error;
        }
    }

    static async getAlumnoById(matricula) {
        try {
            const response = await fetch(`${API_BASE_URL}/alumnos/${matricula}`);
            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Error al obtener alumno:', error);
            throw error;
        }
    }

    static async createAlumno(alumnoData) {
        try {
            const response = await fetch(`${API_BASE_URL}/alumnos`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(alumnoData)
            });
            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Error al crear alumno:', error);
            throw error;
        }
    }

    static async updateAlumno(matricula, alumnoData) {
        try {
            const response = await fetch(`${API_BASE_URL}/alumnos/${matricula}`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(alumnoData)
            });
            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Error al actualizar alumno:', error);
            throw error;
        }
    }

    static async deleteAlumno(matricula) {
        try {
            const response = await fetch(`${API_BASE_URL}/alumnos/${matricula}`, {
                method: 'DELETE'
            });
            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Error al eliminar alumno:', error);
            throw error;
        }
    }

    // ========== PROFESORES ==========
    static async getProfesores() {
        try {
            const response = await fetch(`${API_BASE_URL}/profesores`);
            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Error al obtener profesores:', error);
            throw error;
        }
    }

    static async createProfesor(profesorData) {
        try {
            const response = await fetch(`${API_BASE_URL}/profesores`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(profesorData)
            });
            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Error al crear profesor:', error);
            throw error;
        }
    }

    static async updateProfesor(dni, profesorData) {
        try {
            const response = await fetch(`${API_BASE_URL}/profesores/${dni}`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(profesorData)
            });
            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Error al actualizar profesor:', error);
            throw error;
        }
    }

    static async deleteProfesor(dni) {
        try {
            const response = await fetch(`${API_BASE_URL}/profesores/${dni}`, {
                method: 'DELETE'
            });
            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Error al eliminar profesor:', error);
            throw error;
        }
    }

    // ========== EXAMENES ==========
    static async getExamenes() {
        try {
            const response = await fetch(`${API_BASE_URL}/examenes`);
            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Error al obtener exámenes:', error);
            throw error;
        }
    }

    static async createExamen(examenData) {
        try {
            const response = await fetch(`${API_BASE_URL}/examenes`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(examenData)
            });
            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Error al crear examen:', error);
            throw error;
        }
    }

    static async updateExamen(numExamen, examenData) {
        try {
            const response = await fetch(`${API_BASE_URL}/examenes/${numExamen}`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(examenData)
            });
            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Error al actualizar examen:', error);
            throw error;
        }
    }

    static async deleteExamen(numExamen) {
        try {
            const response = await fetch(`${API_BASE_URL}/examenes/${numExamen}`, {
                method: 'DELETE'
            });
            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Error al eliminar examen:', error);
            throw error;
        }
    }

    // ========== PRACTICAS ==========
    static async getPracticas() {
        try {
            const response = await fetch(`${API_BASE_URL}/practicas`);
            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Error al obtener prácticas:', error);
            throw error;
        }
    }

    static async createPractica(practicaData) {
        try {
            const response = await fetch(`${API_BASE_URL}/practicas`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(practicaData)
            });
            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Error al crear práctica:', error);
            throw error;
        }
    }

    // ========== GRUPOS ==========
    static async getGrupos() {
        try {
            const response = await fetch(`${API_BASE_URL}/grupos`);
            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Error al obtener grupos:', error);
            throw error;
        }
    }

    static async createGrupo(grupoData) {
        try {
            const response = await fetch(`${API_BASE_URL}/grupos`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(grupoData)
            });
            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Error al crear grupo:', error);
            throw error;
        }
    }
}

// Exportar para usar en otros archivos
window.API = API;