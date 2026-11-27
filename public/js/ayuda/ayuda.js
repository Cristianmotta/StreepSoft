// Módulo de ayuda: muestra la guía de la pantalla en la que está el usuario.
// Para agregar la guía de otro módulo basta con añadir un objeto a GUIAS.

const GUIAS = [
    {
        // /login y la vista a la que se vuelve después de cambiar la contraseña
        ruta: /^\/(login|app\/views\/auth\/login\.php)$/,
        titulo: 'Inicio de sesión',
        resumen: 'Ingresa al sistema o recupera tu acceso',
        secciones: [
            {
                titulo: 'Iniciar sesión',
                ordenada: true,
                items: [
                    'Escribe tu correo registrado en «Correo».',
                    'Escribe tu contraseña.',
                    'Pulsa «Ingresar». Entrarás a la pantalla de Inicio.',
                ],
            },
            {
                titulo: 'Recuperar la contraseña',
                ordenada: true,
                items: [
                    'Haz clic en «¿Olvidaste tu contraseña?».',
                    'Escribe tu correo registrado y pulsa «Enviar».',
                    'Revisa tu bandeja de entrada o spam, escribe el código de 5 dígitos antes de 5 minutos y pulsa «Verificar».',
                    'Escribe la nueva contraseña, confírmala y pulsa «Actualizar».',
                ],
            },
        ],
        consejo: 'Usa una contraseña de mínimo 8 caracteres, con una mayúscula, un número y un símbolo.',
    },
    {
        ruta: /^\/dashboard$/,
        titulo: 'Inicio',
        resumen: 'Resumen general del club',
        secciones: [
            {
                titulo: 'Qué encuentras en esta pantalla',
                ordenada: false,
                items: [
                    'Total de jugadores registrados y cuántos son nuevos este mes.',
                    'Pagos del mes: el dinero recibido y su comparación con el mes anterior.',
                    'Jugadores en mora.',
                    'Ingresos mensuales: gráfica de lo recaudado en cada mes del año.',
                    'Documentos pendientes: certificado de EPS, consentimiento informado y ficha del IDRD que faltan.',
                    'Jugadores por categoría y la lista de pagos recientes.',
                ],
            },
            {
                titulo: 'Cómo moverte por el sistema',
                ordenada: false,
                items: [
                    'El botón de menú abre: Inicio, Jugadores, Pagos, Documentos y Cierre y Apertura de Año.',
                    'La campana muestra las notificaciones.',
                    'Al hacer clic en tu nombre entras a tu perfil, donde se descargan los reportes.',
                    '«Ver todos los documentos» y «Ver todos los pagos» te llevan al detalle.',
                ],
            },
        ],
        consejo: 'La sesión se cierra automáticamente después de 10 minutos sin actividad.',
    },
    {
        ruta: /^\/jugadores\/gestion$/,
        titulo: 'Jugadores',
        resumen: 'Registra, consulta y edita a los jugadores',
        secciones: [
            {
                titulo: 'Registrar un jugador',
                ordenada: true,
                items: [
                    'Pulsa «Nuevo Jugador».',
                    'Completa los pasos Datos, Academia, Uniforme, Acudiente y Pago usando «Siguiente».',
                    'En Pago escribe la matrícula, la mensualidad, la fecha, el método y el tipo de beca.',
                    'Pulsa «Guardar». El jugador aparece en el listado.',
                ],
            },
            {
                titulo: 'Buscar y gestionar',
                ordenada: false,
                items: [
                    'Usa «Buscar alumno» o los filtros de beca, estado y estado de pago.',
                    'Ordena la lista de la A a la Z o de la Z a la A.',
                    'En «Acciones» elige «Editar» para cambiar los datos o «ver perfil» para consultarlos.',
                    'Los jugadores inactivos se gestionan en el módulo Desactivar.',
                ],
            },
        ],
        consejo: 'Revisa que todos los pasos estén completos antes de pulsar «Guardar».',
    },
    {
        ruta: /^\/perfil-jugador(\/\d+)?$/,
        titulo: 'Perfil del jugador',
        resumen: 'Consulta la ficha completa del alumno',
        secciones: [
            {
                titulo: 'Qué encuentras en esta pantalla',
                ordenada: false,
                items: [
                    'Datos personales: nombres, documento, fecha de nacimiento, edad, categoría, EPS e instructor.',
                    'Datos del acudiente: nombre, tipo y número de documento y celular.',
                    'El estado de la deuda del jugador.',
                ],
            },
        ],
        consejo: 'Para cambiar un dato, entra a Jugadores y elige «Editar».',
    },
    {
        ruta: /^\/instructores\/listar$/,
        titulo: 'Instructores',
        resumen: 'Administra los entrenadores del club',
        secciones: [
            {
                titulo: 'Registrar un instructor',
                ordenada: true,
                items: [
                    'Pulsa «Nuevo Instructor».',
                    'Completa apellidos, nombres, edad, número de celular, categoría y estado.',
                    'Si quieres, sube una foto JPG o PNG y escribe una descripción.',
                    'Pulsa «Guardar».',
                ],
            },
            {
                titulo: 'Consultar y editar',
                ordenada: false,
                items: [
                    'Usa el buscador, el filtro de estado o el orden alfabético.',
                    'Elige «Editar» para actualizar sus datos o marcarlo como inactivo.',
                ],
            },
        ],
    },
    {
        ruta: /^\/jugadores\/desactivacion$/,
        titulo: 'Desactivación de jugadores',
        resumen: 'Cambia el estado de uno o varios jugadores',
        secciones: [
            {
                titulo: 'Desactivar jugadores',
                ordenada: true,
                items: [
                    'Busca o filtra por categoría, estado o meses sin pago.',
                    'Selecciona los jugadores y pulsa «Cambiar estado».',
                    'Elige «Inactivo», selecciona el motivo y, si quieres, agrega una descripción.',
                    'Revisa la lista, marca la confirmación y confirma el cambio.',
                ],
            },
            {
                titulo: 'Reactivar un jugador',
                ordenada: true,
                items: [
                    'En «Historial de cambios», pulsa «Ver detalle».',
                    'Pulsa «Reactivar» junto al jugador y confirma.',
                ],
            },
        ],
        consejo: 'Al desactivar, las deudas del jugador se archivan; al reactivarlo, se recuperan. No se borra su historial.',
    },
    {
        ruta: /^\/jugadores\/deudas$/,
        titulo: 'Pagos',
        resumen: 'Controla los cobros de cada jugador',
        secciones: [
            {
                titulo: 'Registrar un pago',
                ordenada: true,
                items: [
                    'Busca al jugador por su nombre o usa los filtros.',
                    'Pulsa «Registrar pago». Se activa cuando el estado es Pendiente o Mora.',
                    'Revisa el valor y la fecha, elige el método de pago, el concepto y el descuento si aplica.',
                    'Pulsa «Guardar» y confirma. El sistema genera la mensualidad del mes siguiente.',
                ],
            },
            {
                titulo: 'Entender la pantalla',
                ordenada: false,
                items: [
                    'Arriba ves el total de pagos, lo pendiente, la mora y el recaudo del año.',
                    'Vigente: aún no está por cobrar. Pendiente: ya se puede pagar. Mora: pasó el periodo de gracia.',
                    'En «Acciones», «Historial» muestra los pagos anteriores del jugador.',
                ],
            },
        ],
        consejo: 'El día de pago y los días de gracia se configuran en tu perfil.',
    },
    {
        ruta: /^\/jugadores\/deudas\/historial\/\d+$/,
        titulo: 'Historial de pagos',
        resumen: 'Pagos registrados de un jugador',
        secciones: [
            {
                titulo: 'Consultar',
                ordenada: false,
                items: [
                    'Cada fila muestra fecha límite, fecha de pago, matrícula, mensualidad, método, concepto y total pagado.',
                    'Usa el buscador para encontrar un pago.',
                ],
            },
            {
                titulo: 'Corregir un pago',
                ordenada: true,
                items: [
                    'Abre las acciones del pago y elige «Editar».',
                    'Corrige los valores, las fechas, el método, el descuento o el concepto.',
                    'Pulsa «Guardar».',
                ],
            },
        ],
    },
    {
        ruta: /^\/documentos$/,
        titulo: 'Documentos',
        resumen: 'Estado de los documentos de inscripción',
        secciones: [
            {
                titulo: 'Revisar los documentos',
                ordenada: true,
                items: [
                    'Mira cuántos alumnos tienen la documentación completa, pendiente o por verificar.',
                    'Busca por nombre o identificación, o filtra por categoría y estado.',
                    'Pulsa «Gestionar» en el alumno que quieras revisar.',
                ],
            },
        ],
        consejo: 'Cada jugador debe tener fotocopia de cédula, consentimiento informado, ficha del IDRD y certificado de EPS.',
    },
    {
        ruta: /^\/documentos\/gestionar\/\d+$/,
        titulo: 'Documentos del alumno',
        resumen: 'Sube y verifica cada documento',
        secciones: [
            {
                titulo: 'Subir un documento',
                ordenada: true,
                items: [
                    'Selecciona el documento en la lista.',
                    'Pulsa «Subir documento» o arrastra el archivo.',
                    'Queda como «Por verificar».',
                ],
            },
            {
                titulo: 'Revisarlo',
                ordenada: false,
                items: [
                    '«Verificar» lo aprueba; «Rechazar» pide el motivo.',
                    'Puedes abrirlo, descargarlo, reemplazarlo o quitarlo.',
                    'Una verificación se puede revertir.',
                    '«Ir al siguiente por atender» te lleva al próximo documento pendiente.',
                ],
            },
        ],
        consejo: 'Solo se permiten archivos PDF de máximo 10 MB.',
    },
    {
        ruta: /^\/perfil\/administrador$/,
        titulo: 'Perfil y reportes',
        resumen: 'Tu cuenta, los reportes y la configuración de pagos',
        secciones: [
            {
                titulo: 'Descargar un reporte',
                ordenada: true,
                items: [
                    'Ve a «Documentos y reportes».',
                    'Elige el reporte de Jugadores, Pagos o Deudas.',
                    'Selecciona PDF, Word o Excel y pulsa «Descargar».',
                ],
            },
            {
                titulo: 'Configurar los pagos',
                ordenada: true,
                items: [
                    'Elige el día de pago de cada mes.',
                    'Elige los días del periodo de gracia.',
                    'Pulsa «Guardar cambios».',
                ],
            },
            {
                titulo: 'Tu información',
                ordenada: false,
                items: [
                    '«Editar información» cambia tu nombre, teléfono y documento.',
                    '«Cambiar foto» acepta imágenes JPG o PNG.',
                ],
            },
        ],
        consejo: 'El nombre solo admite letras; el teléfono y el documento, solo números.',
    },
];

// Quita la carpeta del proyecto para comparar solo la ruta del módulo
function rutaActual() {
    const ruta = window.location.pathname.replace(/^\/streepsoft/, '').replace(/\/+$/, '');
    return ruta || '/';
}

function crear(etiqueta, clase, texto) {
    const elemento = document.createElement(etiqueta);
    if (clase) elemento.className = clase;
    if (texto) elemento.textContent = texto;
    return elemento;
}

function abrirAyuda(guia, boton) {
    if (document.querySelector('.ayuda-fondo')) return;

    const fondo = crear('div', 'ayuda-fondo');
    const tarjeta = crear('div', 'ayuda-card');
    tarjeta.setAttribute('role', 'dialog');
    tarjeta.setAttribute('aria-modal', 'true');
    tarjeta.setAttribute('aria-labelledby', 'ayuda-titulo');

    // Cabecera
    const cabecera = crear('header', 'ayuda-cabecera');
    const icono = crear('span', 'ayuda-icono', '?');
    icono.setAttribute('aria-hidden', 'true');
    const titulos = crear('div', 'ayuda-titulos');
    const titulo = crear('h2', '', 'Ayuda: ');
    titulo.id = 'ayuda-titulo';
    titulo.appendChild(crear('span', '', guia.titulo));
    titulos.append(titulo, crear('p', '', guia.resumen));
    const cerrar = crear('button', 'ayuda-cerrar', '×');
    cerrar.type = 'button';
    cerrar.setAttribute('aria-label', 'Cerrar ayuda');
    cabecera.append(icono, titulos, cerrar);

    // Contenido
    const cuerpo = crear('div', 'ayuda-cuerpo');
    guia.secciones.forEach((seccion) => {
        const lista = crear(seccion.ordenada ? 'ol' : 'ul');
        seccion.items.forEach((item) => {
            const li = crear('li');
            li.appendChild(crear('span', '', item));
            lista.appendChild(li);
        });
        cuerpo.append(crear('h3', '', seccion.titulo), lista);
    });
    if (guia.consejo) cuerpo.appendChild(crear('p', 'ayuda-consejo', guia.consejo));

    // Pie
    const pie = crear('footer', 'ayuda-pie');
    const entendido = crear('button', 'ayuda-entendido', 'Entendido');
    entendido.type = 'button';
    pie.appendChild(entendido);

    tarjeta.append(cabecera, cuerpo, pie);
    fondo.appendChild(tarjeta);
    document.body.appendChild(fondo);

    function cerrarAyuda() {
        document.removeEventListener('keydown', alPulsarTecla);
        fondo.remove();
        boton.focus();
    }

    function alPulsarTecla(evento) {
        if (evento.key === 'Escape') {
            cerrarAyuda();
            return;
        }
        // Con Tab el foco se queda dentro de la ventana
        if (evento.key === 'Tab') {
            evento.preventDefault();
            (document.activeElement === cerrar ? entendido : cerrar).focus();
        }
    }

    cerrar.addEventListener('click', cerrarAyuda);
    entendido.addEventListener('click', cerrarAyuda);
    fondo.addEventListener('click', (evento) => {
        if (evento.target === fondo) cerrarAyuda();
    });
    document.addEventListener('keydown', alPulsarTecla);
    cerrar.focus();
}

// Activa el botón "?" solo si la pantalla actual tiene guía
export function initAyuda() {
    const boton = document.getElementById('ayuda-btn');
    if (!boton) return;

    const guia = GUIAS.find((g) => g.ruta.test(rutaActual()));
    if (!guia) return;

    boton.hidden = false;
    boton.addEventListener('click', () => abrirAyuda(guia, boton));
}
