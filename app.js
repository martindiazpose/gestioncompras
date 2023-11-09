const express = require('express');
const bodyParser = require('body-parser');
const session = require('express-session');
const mariadb = require('mariadb');

const app = express();

app.use(bodyParser.urlencoded({ extended: true }));
app.use(session({
    secret: 'secret-key',
    resave: true,
    saveUninitialized: true
}));

const pool = mariadb.createPool({
    host: 'localhost', // Cambia esto a 'localhost'
    user: 'root',
    password: 'Facil.2022',
    database: 'usuariosgc'
});
app.use('/pages', express.static(__dirname + '/pages'));

app.get('/', (req, res) => {
    res.sendFile(__dirname + '/index.html');
});

app.post('/login', async (req, res) => {
    const username = req.body.username; // Asegúrate de que estás obteniendo el valor del campo "username" del formulario
    const password = req.body.password;

    try {
        const conn = await pool.getConnection();
        const result = await conn.query('SELECT * FROM usuarios WHERE nombre_usuario = ? AND contrasena = ?', [username, password]);

        if (result.length > 0) {
            // Autenticación exitosa
            req.session.usuarioAutenticado = true;
            res.redirect('/pages/crear_solicitud.html');
        } else {
            // Autenticación fallida
            res.redirect('/');
        }

        conn.release();
    } catch (error) {
        console.error('Error during login:', error);
        res.redirect('/');
    }
});

app.get('/perfil', (req, res) => {
    if (req.session.usuarioAutenticado) {
        res.sendFile(__dirname + '/perfil.html');
    } else {
        res.redirect('/');
    }
});

app.listen(3001, () => {
    console.log('Servidor iniciado en http://localhost:3001');
});
