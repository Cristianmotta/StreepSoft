<link rel="stylesheet" href="/streepsoft/public/css/nuevo/nuevoAlumno.css">

<div class="card-body">
            <div class="card-black">
                <div class="card-text">
                    <h1>Nuevo alumno</h1>
                    <p>Complete todos los campos para agregar un alumno</p>
                </div>

                <div class="card-icon">
                    <span class="mingcute--user-add-2-fill"></span>
                </div>  
            </div>

            <?php if (isset($_GET['error'])): ?>
                <p style="color:#e74c3c; font-weight:bold;">
                    <?php
                        $errores = [
                            'csrf' => 'Token de seguridad inválido, intenta de nuevo.',
                            'campos_vacios' => 'Faltan campos obligatorios por completar.',
                            'fecha_invalida' => 'La fecha de nacimiento no es válida.',
                            'creacion_fallida' => 'No se pudo guardar el alumno, intenta de nuevo.',
                        ];
                        echo htmlspecialchars($errores[$_GET['error']] ?? 'Ocurrió un error.');
                    ?>
                </p>
            <?php endif; ?>

            <form action="/streepsoft/jugadores/guardar" method="POST" enctype="multipart/form-data" class="card-register">

                <input type="hidden" name="_token" value="<?= htmlspecialchars($csrfToken ?? '') ?>">

                <div class="cards-fotos">
                    <div class="card-foto">
                        <input 
                        type="file" 
                        id="foto"
                        name="foto"
                        accept="image/png, image/jpeg"
                        hidden>

                        <label for="foto" class="upload-label">
                            
                            <img id="preview" class="preview-image">
                            
                            <div id="upload-content" class="upload-content">
                                <div class="icon"><span class="mdi-light--camera"></span></div>

                                <h2>Subir foto</h2>
                                <h3>del Alumno</h3>
                            </div>
                        </label>

                        <button
                            type="button"
                            id="remove-image"
                            class="remove-image">
                            <span>x</span>
                        </button>
                    </div>
                    <P>JPG, PNG - MAX: 2 MB (opcional)</P>
                </div>
                
                <div class="card-input">
                    <div class="card-encabezado">
                        <div class="iconos"><span class="basil--document-solid"></span></div>
                        <p>Datos alumno</p>
                        <div class="line"></div>
                    </div>

                    <div class="formulario">
                        <div class="grup">
                            <label>Segundo apellido</label>
                            <div class="campo">
                                <span class="icon">
                                    <span class="gridicons--user"></span>
                                </span>
                                <input type="text" name="apellido2" placeholder="Ej: Gusman">
                            </div>
                        </div>

                        <div class="grup">
                            <label>Primer Apellido</label>
                            <div class="campo">
                                <span class="icon">
                                    <span class="gridicons--user"></span>
                                </span>
                                <input type="text" name="apellido1" placeholder="Ej: Gusman" required>
                            </div>
                        </div>
                        
                        <div class="grup">
                            <label>Documento</label>
                            <div class="campo">
                                <select name="id_tipo_documento" required>
                                    <option value="">Seleccione</option>
                                    <?php foreach (($tiposDocumento ?? []) as $tipo): ?>
                                        <option value="<?= (int)$tipo['id_tipo_documento'] ?>">
                                            <?= htmlspecialchars($tipo['nombre']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="grup">
                            <label>Eps</label>
                            <div class="campo">
                                <select name="id_eps" required>
                                    <option value="">Seleccione</option>
                                    <?php foreach (($epsList ?? []) as $eps): ?>
                                        <option value="<?= (int)$eps['id_eps'] ?>">
                                            <?= htmlspecialchars($eps['nombre']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="grup">
                            <label>Primer nombre</label>
                            <div class="campo">
                                <span class="icon">
                                    <span class="gridicons--user"></span>
                                </span>
                                <input type="text" name="nombre1" placeholder="Ej: Gusman" required>
                            </div>
                        </div>

                        <div class="grup">
                            <label>Segundo nombre</label>
                            <div class="campo">
                                <span class="icon">
                                    <span class="gridicons--user"></span>
                                </span>
                                <input type="text" name="nombre2" placeholder="Ej: Gusman">
                            </div>
                        </div>

                        <div class="grup">
                            <label>Identificacion</label>
                            <div class="campo">
                                <span class="icon">
                                    <span class="gridicons--user"></span>
                                </span>
                                <input type="text" name="documento" placeholder="Ej: 000001000">
                            </div>
                        </div>

                        <div class="grup">
                            <label>Categoría</label>
                            <div class="campo">
                                <select name="id_categorias" required>
                                    <option value="">Seleccione</option>
                                    <?php foreach (($categorias ?? []) as $categoria): ?>
                                        <option value="<?= (int)$categoria['id_categorias'] ?>">
                                            <?= htmlspecialchars($categoria['nombre']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card-encabezado">
                        <div class="iconos"><span class="stash--data-date-duotone"></span></div>
                        <p>Nacimiento y academia</p>
                        <div class="line"></div>
                    </div>

                    <div class="formulario">
                        <div class="grup">
                            <label>Fecha de nacimiento</label>
                            <div class="campo">
                                <span class="icon">
                                    <span class="gridicons--user"></span>
                                </span>
                                <input type="date" name="fecha_nacimiento" required>
                            </div>
                        </div>

                        <div class="grup">
                            <label>Iniciales</label>
                            <div class="campo">
                                <span class="icon">
                                    <span class="gridicons--user"></span>
                                </span>
                                <input type="text" name="iniciales" placeholder="Ej: MTA">
                            </div>
                        </div>
                        
                        <div class="grup">
                            <label>Instructor</label>
                            <div class="campo">
                                <select name="id_instructor" required>
                                    <option value="">Seleccione</option>
                                    <?php foreach (($instructores ?? []) as $instructor): ?>
                                        <option value="<?= (int)$instructor['id_instructor'] ?>">
                                            <?= htmlspecialchars($instructor['nombres'] . ' ' . $instructor['apellidos']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="grup">
                            <label>Matricula</label>
                            <div class="campo">
                                <span class="icon">
                                    <span class="gridicons--user"></span>
                                </span>
                                <input type="number" name="matricula" placeholder="Ej: 90000">
                            </div>
                            <small style="opacity:.6;">Este campo aún no se guarda (pendiente conectar a `deudas`)</small>
                        </div>
                    </div>

                    <div class="card-encabezado">
                        <div class="iconos"><span class="lsicon--clothes-filled"></span></div>
                        <p>Uniforme</p>
                        <div class="line"></div>
                    </div>
                    <small style="opacity:.6;">Sección aún no conectada a la base de datos</small>

                    <div class="formulario">
                        <div class="grup">
                            <label>Numero de Camisa</label>
                            <div class="campo">
                                <span class="icon">
                                    <span class="ion--shirt"></span>
                                </span>
                                <input type="number" name="numero_camisa" placeholder="Ej: 10">
                            </div>
                        </div>

                        <div class="grup">
                            <label>Talla camisa</label>
                            <div class="campo">
                                <span class="icon">
                                <span class="ion--shirt"></span>
                                </span>
                                <input type="text" name="talla_camisa" placeholder="Ej: L">
                            </div>
                        </div>
                        
                        <div class="grup">
                            <label>Talla Pantalon</label>
                            <div class="campo">
                                <span class="icon">
                                    <span class="icon-park-solid--clothes-pants-short"></span>
                                </span>
                                <input type="text" name="talla_pantalon" placeholder="Ej: L">
                            </div>
                        </div>

                        <div class="grup">
                            <label>Talla media</label>
                            <div class="campo">
                                <span class="icon">
                                    <span class="ph--sock-fill"></span>
                                </span>
                                <input type="number" name="talla_media" placeholder="Ej: 35">
                            </div>
                        </div>
                    </div>

                    <div class="card-encabezado">
                        <div class="iconos"><span class="ph--users-fill"></span></div>
                        <p>Acudiente</p>
                        <div class="line"></div>
                    </div>

                    <div class="formulario">
                        <div class="grup">
                            <label>Acudiente</label>
                            <div class="campo">
                                <span class="icon">
                                    <span class="gridicons--user"></span>
                                </span>
                                <input type="text" name="acudiente" placeholder="Ej: Gusman" required>
                            </div>
                        </div>

                        <div class="grup">
                            <label>Numero Acudiente</label>
                            <div class="campo">
                                <span class="icon">
                                    <span class="gridicons--user"></span>
                                </span>
                                <input type="text" name="numero_acudiente" placeholder="Ej: +57 310000000" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-card">
                    <div class="footer-text">
                        <p>* Todos los campos son obligatorios </p>
                    </div>

                    <div class="footer-botton">
                        <div class="footer-cancelar">
                            <button type="button"
                            id="btnCancelarAlumno">
                                <p>cancelar</p>
                            </button>
                        </div>
                            
                        <div class="footer-guardar">
                            <button type="submit">
                                <p>Guardar</p>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>


   
        <script src="/streepsoft/public/js/nuevo/nuevoalumno.js"></script>
