document.addEventListener('DOMContentLoaded', function() {
    const showNotesBtn = document.getElementById('show-notes-btn');
    const maintenanceIdInput = document.getElementById('maintenance-id-input');
    const maintenanceNotesContainer = document.getElementById('maintenance-notes-container');
    const maintenanceNotesList = document.getElementById('maintenance-notes-list');
    
    // Cacher initialement la section des notes
    maintenanceNotesContainer.style.display = 'none';
    
    showNotesBtn.addEventListener('click', function() {
        const maintenanceId = maintenanceIdInput.value;
        
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = xhr.responseText;
                maintenanceNotesList.innerHTML = response;
                maintenanceNotesContainer.style.display = 'block';
            }
        };
        
        xhr.open('POST', 'get_notes.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('maintenance_id=' + maintenanceId);
    });
});
