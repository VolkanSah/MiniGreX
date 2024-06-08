document.addEventListener('DOMContentLoaded', () => {
  // Modal öffnen
  function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
      modal.style.display = 'block';
    }
  }

  // Modal schließen
  function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
      modal.style.display = 'none';
    }
  }

  // Event Listener für Öffnen-Buttons
  document.querySelectorAll('.btn-open-modal').forEach(button => {
    button.addEventListener('click', () => {
      const modalId = button.getAttribute('data-target');
      openModal(modalId);
    });
  });

  // Event Listener für Schließen-Buttons
  document.querySelectorAll('.modal-close').forEach(button => {
    button.addEventListener('click', () => {
      const modalId = button.getAttribute('data-target');
      closeModal(modalId);
    });
  });

  // Schließen des Modals bei Klick außerhalb des Inhalts
  window.addEventListener('click', (event) => {
    if (event.target.classList.contains('modal')) {
      event.target.style.display = 'none';
    }
  });
});
