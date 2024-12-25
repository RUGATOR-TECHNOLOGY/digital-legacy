# 💾**Plugin Digital Legacy**

¡Bienvenido al proyecto Plugin Digital Legacy! 🌐 Este plugin está diseñado para facilitar la gestión de legados digitales, permitiendo a los usuarios configurar y automatizar el manejo de sus datos digitales en caso de eventos futuros.

![Status](https://img.shields.io/badge/Estado-En%20Desarrollo-yellow?style=flat-square)
![GitHub license](https://img.shields.io/github/license/RubenGamezTorrijos/Sistemas_Inteligentes_Buscador?style=flat-square)
![GitHub version](https://img.shields.io/github/v/tag/RubenGamezTorrijos/Sistemas_Inteligentes_Buscador?label=versión&style=flat-square)
![GitHub repo size](https://img.shields.io/github/repo-size/RubenGamezTorrijos/Sistemas_Inteligentes_Buscador?style=flat-square)
![GitHub Repo stars](https://img.shields.io/github/stars/RubenGamezTorrijos/Sistemas_Inteligentes_Buscador?style=social)

![GitHub issues](https://img.shields.io/github/issues/RubenGamezTorrijos/Sistemas_Inteligentes_Buscador?style=flat-square)
![GitHub forks](https://img.shields.io/github/forks/RubenGamezTorrijos/Sistemas_Inteligentes_Buscador?style=flat-square)
![GitHub last commit](https://img.shields.io/github/last-commit/RubenGamezTorrijos/Sistemas_Inteligentes_Buscador?style=flat-square)
![GitHub Workflow Status](https://img.shields.io/github/actions/workflow/status/RubenGamezTorrijos/Sistemas_Inteligentes_Buscador/main.yml?style=flat-square)


> [!NOTE]
>  **Versión actual:** 1.0.0  
> **Plataforma:** Python v3.8.0^  
> **Compatibilidad:** Windows, macOS, Linux

> [!WARNING]
> Actualmente este proyecto ha pasado a realizarse individualmente.

---

## 📋 Indíce
- [Características](#-características)
- [Estructura](#-estructura)
- [Guía de uso](#-guía-de-uso)
- [Desarrollo](#-desarrollo)
- [Ejemplos de Consultas](#-ejemplos-de-consultas)
- [Contribuciones](#-contribuciones)
- [Próximas Mejoras](#-próximas-mejoras)
- [Créditos](#-créditos)
- [Licencia](#-licencia)

---

## 🌟 **Características**

✅ **Crawler**: Rastrear y descargar contenido de páginas web en formato JSON.  
✅ **Indexer**: Procesar contenido y construir un índice invertido eficiente.  
✅ **Retriever**: Resolver consultas utilizando operadores lógicos como `AND`, `OR`, y `NOT`.  
✅ **Diseño Modular**: Cada componente se desarrolla de forma independiente para facilitar la reutilización y mejora.  
✅ **Pruebas Unitarias**: Cada módulo incluye ejemplos de uso y pruebas básicas para garantizar su correcto funcionamiento.

---

## 📂 **Estructura**

```plaintext
buscador_web/
├── dev-tools/          # Herramientas de desarrollo
│   ├── format.sh       # Script para formatear código
│   └── lint.sh         # Script para análisis estático
├── etc/                # Archivos generados por el proyecto
│   ├── indexes/        # Índices invertidos generados por el Indexer
│   └── webpages/       # Páginas descargadas por el Crawler
├── src/                # Código fuente del proyecto
│   ├── crawler/        # Módulo Crawler
│   │   ├── __init__.py 
│   │   ├── app.py
│   │   └── crawler.py 
│   ├── indexer/        # Módulo Indexer
│   │   ├── __init__.py 
│   │   ├── app.py
│   │   └── indexer.py 
│   └── retriever/      # Módulo Retriever
│       ├── __init__.py 
│       ├── app.py
│       └── retriever.py 
├── requirements.txt    # Dependencias del proyecto
├── dev-requirements.txt # Dependencias para desarrollo
└── README.md           # Este archivo
```
---

## 🚀 **Guía de Uso**
### 1. Instalación
🔹1. Clona este repositorio:
```
git clone https://github.com/RubenGamezTorrijos/SmartSearch.git
cd buscador_web
```

🔹2. Instala las dependencias:
```
pip install -r requirements.txt
```

### 2. Ejecución de los Módulos
#### 🕷️ Crawler
Rastrea páginas web y almacena su contenido en formato JSON:
```
python -m src.crawler.app --url "https://universidadeuropea.com" --max_webs 300 --output-folder ./etc/webpages
```
**Parámetros:**

- ``url``: URL inicial para comenzar el rastreo.
- ``max_webs``: Número máximo de páginas a rastrear.
- ``output-folder``: Carpeta destino para los archivos JSON.

---

#### 📇 Indexer
Construye un índice invertido a partir de los archivos JSON generados por el Crawler:

```
python -m src.indexer.app --input-folder ./etc/webpages --output-name ./etc/indexes/inverted_index.bin
```
**Parámetros:**
- ``--input-folder``: Carpeta con los archivos JSON generados por el Crawler.
- ``--output-name``: Archivo donde se almacenará el índice invertido.

---

#### 🔍 Retriever
Resuelve consultas utilizando el índice invertido:
```
python -m src.retriever.app --index-file ./etc/indexes/inverted_index.bin --query "grado AND NOT master OR docencia"
```

**Parámetros:**
- ``--index-file``: Ruta al índice invertido generado por el Indexer.
- ``--query``: Consulta a resolver.

---

#### 🛠️ Desarrollo
**Scripts Útiles**
- Formatear Código:
```
bash dev-tools/format.sh
```
- Análisis Estático:
```
bash dev-tools/lint.sh
```
**Requisitos de Desarrollo**
Instala las dependencias adicionales para desarrollo:
```
pip install -r dev-requirements.txt
```

---

#### 🧪 Ejemplos de Consultas
| Consulta | Descripción |
|:----------|:-------------|
| ``grado AND NOT master`` | Recupera páginas con "grado" y sin "master". |
| ``docencia OR investigación``	| Recupera páginas con cualquiera de las palabras. |
| ``universidad AND europea``	| Recupera páginas que contienen ambas palabras. |

---

## 🗂️ Contribuciones
### 🤝 ¿Quieres colaborar? ¡Eres bienvenido! Sigue estos pasos:

🔹1. Haz un fork de este repositorio.

Haz clic en el botón **Fork** en la parte superior derecha de la página para crear una copia de este repositorio en tu cuenta.

Clona tu copia del repositorio a tu máquina local:
```bash
git clone https://github.com/RubenGamezTorrijos/NOMBRE_REPOSITORIO.git
cd NOMBRE_REPOSITORIO
```
🔹2. Crea un branch para tu funcionalidad:
```
git checkout -b mi-rama
```
Haz los cambios en el código o añade nuevas funcionalidades según sea necesario. Asegúrate de seguir las guías de estilo del proyecto.
🔹3. Haz un commit con tus cambios:
```
git add .
git commit -m "Descripción clara de los cambios realizados"
```
🔹4. Sube tus cambios:
```
git push origin mi-rama.
```
🔹5. Abre un pull request en este repositorio.
- Ve al repositorio original del proyecto.
- Haz clic en la pestaña Pull Requests.
- Haz clic en New Pull Request.
- Selecciona tu rama desde el repositorio forkeado y compárala con la rama principal (main o master) del repositorio original.
- Describe brevemente los cambios realizados y envía la solicitud.

> [!NOTE]:
>  Los cambios en el main o master, deberán ser aprobados por el propietario.
---

## 🤖 Próximas Mejoras
- Implementar ranking de resultados basado en relevancia (TF-IDF).
- Ampliar soporte para búsqueda en documentos PDF.
- Optimizar el tiempo de rastreo con paralelización del Crawler.

---

## ✨ Créditos
Este proyecto no sería posible sin la dedicación de sus integrantes:

- **Luca 🕷️** - Implementación del módulo Crawler
- **Sergio 📇** - Implementación del módulo Indexer
- **Rubén 🔍** - Implementación del módulo Retriever
Agradecemos también a la Universidad Europea por inspirar este proyecto académico. 🙌

---

## 📝 Licencia
Este proyecto está bajo la licencia Apache 2.0. ¡Siéntete libre de usarlo, modificarlo y compartirlo!

