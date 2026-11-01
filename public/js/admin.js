// Admin Layout Interactions

document.addEventListener('DOMContentLoaded', function() {
    // Dropdown Profile Toggle (Simulated)
    const profileDropdown = document.querySelector('.profile-dropdown');
    if (profileDropdown) {
        profileDropdown.addEventListener('click', function() {
            console.log('Profile dropdown clicked');
            // Logic for showing dropdown menu could go here
        });
    }

    // Notification Click
    const notificationBtn = document.querySelector('.icon-btn[title="Notifikasi"]');
    if (notificationBtn) {
        notificationBtn.addEventListener('click', function() {
            alert('Anda memiliki 3 notifikasi baru dari pendaftaran warga.');
        });
    }

    // Sidebar Hover Effects
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        link.addEventListener('mouseenter', () => {
            if (!link.classList.contains('active')) {
                link.style.transform = 'translateX(5px)';
            }
        });
        link.addEventListener('mouseleave', () => {
            link.style.transform = 'translateX(0)';
        });
    });

    // Form Interactions (e.g., selection buttons in Pendaftaran)
    const selectButtons = document.querySelectorAll('.btn[style*="border: 1px solid #ddd"]');
    selectButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            // Unselect others in the same group
            const group = this.parentElement.querySelectorAll('.btn');
            group.forEach(b => {
                b.style.background = '#fff';
                b.style.color = 'inherit';
                b.style.borderColor = '#ddd';
            });
            // Select this one
            this.style.background = '#4a7c59';
            this.style.color = '#fff';
            this.style.borderColor = '#4a7c59';
        });
    });
});
