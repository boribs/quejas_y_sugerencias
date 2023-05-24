/* https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/file */

function returnFileSize(number) {
    if (number < 1024) {
        return `${number} bytes`;
    } else if (number >= 1024 && number < 1048576) {
        return `${(number / 1024).toFixed(1)} KB`;
    } else if (number >= 1048576) {
        return `${(number / 1048576).toFixed(1)} MB`;
    }
}

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

            // if (validFileType(file)) {
            listItem.classList.add('no-marker');
            const div = document.createElement('div');
            const filename = document.createElement('p');
            filename.textContent = file.name;
            const filesize = document.createElement('p');
            filesize.textContent = `${returnFileSize(file.size)} - `;

            const a = document.createElement('a');
            a.onclick = function() {removeFile(file.name, input);}
            a.textContent = 'Eliminar';
            filesize.append(a);

            const image = document.createElement('img');
            image.src = URL.createObjectURL(file);

            div.appendChild(filename);
            div.appendChild(filesize);
            listItem.appendChild(image);
            listItem.appendChild(div);
            // } else {
            //     para.textContent = `File name ${file.name}: Not a valid file type. Update your selection.`;
            //     listItem.appendChild(para);
            // }

            list.appendChild(listItem);
        }
    }
}

document.getElementById('button-evidence-input').addEventListener('change', updateImageDisplay);
