// Configuración de la API
const API_BASE_URL = '../'; // Ajusta según tu estructura

// Estado global
let state = {
    currentTab: 'alumnos',
    editingId: null
};

// Inicialización
document.addEventListener('DOMContentLoaded', function() {
    initializeApp();
});

function initializeApp() {
    setupEventListeners();
    loadInitialData();
}

function setupEventListeners() {
    // Navegación entre pestañas
    document.querySelectorAll('.nav-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            switchTab(e.target.dataset.tab);
        });
    });

    // Formularios
    setupFormListeners();
}

function setupFormListeners() {
    // Formulario de alumno
    const alumnoForm = document.getElementById('alumnoFormData');
    if (alumnoForm) {
        alumnoForm.addEventListener('submit', handleAlumnoSubmit);
    }

    // Formulario de profesor
    const profesorForm = document.getElementById('profesorFormData');
    if (profesorForm) {
        profesorForm.addEventListener('submit', handleProfesorSubmit);
    }
}

// Navegación entre pestañas
function switchTab(tabName) {
    // Actualizar botones de navegación
    document.querySelectorAll('.nav-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    document.querySelector(`[data-tab="${tabName}"]`).classList.add('active');

    // Ocultar todos los contenidos
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.remove('active');
    });

    // Mostrar contenido seleccionado
    document.getElementById(tabName).classList.add('active');

    // Cargar datos de la pestaña si es necesario
    loadTabData(tabName);
}

// Carga inicial de datos
function loadInitialData() {
    loadAlumnos();
    loadProfesores();
    loadExamenes();
    loadPracticas();
    loadGrupos();
}

function loadTabData(tabName) {
    switch(tabName) {
        case 'alumnos':
            loadAlumnos();
            break;
        case 'profesores':
            loadProfesores();
            break;
        case 'examenes':
            loadExamenes();
            break;
        case 'practicas':
            loadPracticas();
            break;
        case 'grupos':
            loadGrupos();
            break;
    }
}

// Utilidades de API
async function apiCall(endpoint, options = {}) {
    const url = `${API_BASE_URL}${endpoint}`;
    
    const config = {
        headers: {
            'Content-Type': 'application/json',
        },
        ...options
    };

    try {
        showLoading();
        const response = await fetch(url, config);
        
        if (!response.ok) {
            throw new Error(`Error ${response.status}: ${response.statusText}`);
        }
        
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Error en API call:', error);
        showMessage(error.message, 'error');
        throw error;
    } finally {
        hideLoading();
    }
}

// Funciones para Alumnos
async function loadAlumnos() {
    try {
        const data = await apiCall('alumnos');
        renderAlumnos(data.data);
    } catch (error) {
        renderAlumnos([]);
    }
}

function renderAlumnos(alumnos) {
    const tbody = document.getElementById('alumnosList');
    
    if (!alumnos || alumnos.length === 0) {
        tbody.innerHTML = '<tr><td colspan="4" style="text-align: center;">No hay alumnos registrados</td></tr>';
        return;
    }

    tbody.innerHTML = alumnos.map(alumno => `
        <tr>
            <td>${alumno.matricula}</td>
            <td>${alumno.nombre}</td>
            <td>${alumno.nombre_grupo}</td>
            <td>
                <button class="btn btn-warning btn-sm" onclick="editAlumno(${alumno.matricula})">
                    <i class="fas fa-edit"></i> Editar
                </button>
                <button class="btn btn-danger btn-sm" onclick="deleteAlumno(${alumno.matricula})">
                    <i class="fas fa-trash"></i> Eliminar
                </button>
            </td>
        </tr>
    `).join('');
}

function showAlumnoForm() {
    document.getElementById('alumnoForm').classList.remove('hidden');
    document.getElementById('alumnoFormTitle').textContent = 'Nuevo Alumno';
    state.editingId = null;
    document.getElementById('alumnoFormData').reset();
}

function hideAlumnoForm() {
    document.getElementById('alumnoForm').classList.add('hidden');
    state.editingId = null;
}

async function handleAlumnoSubmit(e) {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    const data = {
        matricula: parseInt(formData.get('matricula')),
        nombre: formData.get('nombre'),
        nombre_grupo: formData.get('nombre_grupo')
    };

    try {
        if (state.editingId) {
            await apiCall(`alumnos/${state.editingId}`, {
                method: 'PUT',
                body: JSON.stringify(data)
            });
            showMessage('Alumno actualizado exitosamente', 'success');
        } else {
            await apiCall('alumnos', {
                method: 'POST',
                body: JSON.stringify(data)
            });
            showMessage('Alumno creado exitosamente', 'success');
        }
        
        hideAlumnoForm();
        loadAlumnos();
    } catch (error) {
        showMessage('Error al guardar alumno', 'error');
    }
}

async function editAlumno(matricula) {
    try {
        const data = await apiCall(`alumnos/${matricula}`);
        const alumno = data.data;
        
        document.getElementById('matricula').value = alumno.matricula;
        document.getElementById('nombre').value = alumno.nombre;
        document.getElementById('nombre_grupo').value = alumno.nombre_grupo;
        
        document.getElementById('alumnoFormTitle').textContent = 'Editar Alumno';
        document.getElementById('alumnoForm').classList.remove('hidden');
        state.editingId = matricula;
        
        // Hacer la matrícula de solo lectura en edición
        document.getElementById('matricula').readOnly = true;
    } catch (error) {
        showMessage('Error al cargar alumno', 'error');
    }
}

async function deleteAlumno(matricula) {
    if (!confirm('¿Estás seguro de que quieres eliminar este alumno?')) {
        return;
    }

    try {
        await apiCall(`alumnos/${matricula}`, {
            method: 'DELETE'
        });
        showMessage('Alumno eliminado exitosamente', 'success');
        loadAlumnos();
    } catch (error) {
        showMessage('Error al eliminar alumno', 'error');
    }
}

// Funciones para Profesores (similar estructura)
async function loadProfesores() {
    try {
        const data = await apiCall('profesores');
        renderProfesores(data.data);
    } catch (error) {
        renderProfesores([]);
    }
}

function renderProfesores(profesores) {
    const tbody = document.getElementById('profesoresList');
    
    if (!profesores || profesores.length === 0) {
        tbody.innerHTML = '<tr><td colspan="3" style="text-align: center;">No hay profesores registrados</td></tr>';
        return;
    }

    tbody.innerHTML = profesores.map(profesor => `
        <tr>
            <td>${profesor.dni}</td>
            <td>${profesor.nombre}</td>
            <td>
                <button class="btn btn-danger btn-sm" onclick="deleteProfesor(${profesor.dni})">
                    <i class="fas fa-trash"></i> Eliminar
                </button>
            </td>
        </tr>
    `).join('');
}

function showProfesorForm() {
    document.getElementById('profesorForm').classList.remove('hidden');
    state.editingId = null;
    document.getElementById('profesorFormData').reset();
}

function hideProfesorForm() {
    document.getElementById('profesorForm').classList.add('hidden');
}

async function handleProfesorSubmit(e) {
    e.preventDefault();
    
    const formData = new FormData(e.target);
    const data = {
        dni: parseInt(formData.get('dni')),
        nombre: formData.get('nombre')
    };

    try {
        await apiCall('profesores', {
            method: 'POST',
            body: JSON.stringify(data)
        });
        
        showMessage('Profesor creado exitosamente', 'success');
        hideProfesorForm();
        loadProfesores();
    } catch (error) {
        showMessage('Error al crear profesor', 'error');
    }
}

async function deleteProfesor(dni) {
    if (!confirm('¿Estás seguro de que quieres eliminar este profesor?')) {
        return;
    }

    try {
        await apiCall(`profesores/${dni}`, {
            method: 'DELETE'
        });
        showMessage('Profesor eliminado exitosamente', 'success');
        loadProfesores();
    } catch (error) {
        showMessage('Error al eliminar profesor', 'error');
    }
}

// Funciones para Exámenes, Prácticas y Grupos (estructura similar)
async function loadExamenes() {
    try {
        const data = await apiCall('examenes');
        renderExamenes(data.data);
    } catch (error) {
        renderExamenes([]);
    }
}

function renderExamenes(examenes) {
    const tbody = document.getElementById('examenesList');
    
    if (!examenes || examenes.length === 0) {
        tbody.innerHTML = '<tr><td colspan="4" style="text-align: center;">No hay exámenes registrados</td></tr>';
        return;
    }

    tbody.innerHTML = examenes.map(examen => `
        <tr>
            <td>${examen.num_examen}</td>
            <td>${examen.num_pregunta}</td>
            <td>${new Date(examen.fecha).toLocaleDateString()}</td>
            <td>
                <button class="btn btn-danger btn-sm" onclick="deleteExamen(${examen.num_examen})">
                    <i class="fas fa-trash"></i> Eliminar
                </button>
            </td>
        </tr>
    `).join('');
}

async function loadPracticas() {
    try {
        const data = await apiCall('practicas');
        renderPracticas(data.data);
    } catch (error) {
        renderPracticas([]);
    }
}

function renderPracticas(practicas) {
    const tbody = document.getElementById('practicasList');
    
    if (!practicas || practicas.length === 0) {
        tbody.innerHTML = '<tr><td colspan="5" style="text-align: center;">No hay prácticas registradas</td></tr>';
        return;
    }

    tbody.innerHTML = practicas.map(practica => `
        <tr>
            <td>${practica.cod_practica}</td>
            <td>${practica.titulo}</td>
            <td><span class="badge badge-warning">${practica.grado_dificultad}</span></td>
            <td>${practica.nombre_profesor || 'N/A'}</td>
            <td>
                <button class="btn btn-danger btn-sm" onclick="deletePractica(${practica.cod_practica})">
                    <i class="fas fa-trash"></i> Eliminar
                </button>
            </td>
        </tr>
    `).join('');
}

async function loadGrupos() {
    try {
        const data = await apiCall('grupos');
        renderGrupos(data.data);
    } catch (error) {
        renderGrupos([]);
    }
}

function renderGrupos(grupos) {
    const tbody = document.getElementById('gruposList');
    
    if (!grupos || grupos.length === 0) {
        tbody.innerHTML = '<tr><td colspan="3" style="text-align: center;">No hay grupos registrados</td></tr>';
        return;
    }

    tbody.innerHTML = grupos.map(grupo => `
        <tr>
            <td>${grupo.nombre_grupo}</td>
            <td>0</td> <!-- Aquí podrías cargar el conteo real de alumnos -->
            <td>
                <button class="btn btn-danger btn-sm" onclick="deleteGrupo('${grupo.nombre_grupo}')">
                    <i class="fas fa-trash"></i> Eliminar
                </button>
            </td>
        </tr>
    `).join('');
}

// Utilidades de UI
function showLoading() {
    document.getElementById('loading').classList.remove('hidden');
}

function hideLoading() {
    document.getElementById('loading').classList.add('hidden');
}

function showMessage(message, type = 'info') {
    // Crear elemento de mensaje
    const messageEl = document.createElement('div');
    messageEl.className = `message ${type}`;
    messageEl.textContent = message;
    
    // Insertar al inicio del main
    const main = document.querySelector('.main .container');
    main.insertBefore(messageEl, main.firstChild);
    
    // Auto-remover después de 5 segundos
    setTimeout(() => {
        messageEl.remove();
    }, 5000);
}

// Placeholder para funciones futuras
function showExamenForm() {
    alert('Funcionalidad en desarrollo');
}

function showPracticaForm() {
    alert('Funcionalidad en desarrollo');
}

function showGrupoForm() {
    alert('Funcionalidad en desarrollo');
}

async function deleteExamen(numExamen) {
    if (!confirm('¿Estás seguro de que quieres eliminar este examen?')) {
        return;
    }
    // Implementar eliminación
    alert('Funcionalidad en desarrollo');
}

async function deletePractica(codPractica) {
    if (!confirm('¿Estás seguro de que quieres eliminar esta práctica?')) {
        return;
    }
    // Implementar eliminación
    alert('Funcionalidad en desarrollo');
}

async function deleteGrupo(nombreGrupo) {
    if (!confirm('¿Estás seguro de que quieres eliminar este grupo?')) {
        return;
    }
    // Implementar eliminación
    alert('Funcionalidad en desarrollo');
}