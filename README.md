# 💾 **Rugator Digital Legacy**

¡Bienvenido al proyecto Plugin Rugator Digital Legacy! 🌐 Este plugin está diseñado para facilitar la gestión de legados digitales, permitiendo a los usuarios configurar y automatizar el manejo de sus datos digitales en caso de eventos futuros.

![Status](https://img.shields.io/badge/Estado-En%20Desarrollo-yellow?style=flat-square)
![GitHub license](https://img.shields.io/github/license/RUGATOR-TECHNOLOGY/PluginDigitalLegacy?style=flat-square)
![GitHub version](https://img.shields.io/github/v/tag/RUGATOR-TECHNOLOGY/PluginDigitalLegacy?label=versión&style=flat-square)
![GitHub repo size](https://img.shields.io/github/repo-size/RUGATOR-TECHNOLOGY/PluginDigitalLegacy?style=flat-square)
![GitHub Repo stars](https://img.shields.io/github/stars/RUGATOR-TECHNOLOGY/PluginDigitalLegacy?style=social)

![GitHub issues](https://img.shields.io/github/issues/RUGATOR-TECHNOLOGY/PluginDigitalLegacy?style=flat-square)
![GitHub forks](https://img.shields.io/github/forks/RUGATOR-TECHNOLOGY/PluginDigitalLegacy?style=flat-square)
![GitHub last commit](https://img.shields.io/github/last-commit/RUGATOR-TECHNOLOGY/PluginDigitalLegacy?style=flat-square)
![GitHub Workflow Status](https://img.shields.io/github/actions/workflow/status/RUGATOR-TECHNOLOGY/PluginDigitalLegacy/main.yml?style=flat-square)


> [!NOTE]
> **Versión actual:** 1.0.0  
> **Plataforma WordPress:** v5.8^  
> **Compatibilidad PHP:** v8.0

> [!WARNING]
> Proyecto fase desarrollo.

---

## 📋 Indíce
- [Características](#-características)
- [Estructura](#-estructura)
- [Guía de uso](#-guía-de-uso)
- [Desarrollo](#-desarrollo)
- [Ejemplos de uso](#-ejemplos-de-uso)
- [Contribuciones](#-contribuciones)
- [Próximas mejoras](#-próximas-mejoras)
- [Créditos](#-créditos)
- [Licencia](#-licencia)

---

## 🌟 **Características**

✅ **Gestión del legado digital**: Configuración personalizada para delegar acceso o eliminar datos digitales.

✅ **Automatización**: Programación de acciones basadas en fechas específicas o triggers externos.

✅ **Seguridad**: Uso de claves de acceso y cifrado para proteger datos sensibles.

✅ **Notificaciones**: Sistema de alertas configurables para mantener a los usuarios informados.

✅ **Integración**: Compatible con WordPress y fácil de extender con otros plugins.

---

## 📂 **Estructura**

```plaintext
plugin-digital-legacy/
├── assets/            # Recursos estáticos como imágenes, CSS y JS
├── includes/          # Funcionalidades principales del plugin
│   ├── admin/         # Archivos relacionados con la configuración en el panel de administración
│   ├── public/        # Funciones accesibles desde la interfaz pública
│   └── utils/         # Utilidades y helpers
├── templates/         # Plantillas para vistas del plugin
├── languages/         # Archivos de traducción
├── tests/             # Pruebas unitarias y funcionales
├── plugin-digital-legacy.php  # Archivo principal del plugin
├── readme.txt         # Descripción para el repositorio de WordPress
└── README.md          # Este archivo
```
---

## 🚀 **Guía de instalación**
### 1. Requisitos previos
- WordPress >= 5.8
- PHP >= 8.0

### 2. Instalación 🔍
🔹Descargar el repositorio o el archivo ***.ZIP** del plugin.
🔹Accede a tu escritorio de administración de WordPress:

```
Plugins > Añadir Nuevo > Subir Plugin
```
🔹Selecciona el archivo ***.ZIP** y haz clic en "Instalar Ahora".
🔹Activa el plugin desde la lista de plugins instalados.

---

## 🛠️ **Desarrollo**
### Scripts útiles
- Formatear código:

```
bash dev-tools/format.sh
```

- Ejecución de pruebas:

```
bash dev-tools/test.sh
```

### Requisitos de desarrollo
🔹Instala las dependencias de desarrollo:
```
composer install
npm install
```

## 🛠️ **Ejemplos de uso**
### 🛡️Configuración Básica
1. Accede a la página de configuración del plugin:
```
Ajustes > Digital Legacy
```
2. Configura el destino de los datos en caso de activación.
3. Guarda los cambios y prueba el sistema con datos de ejemplo.

---

## 🗂️ Contribuciones

**🤝 ¿Quieres colaborar? ¡Eres bienvenido! Sigue estos pasos:**

🔹 Haz un fork del repositorio.

🔹 Clona tu copia y crea un branch para tus cambios.

🔹 Envía tus propuestas mediante pull requests.

---

## 🔮 Próximas mejoras

- Integración con plataformas de terceros como BBpress y BuddyPress.

- Ampliar las opciones de triggers automáticos.

- Mejorar la experiencia de usuario con nuevas interfaces intuitivas.

---

## ✨ Créditos

Este proyecto está desarrollado y mantenido por:

- **Equipo Digital Legacy** - Desarrollo y soporte técnico.
- **Rubén Gámez Torrijos** - Principal desarrollador.

Agradecemos a la comunidad de WordPress por su colaboración y apoyo constante.

---

## 📝 Licencia

Este proyecto está licenciado bajo la Licencia MIT. ¡Siéntete libre de usarlo, modificarlo y compartirlo! 🚀

---

> [!NOTE]
> Los cambios en el main o master, deberán ser aprobados por el propietario.

