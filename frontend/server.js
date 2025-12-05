const express = require('express');
const path = require('path');
const fs = require('fs');
const app = express();
const PORT = 3000;

// Middleware para archivos estáticos
app.use(express.static(__dirname));
app.use('/pages', express.static(path.join(__dirname, 'pages')));

// RUTAS PRINCIPALES
app.get('/', (req, res) => {
    res.sendFile(path.join(__dirname, 'index.html'));
});

app.get('/alumnos', (req, res) => {
    res.sendFile(path.join(__dirname, 'pages', 'alumnos.html'));
});

app.get('/profesores', (req, res) => {
    res.sendFile(path.join(__dirname, 'pages', 'profesores.html'));
});

app.get('/examenes', (req, res) => {
    res.sendFile(path.join(__dirname, 'pages', 'examenes.html'));
});

// Middleware para manejar rutas de archivos .html directamente
app.get('/*.html', (req, res) => {
    const requestedFile = req.path.substring(1); // quita el slash inicial
    const filePath = path.join(__dirname, requestedFile);
    
    if (fs.existsSync(filePath)) {
        res.sendFile(filePath);
    } else {
        // Si no está en raíz, busca en pages/
        const pagesPath = path.join(__dirname, 'pages', requestedFile);
        if (fs.existsSync(pagesPath)) {
            res.sendFile(pagesPath);
        } else {
            res.status(404).send('Archivo no encontrado');
        }
    }
});

app.listen(PORT, () => {
    console.log(`🚀 Servidor en http://localhost:${PORT}`);
    console.log('📄 Rutas disponibles:');
    console.log('  /           → Menu principal');
    console.log('  /alumnos    → Página de alumnos');
    console.log('  /profesores → Página de profesores');
    console.log('  /examenes   → Página de exámenes');
});