document.addEventListener('DOMContentLoaded', () => {
    const tableBody = document.querySelector('#participants-table tbody');

    function getParticipants() {
        return JSON.parse(localStorage.getItem('participants')) || [];
    }

    function renderParticipants() {
        const participants = getParticipants();
        tableBody.innerHTML = '';
        participants.forEach((participant, index) => {
            const row = document.createElement('tr');
            row.dataset.index = index;
            row.innerHTML = `
                <td>${participant.name}</td>
                <td>${participant.age}</td>
                <td>
                    <button class="edit" onclick="window.location.href='edit.html?id=${index}'">Edit</button>
                    <button class="delete">Hapus</button>
                </td>
            `;
            tableBody.appendChild(row);
        });

        tableBody.querySelectorAll('.delete').forEach(button => {
            button.addEventListener('click', (event) => {
                const index = event.target.closest('tr').dataset.index;
                const participants = getParticipants();
                participants.splice(index, 1);
                localStorage.setItem('participants', JSON.stringify(participants));
                renderParticipants();
            });
        });
    }

    renderParticipants();
});
