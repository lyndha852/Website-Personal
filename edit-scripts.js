document.addEventListener('DOMContentLoaded', () => {
    if (!localStorage.getItem('loggedIn')) {
        window.location.href = 'login.html'; // Arahkan ke halaman login jika belum login
    }

    const form = document.getElementById('participant-form');
    const nameInput = document.getElementById('name');
    const ageInput = document.getElementById('age');
    const editIdInput = document.getElementById('edit-id');

    function getParticipants() {
        return JSON.parse(localStorage.getItem('participants')) || [];
    }

    function populateForm() {
        const urlParams = new URLSearchParams(window.location.search);
        const id = urlParams.get('id');
        if (id !== null) {
            const participants = getParticipants();
            const participant = participants[id];
            if (participant) {
                nameInput.value = participant.name;
                ageInput.value = participant.age;
                editIdInput.value = id;
            }
        }
    }

    form.addEventListener('submit', (event) => {
        event.preventDefault();
        const name = nameInput.value.trim();
        const age = ageInput.value.trim();
        const id = editIdInput.value;

        if (name && age) {
            const participants = getParticipants();
            if (id === '') {
                participants.push({ name, age });
            } else {
                participants[id] = { name, age };
            }
            localStorage.setItem('participants', JSON.stringify(participants));
            window.location.href = 'index.html';
        }
    });

    populateForm();
});
