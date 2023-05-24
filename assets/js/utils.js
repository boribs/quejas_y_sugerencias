/**
 * Elimina un objeto de los seleccionados en `input`.
 * Llama `updateImageDisplay` al terminar.
 *
 * https://stackoverflow.com/questions/3144419/how-do-i-remove-a-file-from-the-filelist
 *
 * @param {HTMLElement} input -  El input con los archivos
 * @param {string} filename - El nombre del archivo a eliminar
 */
function removeFile(filename, input) {
    const dt = new DataTransfer();

    for (let i = 0; i < input.files.length; ++i) {
        if (input.files[i].name != filename) {
            dt.items.add(input.files[i]);
        }
    }

    input.files = dt.files;
    updateImageDisplay();
}

/**
 *    Regresa un string con el tamaño de un archivo.
 *
 *    https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/file
 *
 *    @param {number} number - El tamaño
 */
function returnFileSize(number) {
    if (number < 1024) {
        return `${number} bytes`;
    } else if (number >= 1024 && number < 1048576) {
        return `${(number / 1024).toFixed(1)} KB`;
    } else if (number >= 1048576) {
        return `${(number / 1048576).toFixed(1)} MB`;
    } else {
        return 'Mucho';
    }
}

/**
 * Actualiza DOM - crea una lista de imagenes con su información.
 * Debe llamarse después de seleccionar imagenes con `button-evidence-input`.
 *
 * https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/file
 */
function updateImageDisplay() {
    const preview = document.getElementById('evidence-preview');
    const input = document.getElementById('button-evidence-input');

    while (preview.firstChild) {
        preview.removeChild(preview.firstChild);
    }

    const curFiles = input.files;

    if (curFiles.length !== 0) {
        const list = document.createElement('ul');
        preview.appendChild(list);

        for (const file of curFiles) {
            const listItem = document.createElement('li');

            listItem.classList.add('no-marker');
            const div = document.createElement('div');
            const filename = document.createElement('p');
            filename.textContent = file.name;
            const filesize = document.createElement('p');
            filesize.textContent = `${returnFileSize(file.size)} - `;

            const span = document.createElement('span');
            span.onclick = function () { removeFile(file.name, input); }
            span.textContent = 'Eliminar';
            filesize.append(span);

            const media = document.createElement(file.type.startsWith('image') ? 'img' : 'video');
            media.src = URL.createObjectURL(file);

            div.appendChild(filename);
            div.appendChild(filesize);
            listItem.appendChild(media);
            listItem.appendChild(div);

            list.appendChild(listItem);
        }
    }
}

document.getElementById('button-evidence-input').addEventListener('change', updateImageDisplay);
