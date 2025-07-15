<!-- Modal Universal de Detalles -->
<div id="modalDetalles" class="modal-overlay" style="display: none;">
    <div class="modal-container">
        <div class="modal-header">
            <h3 class="modal-title" id="modalTitle">Detalles</h3>
            <button class="modal-close" onclick="cerrarModal()">&times;</button>
        </div>
        <div class="modal-body" id="modalBody">
            <!-- Contenido dinámico se carga aquí -->
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="cerrarModal()">Cerrar</button>
            <button class="btn btn-primary" id="btnEditar" onclick="editarElemento()">
                ✏️ Editar
            </button>
        </div>
    </div>
</div>

<style>
/* Estilos del Modal Universal */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    backdrop-filter: blur(3px);
    z-index: 10000;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: fadeInModal 0.3s ease;
}

.modal-container {
    background: white;
    border-radius: 15px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    max-width: 600px;
    width: 90%;
    max-height: 80vh;
    overflow: hidden;
    animation: slideInModal 0.3s ease;
}

.modal-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 1.5rem 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.modal-title {
    margin: 0;
    font-size: 1.4rem;
    font-weight: 600;
}

.modal-close {
    background: none;
    border: none;
    color: white;
    font-size: 2rem;
    line-height: 1;
    cursor: pointer;
    padding: 0;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: background 0.3s ease;
}

.modal-close:hover {
    background: rgba(255, 255, 255, 0.2);
}

.modal-body {
    padding: 2rem;
    max-height: 50vh;
    overflow-y: auto;
}

.modal-footer {
    padding: 1.5rem 2rem;
    background: #f8f9fa;
    border-top: 1px solid #e9ecef;
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
}

/* Contenido del Modal */
.detail-grid {
    display: grid;
    gap: 1.5rem;
}

.detail-section {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 10px;
    border-left: 4px solid #667eea;
}

.detail-section-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.detail-row {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 0.75rem 0;
    border-bottom: 1px solid #e9ecef;
}

.detail-row:last-child {
    border-bottom: none;
}

.detail-label {
    font-weight: 500;
    color: #666;
    flex: 1;
    min-width: 120px;
}

.detail-value {
    flex: 2;
    color: #333;
    text-align: right;
    word-wrap: break-word;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.4rem 0.8rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
}

.status-activo { background: #e8f5e8; color: #2e7d32; }
.status-inactivo { background: #f8f9fa; color: #6c757d; }
.status-suspendido { background: #ffebee; color: #c62828; }
.status-programado { background: #e3f2fd; color: #1565c0; }
.status-transito { background: #fff8e1; color: #f57c00; }
.status-entregado { background: #e8f5e8; color: #2e7d32; }
.status-retrasado { background: #ffebee; color: #c62828; }
.status-completado { background: #e8f5e8; color: #2e7d32; }
.status-en_proceso { background: #fff8e1; color: #f57c00; }
.status-urgente { background: #ffebee; color: #c62828; }
.status-mantenimiento { background: #fff3e0; color: #ef6c00; }

.detail-highlight {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    text-align: center;
    font-weight: 600;
}

.detail-calculation {
    background: #e8f5e8;
    color: #2e7d32;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    text-align: center;
    font-weight: 600;
}

.detail-text-area {
    background: #fff;
    border: 1px solid #dee2e6;
    border-radius: 5px;
    padding: 1rem;
    max-height: 150px;
    overflow-y: auto;
    font-size: 0.9rem;
    line-height: 1.5;
}

/* Responsive */
@media (max-width: 768px) {
    .modal-container {
        width: 95%;
        max-height: 90vh;
    }
    
    .modal-header {
        padding: 1rem 1.5rem;
    }
    
    .modal-body {
        padding: 1.5rem;
    }
    
    .modal-footer {
        padding: 1rem 1.5rem;
        flex-direction: column;
    }
    
    .detail-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
    
    .detail-value {
        text-align: left;
    }
}

/* Animaciones */
@keyframes fadeInModal {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideInModal {
    from { 
        opacity: 0;
        transform: translateY(-50px) scale(0.95);
    }
    to { 
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

@keyframes slideOutModal {
    from { 
        opacity: 1;
        transform: translateY(0) scale(1);
    }
    to { 
        opacity: 0;
        transform: translateY(-50px) scale(0.95);
    }
}

.modal-closing {
    animation: slideOutModal 0.3s ease;
}

.modal-closing .modal-overlay {
    animation: fadeOutModal 0.3s ease;
}

@keyframes fadeOutModal {
    from { opacity: 1; }
    to { opacity: 0; }
}

/* Loading state */
.modal-loading {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 3rem;
    color: #666;
}

.loading-spinner {
    border: 3px solid #f3f4f6;
    border-top: 3px solid #667eea;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    animation: spin 1s linear infinite;
    margin-right: 1rem;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

<script>
// Variables globales para el modal
let modalData = {
    tipo: null,
    id: null,
    editUrl: null
};

/**
 * Generar contenido para Camiones
 */
function generarContenidoCamion(camion) {
    const estadoBadge = `<span class="status-badge status-${camion.estado}">${getEstadoTexto(camion.estado, 'camion')}</span>`;
    
    // Calcular antigüedad del camión
    const antiguedad = new Date().getFullYear() - (camion.anio || 0);
    let antigüedadTexto = antiguedad > 0 ? `${antiguedad} año${antiguedad > 1 ? 's' : ''}` : 'Nuevo';
    
    // Determinar color de antigüedad
    let antigüedadColor = '#28a745'; // Verde para nuevos
    if (antiguedad > 10) antigüedadColor = '#dc3545'; // Rojo para muy antiguos
    else if (antiguedad > 5) antigüedadColor = '#ffc107'; // Amarillo para antiguos
    
    return `
        <div class="detail-grid">
            <div class="detail-section">
                <div class="detail-section-title">🚛 Información del Camión</div>
                <div class="detail-row">
                    <span class="detail-label">ID del Camión:</span>
                    <span class="detail-value detail-highlight">CAM-${String(camion.id).padStart(3, '0')}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Placa:</span>
                    <span class="detail-value"><strong>${camion.placa || 'No especificada'}</strong></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Modelo:</span>
                    <span class="detail-value">${camion.modelo || 'No especificado'}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Estado:</span>
                    <span class="detail-value">${estadoBadge}</span>
                </div>
            </div>
            
            <div class="detail-section">
                <div class="detail-section-title">📊 Especificaciones Técnicas</div>
                <div class="detail-row">
                    <span class="detail-label">Año de Fabricación:</span>
                    <span class="detail-value">${camion.anio || 'No especificado'}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Antigüedad:</span>
                    <span class="detail-value" style="color: ${antigüedadColor}; font-weight: 600;">${antigüedadTexto}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Capacidad de Carga:</span>
                    <span class="detail-value detail-calculation">${camion.capacidad_carga ? Number(camion.capacidad_carga).toFixed(1) + ' toneladas' : 'No especificada'}</span>
                </div>
                ${camion.capacidad_carga ? `
                <div class="detail-row">
                    <span class="detail-label">Capacidad en Kilogramos:</span>
                    <span class="detail-value">${(Number(camion.capacidad_carga) * 1000).toLocaleString()} kg</span>
                </div>
                ` : ''}
            </div>
            
            <div class="detail-section">
                <div class="detail-section-title">📅 Información de Registro</div>
                <div class="detail-row">
                    <span class="detail-label">Fecha de Registro:</span>
                    <span class="detail-value">${formatearFecha(camion.created_at)}</span>
                </div>
                ${camion.updated_at && camion.updated_at !== camion.created_at ? `
                <div class="detail-row">
                    <span class="detail-label">Última Actualización:</span>
                    <span class="detail-value">${formatearFecha(camion.updated_at)}</span>
                </div>
                ` : ''}
                <div class="detail-row">
                    <span class="detail-label">Disponible para Viajes:</span>
                    <span class="detail-value">
                        ${camion.estado === 'activo' ? 
                            '<span style="color: #28a745; font-weight: 600;">✅ Sí</span>' : 
                            '<span style="color: #dc3545; font-weight: 600;">❌ No</span>'
                        }
                    </span>
                </div>
            </div>
            
            ${camion.estado === 'mantenimiento' ? `
            <div class="detail-section" style="border-left-color: #ffc107;">
                <div class="detail-section-title">⚠️ Estado de Mantenimiento</div>
                <div style="background: #fff3cd; color: #856404; padding: 1rem; border-radius: 5px; text-align: center;">
                    <strong>Este camión se encuentra actualmente en mantenimiento</strong><br>
                    <small>No está disponible para asignación de viajes</small>
                </div>
            </div>
            ` : ''}
            
            ${camion.estado === 'inactivo' ? `
            <div class="detail-section" style="border-left-color: #dc3545;">
                <div class="detail-section-title">🔴 Estado Inactivo</div>
                <div style="background: #f8d7da; color: #721c24; padding: 1rem; border-radius: 5px; text-align: center;">
                    <strong>Este camión está marcado como inactivo</strong><br>
                    <small>No está disponible para operaciones</small>
                </div>
            </div>
            ` : ''}
        </div>
    `;
}

/**
 * Función principal para mostrar detalles
 */
function mostrarDetalles(tipo, id, datos = null) {
    modalData.tipo = tipo;
    modalData.id = id;
    modalData.editUrl = `/${tipo}s/${id}/edit`;
    
    // Mostrar modal
    document.getElementById('modalDetalles').style.display = 'flex';
    document.body.style.overflow = 'hidden';
    
    // Cargar contenido
    if (datos) {
        renderizarContenido(tipo, datos);
    } else {
        cargarDatosAsync(tipo, id);
    }
}

/**
 * Cargar datos vía AJAX si no se proporcionan
 */
async function cargarDatosAsync(tipo, id) {
    const modalBody = document.getElementById('modalBody');
    modalBody.innerHTML = '<div class="modal-loading"><div class="loading-spinner"></div>Cargando detalles...</div>';
    
    try {
        const response = await fetch(`/api/${tipo}s/${id}/detalles`);
        const data = await response.json();
        
        if (data.success) {
            renderizarContenido(tipo, data.data);
        } else {
            throw new Error(data.message || 'Error al cargar datos');
        }
    } catch (error) {
        modalBody.innerHTML = `
            <div style="text-align: center; padding: 2rem; color: #dc3545;">
                <p>❌ Error al cargar los detalles</p>
                <p style="font-size: 0.9rem; color: #666;">${error.message}</p>
            </div>
        `;
    }
}

/**
 * Renderizar contenido según el tipo de entidad
 */
function renderizarContenido(tipo, datos) {
    const modalTitle = document.getElementById('modalTitle');
    const modalBody = document.getElementById('modalBody');
    
    let contenido = '';
    let titulo = '';
    
    switch (tipo) {
        case 'viaje':
            titulo = `Viaje VJ-${String(datos.id).padStart(3, '0')}`;
            contenido = generarContenidoViaje(datos);
            break;
            
        case 'mantenimiento':
            titulo = `Mantenimiento #${datos.id}`;
            contenido = generarContenidoMantenimiento(datos);
            break;
            
        case 'chofer':
            titulo = `Conductor: ${datos.nombre}`;
            modalData.editUrl = `/choferes/${datos.id}/edit`;
            contenido = generarContenidoConductor(datos);
            break;
            
        case 'cliente':
            titulo = `Cliente: ${datos.nombre}`;
            contenido = generarContenidoCliente(datos);
            break;
            
        case 'combustible':
            titulo = `Registro de Combustible #${datos.id}`;
            contenido = generarContenidoCombustible(datos);
            break;
            
        case 'camion':
            titulo = `Camión: ${datos.placa || datos.modelo || 'CAM-' + datos.id}`;
            modalData.editUrl = `/camiones/${datos.id}/edit`;
            contenido = generarContenidoCamion(datos);
            break;
            
        default:
            titulo = 'Detalles';
            contenido = '<p>Tipo de entidad no reconocido</p>';
    }
    
    modalTitle.textContent = titulo;
    modalBody.innerHTML = contenido;
}

/**
 * Generar contenido para Viajes
 */
function generarContenidoViaje(viaje) {
    const estadoBadge = `<span class="status-badge status-${viaje.estado}">${getEstadoTexto(viaje.estado, 'viaje')}</span>`;
    
    return `
        <div class="detail-grid">
            <div class="detail-section">
                <div class="detail-section-title">🚛 Información del Viaje</div>
                <div class="detail-row">
                    <span class="detail-label">ID del Viaje:</span>
                    <span class="detail-value detail-highlight">VJ-${String(viaje.id).padStart(3, '0')}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Ruta:</span>
                    <span class="detail-value"><strong>${viaje.ruta}</strong></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Estado:</span>
                    <span class="detail-value">${estadoBadge}</span>
                </div>
            </div>
            
            <div class="detail-section">
                <div class="detail-section-title">📅 Programación</div>
                <div class="detail-row">
                    <span class="detail-label">Fecha de Salida:</span>
                    <span class="detail-value">${formatearFecha(viaje.fecha_salida)}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Fecha de Llegada:</span>
                    <span class="detail-value">${formatearFecha(viaje.fecha_llegada)}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Duración Estimada:</span>
                    <span class="detail-value detail-calculation">${calcularDuracion(viaje.fecha_salida, viaje.fecha_llegada)}</span>
                </div>
            </div>
            
            <div class="detail-section">
                <div class="detail-section-title">👥 Asignaciones</div>
                <div class="detail-row">
                    <span class="detail-label">Camión:</span>
                    <span class="detail-value">${viaje.camion ? (viaje.camion.placa || viaje.camion.modelo || `CAM-${viaje.camion.id}`) : 'No asignado'}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Conductor:</span>
                    <span class="detail-value">${viaje.chofer ? viaje.chofer.nombre : 'No asignado'}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Cliente:</span>
                    <span class="detail-value">${viaje.cliente ? viaje.cliente.nombre : 'No asignado'}</span>
                </div>
            </div>
            
            ${viaje.observaciones ? `
            <div class="detail-section">
                <div class="detail-section-title">📝 Observaciones</div>
                <div class="detail-text-area">${viaje.observaciones}</div>
            </div>
            ` : ''}
        </div>
    `;
}

/**
 * Generar contenido para Mantenimientos
 */
function generarContenidoMantenimiento(mantenimiento) {
    const estadoBadge = `<span class="status-badge status-${mantenimiento.estado}">${getEstadoTexto(mantenimiento.estado, 'mantenimiento')}</span>`;
    
    return `
        <div class="detail-grid">
            <div class="detail-section">
                <div class="detail-section-title">🔧 Información del Mantenimiento</div>
                <div class="detail-row">
                    <span class="detail-label">ID:</span>
                    <span class="detail-value detail-highlight">#${mantenimiento.id}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Tipo:</span>
                    <span class="detail-value"><strong>${mantenimiento.tipo ? mantenimiento.tipo.charAt(0).toUpperCase() + mantenimiento.tipo.slice(1) : 'No especificado'}</strong></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Estado:</span>
                    <span class="detail-value">${estadoBadge}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Camión:</span>
                    <span class="detail-value">${mantenimiento.camion ? (mantenimiento.camion.placa || mantenimiento.camion.modelo || `CAM-${mantenimiento.camion.id}`) : 'No especificado'}</span>
                </div>
            </div>
            
            <div class="detail-section">
                <div class="detail-section-title">📅 Fechas</div>
                <div class="detail-row">
                    <span class="detail-label">Fecha Programada:</span>
                    <span class="detail-value">${formatearFecha(mantenimiento.fecha)}</span>
                </div>
                ${mantenimiento.fecha_inicio ? `
                <div class="detail-row">
                    <span class="detail-label">Fecha de Inicio:</span>
                    <span class="detail-value">${formatearFecha(mantenimiento.fecha_inicio)}</span>
                </div>
                ` : ''}
                ${mantenimiento.fecha_fin ? `
                <div class="detail-row">
                    <span class="detail-label">Fecha de Finalización:</span>
                    <span class="detail-value">${formatearFecha(mantenimiento.fecha_fin)}</span>
                </div>
                ` : ''}
            </div>
            
            <div class="detail-section">
                <div class="detail-section-title">💰 Información Económica</div>
                <div class="detail-row">
                    <span class="detail-label">Costo:</span>
                    <span class="detail-value detail-calculation">${mantenimiento.costo ? '$' + Number(mantenimiento.costo).toLocaleString('es-MX', {minimumFractionDigits: 2}) : 'No especificado'}</span>
                </div>
                ${mantenimiento.proveedor ? `
                <div class="detail-row">
                    <span class="detail-label">Proveedor:</span>
                    <span class="detail-value">${mantenimiento.proveedor}</span>
                </div>
                ` : ''}
                ${mantenimiento.kilometraje ? `
                <div class="detail-row">
                    <span class="detail-label">Kilometraje:</span>
                    <span class="detail-value">${Number(mantenimiento.kilometraje).toLocaleString()} km</span>
                </div>
                ` : ''}
            </div>
            
            ${mantenimiento.descripcion ? `
            <div class="detail-section">
                <div class="detail-section-title">📝 Descripción</div>
                <div class="detail-text-area">${mantenimiento.descripcion}</div>
            </div>
            ` : ''}
            
            ${mantenimiento.observaciones ? `
            <div class="detail-section">
                <div class="detail-section-title">💬 Observaciones</div>
                <div class="detail-text-area">${mantenimiento.observaciones}</div>
            </div>
            ` : ''}
        </div>
    `;
}

/**
 * Generar contenido para Conductores
 */
function generarContenidoConductor(conductor) {
    const estadoBadge = `<span class="status-badge status-${conductor.estado || 'activo'}">${getEstadoTexto(conductor.estado || 'activo', 'conductor')}</span>`;
    
    // Verificar vencimiento de licencia
    let licenciaInfo = conductor.licencia || 'No especificada';
    if (conductor.vencimiento_licencia) {
        const vencimiento = new Date(conductor.vencimiento_licencia);
        const hoy = new Date();
        const diasParaVencer = Math.ceil((vencimiento - hoy) / (1000 * 60 * 60 * 24));
        
        if (diasParaVencer < 0) {
            licenciaInfo += ` <span style="color: #dc3545; font-weight: bold;">(Vencida hace ${Math.abs(diasParaVencer)} días)</span>`;
        } else if (diasParaVencer <= 30) {
            licenciaInfo += ` <span style="color: #ffc107; font-weight: bold;">(Vence en ${diasParaVencer} días)</span>`;
        }
    }
    
    return `
        <div class="detail-grid">
            <div class="detail-section">
                <div class="detail-section-title">👤 Información Personal</div>
                <div class="detail-row">
                    <span class="detail-label">Nombre Completo:</span>
                    <span class="detail-value"><strong>${conductor.nombre}</strong></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Teléfono:</span>
                    <span class="detail-value">${conductor.telefono || 'No especificado'}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Estado:</span>
                    <span class="detail-value">${estadoBadge}</span>
                </div>
            </div>
            
            <div class="detail-section">
                <div class="detail-section-title">🪪 Información de Licencia</div>
                <div class="detail-row">
                    <span class="detail-label">Número de Licencia:</span>
                    <span class="detail-value detail-highlight">${licenciaInfo}</span>
                </div>
                ${conductor.tipo_licencia ? `
                <div class="detail-row">
                    <span class="detail-label">Tipo de Licencia:</span>
                    <span class="detail-value">Tipo ${conductor.tipo_licencia}</span>
                </div>
                ` : ''}
                ${conductor.vencimiento_licencia ? `
                <div class="detail-row">
                    <span class="detail-label">Fecha de Vencimiento:</span>
                    <span class="detail-value">${formatearFecha(conductor.vencimiento_licencia)}</span>
                </div>
                ` : ''}
            </div>
        </div>
    `;
}

/**
 * Generar contenido para Clientes
 */
function generarContenidoCliente(cliente) {
    return `
        <div class="detail-grid">
            <div class="detail-section">
                <div class="detail-section-title">🏢 Información del Cliente</div>
                <div class="detail-row">
                    <span class="detail-label">ID:</span>
                    <span class="detail-value detail-highlight">CLI-${String(cliente.id).padStart(3, '0')}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Nombre/Razón Social:</span>
                    <span class="detail-value"><strong>${cliente.nombre}</strong></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Información de Contacto:</span>
                    <span class="detail-value">${cliente.contacto}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Fecha de Registro:</span>
                    <span class="detail-value">${formatearFecha(cliente.created_at)}</span>
                </div>
            </div>
            
            ${cliente.contrato ? `
            <div class="detail-section">
                <div class="detail-section-title">📋 Información del Contrato</div>
                <div class="detail-text-area">${cliente.contrato}</div>
            </div>
            ` : ''}
        </div>
    `;
}

/**
 * Generar contenido para Combustible
 */
function generarContenidoCombustible(combustible) {
    const precioPorLitro = combustible.costo && combustible.cantidad_litros ? 
        (combustible.costo / combustible.cantidad_litros).toFixed(2) : '0.00';
    
    return `
        <div class="detail-grid">
            <div class="detail-section">
                <div class="detail-section-title">⛽ Información del Registro</div>
                <div class="detail-row">
                    <span class="detail-label">ID del Registro:</span>
                    <span class="detail-value detail-highlight">COM-${String(combustible.id).padStart(3, '0')}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Fecha del Registro:</span>
                    <span class="detail-value">${formatearFecha(combustible.fecha)}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Viaje Asociado:</span>
                    <span class="detail-value">${combustible.viaje ? `VJ-${String(combustible.viaje.id).padStart(3, '0')} - ${combustible.viaje.ruta}` : 'No especificado'}</span>
                </div>
            </div>
            
            <div class="detail-section">
                <div class="detail-section-title">💰 Información de Consumo</div>
                <div class="detail-row">
                    <span class="detail-label">Cantidad de Combustible:</span>
                    <span class="detail-value detail-calculation">${Number(combustible.cantidad_litros).toFixed(2)} L</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Costo Total:</span>
                    <span class="detail-value detail-calculation">$${Number(combustible.costo).toLocaleString('es-MX', {minimumFractionDigits: 2})}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Precio por Litro:</span>
                    <span class="detail-value detail-highlight">$${precioPorLitro}</span>
                </div>
            </div>
        </div>
    `;
}

/**
 * Funciones auxiliares
 */
function getEstadoTexto(estado, tipo) {
    const estados = {
        viaje: {
            'programado': '📅 Programado',
            'transito': '🚛 En Tránsito',
            'entregado': '✅ Entregado',
            'retrasado': '⚠️ Retrasado',
            'espera': '⏳ En Espera'
        },
        mantenimiento: {
            'programado': '📅 Programado',
            'en_proceso': '⚙️ En Proceso',
            'completado': '✅ Completado',
            'urgente': '🚨 Urgente'
        },
        conductor: {
            'activo': '✅ Activo',
            'inactivo': '⏸️ Inactivo',
            'suspendido': '⚠️ Suspendido'
        },
        camion: {
            'activo': '✅ Activo',
            'mantenimiento': '🔧 En Mantenimiento',
            'inactivo': '🔴 Inactivo'
        }
    };
    
    return estados[tipo]?.[estado] || estado?.charAt(0).toUpperCase() + estado?.slice(1) || 'No especificado';
}

function formatearFecha(fecha) {
    if (!fecha) return 'No especificada';
    
    const date = new Date(fecha);
    return date.toLocaleDateString('es-ES', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

function calcularDuracion(fechaInicio, fechaFin) {
    if (!fechaInicio || !fechaFin) return 'No calculable';
    
    const inicio = new Date(fechaInicio);
    const fin = new Date(fechaFin);
    const diferencia = fin - inicio;
    
    const horas = Math.floor(diferencia / (1000 * 60 * 60));
    const minutos = Math.floor((diferencia % (1000 * 60 * 60)) / (1000 * 60));
    
    return `${horas}h ${minutos}m`;
}

/**
 * Funciones de control del modal
 */
function cerrarModal() {
    const modal = document.getElementById('modalDetalles');
    modal.classList.add('modal-closing');
    
    setTimeout(() => {
        modal.style.display = 'none';
        modal.classList.remove('modal-closing');
        document.body.style.overflow = 'auto';
    }, 300);
}

function editarElemento() {
    if (modalData.editUrl) {
        window.location.href = modalData.editUrl;
    }
}

// Cerrar modal con Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && document.getElementById('modalDetalles').style.display === 'flex') {
        cerrarModal();
    }
});

// Cerrar modal al hacer clic fuera
document.getElementById('modalDetalles').addEventListener('click', function(e) {
    if (e.target === this) {
        cerrarModal();
    }
});
</script>