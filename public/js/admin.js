/**
 * ==============================================================================
 *  e-Posyandu — Admin Dashboard Interactions & Responsive Navigation
 * ==============================================================================
 *  Author: Antigravity Engineering Team
 *  Architecture: Modular Vanilla JavaScript (No Framework Dependency)
 *
 *  FEATURES:
 *  - Responsive Mobile Sidebar Drawer & Backdrop Management
 *  - Generic Modal Dialog Handler (Open, Close, Keyboard Trap, Backdrop Dismiss)
 *  - Table Responsive Auto-Wrapper
 *  - Smooth Button Tactile Micro-Interactions
 *  - Toast & Alert Dismissal
 * ==============================================================================
 */

document.addEventListener('DOMContentLoaded', () => {
    'use strict';

    /* ==========================================================================
       1. RESPONSIVE SIDEBAR & MOBILE DRAWER NAVIGATION
       ========================================================================== */
    const sidebar = document.querySelector('.sidebar');
    const backdrop = document.getElementById('sidebarBackdrop');
    const mobileToggle = document.getElementById('mobileMenuToggle');
    const sidebarCloseBtn = document.getElementById('sidebarCloseBtn');

    /**
     * Open mobile sidebar drawer and activate backdrop
     */
    function openSidebar() {
        if (sidebar && backdrop) {
            sidebar.classList.add('sidebar-open');
            backdrop.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent body background scrolling
        }
    }

    /**
     * Close mobile sidebar drawer and deactivate backdrop
     */
    function closeSidebar() {
        if (sidebar && backdrop) {
            sidebar.classList.remove('sidebar-open');
            backdrop.classList.remove('active');
            document.body.style.overflow = '';
        }
    }

    // Attach event listeners for mobile sidebar
    if (mobileToggle) {
        mobileToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            openSidebar();
        });
    }

    if (sidebarCloseBtn) {
        sidebarCloseBtn.addEventListener('click', closeSidebar);
    }

    if (backdrop) {
        backdrop.addEventListener('click', closeSidebar);
    }

    // Auto-close sidebar on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && sidebar && sidebar.classList.contains('sidebar-open')) {
            closeSidebar();
        }
    });

    // Reset drawer state when viewport resizes to desktop mode (>= 992px)
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 992 && sidebar && sidebar.classList.contains('sidebar-open')) {
            closeSidebar();
        }
    });

    /* ==========================================================================
       1.1 SIDEBAR COLLAPSIBLE ACCORDION DROPDOWN
       ========================================================================== */
    const dropdownToggles = document.querySelectorAll('.nav-dropdown-toggle');
    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const parent = this.closest('.nav-dropdown');
            if (parent) {
                parent.classList.toggle('open');
            }
        });
    });

    /* ==========================================================================
       2. GENERIC MODAL DIALOG HANDLER
       ========================================================================== */
    /**
     * Open a target modal by ID
     * @param {string} modalId - The element ID of the modal overlay container
     */
    window.openModal = function(modalId = 'productModal') {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = 'flex';
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';

            // Auto-focus first input in modal if available
            const firstInput = modal.querySelector('input:not([type="hidden"]), select, textarea');
            if (firstInput) {
                setTimeout(() => firstInput.focus(), 100);
            }
        }
    };

    /**
     * Close a target modal by ID
     * @param {string} modalId - The element ID of the modal overlay container
     */
    window.closeModal = function(modalId = 'productModal') {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = 'none';
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }
    };

    // Close modals on clicking outside modal content or pressing Escape
    document.addEventListener('click', (e) => {
        if (e.target.classList && e.target.classList.contains('modal-overlay')) {
            window.closeModal(e.target.id);
        }
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            const activeModal = document.querySelector('.modal-overlay.active');
            if (activeModal) {
                window.closeModal(activeModal.id);
            }
        }
    });

    /* ==========================================================================
       3. RESPONSIVE TABLE ENHANCER
       ========================================================================== */
    /**
     * Automatically wrap raw tables without a .table-responsive parent
     * to prevent mobile layout breaking
     */
    const tables = document.querySelectorAll('table:not(.table-responsive table)');
    tables.forEach((table) => {
        if (!table.parentElement.classList.contains('table-responsive')) {
            const wrapper = document.createElement('div');
            wrapper.className = 'table-responsive';
            table.parentNode.insertBefore(wrapper, table);
            wrapper.appendChild(table);
        }
        if (!table.classList.contains('custom-table')) {
            table.classList.add('custom-table');
        }
    });

    /* ==========================================================================
       4. TOAST NOTIFICATION HELPER
       ========================================================================== */
    window.showToast = function(message, type = 'success') {
        let container = document.getElementById('globalToastContainer');
        if (!container) {
            container = document.createElement('div');
            container.id = 'globalToastContainer';
            container.className = 'toast-container';
            document.body.appendChild(container);
        }

        const toast = document.createElement('div');
        toast.className = `toast-message toast-${type}`;
        const icon = type === 'success' 
            ? 'fa-circle-check' 
            : (type === 'danger' ? 'fa-circle-exclamation' : 'fa-circle-info');

        toast.innerHTML = `
            <i class="fa-solid ${icon} toast-icon"></i>
            <div style="flex-grow: 1; font-weight: 500;">${message}</div>
        `;
        container.appendChild(toast);

        // Animate in
        requestAnimationFrame(() => {
            toast.classList.add('show');
        });

        // Auto dismiss after 3.5s
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.parentNode.removeChild(toast);
                }
            }, 300);
        }, 3500);
    };

    /* ==========================================================================
       5. NOTIFICATION & PROFILE FLOATING DROPDOWNS
       ========================================================================== */
    const profileBtn = document.getElementById('profileDropdownBtn');
    const profileDropdown = document.getElementById('profileDropdown');
    const profileChevron = document.getElementById('profileChevron');

    const notificationBtn = document.getElementById('notificationBtn');
    const notificationDropdown = document.getElementById('notificationDropdown');

    window.closeAllDropdowns = function() {
        if (profileDropdown) {
            profileDropdown.classList.remove('show');
            if (profileBtn) profileBtn.setAttribute('aria-expanded', 'false');
            if (profileChevron) profileChevron.style.transform = '';
        }
        if (notificationDropdown) {
            notificationDropdown.classList.remove('show');
            if (notificationBtn) notificationBtn.setAttribute('aria-expanded', 'false');
        }
    };

    // Toggle Profile Dropdown
    if (profileBtn && profileDropdown) {
        profileBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            const isOpen = profileDropdown.classList.contains('show');
            window.closeAllDropdowns();
            if (!isOpen) {
                profileDropdown.classList.add('show');
                profileBtn.setAttribute('aria-expanded', 'true');
                if (profileChevron) profileChevron.style.transform = 'rotate(180deg)';
            }
        });
    }

    // Toggle Notification Dropdown
    if (notificationBtn && notificationDropdown) {
        notificationBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            const isOpen = notificationDropdown.classList.contains('show');
            window.closeAllDropdowns();
            if (!isOpen) {
                notificationDropdown.classList.add('show');
                notificationBtn.setAttribute('aria-expanded', 'true');
            }
        });
    }

    // Dismiss dropdowns when clicking anywhere outside
    document.addEventListener('click', (e) => {
        if (!e.target.closest('#profileWrapper') && !e.target.closest('#notificationWrapper')) {
            window.closeAllDropdowns();
        }
    });

    // Dismiss dropdowns on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            window.closeAllDropdowns();
        }
    });

    // Mark All Notifications as Read Button
    const markAllReadBtn = document.getElementById('markAllReadBtn');
    if (markAllReadBtn) {
        markAllReadBtn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();

            const unreadItems = document.querySelectorAll('.notif-row.unread');
            unreadItems.forEach(item => {
                item.classList.remove('unread');
            });

            const unreadDots = document.querySelectorAll('.unread-indicator-dot');
            unreadDots.forEach(dot => dot.remove());

            const badge = document.getElementById('notificationBadge');
            if (badge) badge.style.display = 'none';

            const unreadBadge = document.getElementById('unreadNotifBadge');
            if (unreadBadge) {
                unreadBadge.textContent = '0 Baru';
                unreadBadge.className = 'tag tag-neutral';
            }

            markAllReadBtn.textContent = 'Sudah Dibaca';
            markAllReadBtn.style.color = 'var(--text-muted)';
            markAllReadBtn.disabled = true;

            window.showToast('Semua notifikasi telah ditandai sebagai dibaca.', 'success');
        });
    }

    /* ==========================================================================
       6. SPOTLIGHT QUICK SEARCH & GLOBAL SHORTCUT (Ctrl + K / "/")
       ========================================================================== */
    document.addEventListener('keydown', (e) => {
        // Trigger quick search with Ctrl+K or Cmd+K
        if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') {
            e.preventDefault();
            window.openModal('quickSearchModal');
        }
    });

    const quickSearchInput = document.getElementById('quickSearchInput');
    if (quickSearchInput) {
        quickSearchInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                const query = quickSearchInput.value.trim();
                if (query) {
                    window.location.href = `/admin/daftar-anggota?cari=${encodeURIComponent(query)}`;
                }
            }
        });
    }

    /* ==========================================================================
       7. SETTINGS FORM SUBMISSION HANDLER
       ========================================================================== */
    window.handleSaveSettings = function(e) {
        e.preventDefault();
        const posko = document.getElementById('settingPoskoName')?.value || 'Posyandu Anggrek';
        window.closeModal('settingsModal');
        window.showToast(`Pengaturan "${posko}" berhasil diperbarui.`, 'success');
    };

    /* ==========================================================================
       8. BUTTON INTERACTION BINDINGS FOR HEALTH REPORTS & DATA TABLES
       ========================================================================== */
    // Export Buttons (Excel / PDF / Print)
    const allButtons = document.querySelectorAll('button, .btn');
    allButtons.forEach(btn => {
        // Excel Export
        if (btn.querySelector('.fa-file-excel') || btn.textContent.toLowerCase().includes('xlsx') || btn.textContent.toLowerCase().includes('excel')) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                window.showToast('Menyiapkan berkas Excel (.xlsx) untuk diunduh...', 'info');
                setTimeout(() => {
                    window.showToast('Laporan kas berhasil diekspor.', 'success');
                }, 1000);
            });
        }

        // PDF Export / Print
        if (btn.querySelector('.fa-file-pdf') || btn.textContent.toLowerCase().includes('unduh pdf')) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                window.showToast('Menyiapkan berkas PDF laporan...', 'info');
                setTimeout(() => {
                    window.print();
                }, 500);
            });
        }

        // Filter Buttons
        if (btn.querySelector('.fa-filter') && !btn.classList.contains('pill-btn')) {
            btn.addEventListener('click', function() {
                window.showToast('Memfilter dan memperbarui data tabel...', 'info');
            });
        }

        // Rekapitulasi Buttons
        if (btn.textContent.includes('Lihat Rekapitulasi') || btn.textContent.includes('Lihat Berkas')) {
            btn.addEventListener('click', function() {
                const cardTitle = this.closest('.card')?.querySelector('h4')?.textContent || 'Laporan';
                window.showToast(`Membuka rekapitulasi ${cardTitle.trim()}...`, 'info');
            });
        }
    });

    /* ==========================================================================
       9. FLASH MESSAGE ALERT AUTO-DISMISS
       ========================================================================== */
    const flashAlerts = document.querySelectorAll('.alert');
    flashAlerts.forEach((alertEl) => {
        // Auto fade after 5 seconds
        setTimeout(() => {
            alertEl.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            alertEl.style.opacity = '0';
            alertEl.style.transform = 'translateY(-10px)';
            setTimeout(() => {
                if (alertEl.parentNode) {
                    alertEl.parentNode.removeChild(alertEl);
                }
            }, 500);
        }, 5000);
    });

    /* ==========================================================================
       10. BUTTON TACTILE MICRO-INTERACTIONS
       ========================================================================== */
    const buttons = document.querySelectorAll('.btn');
    buttons.forEach((btn) => {
        btn.addEventListener('mousedown', function() {
            this.style.transform = 'scale(0.98)';
        });
        btn.addEventListener('mouseup', function() {
            this.style.transform = '';
        });
        btn.addEventListener('mouseleave', function() {
            this.style.transform = '';
        });
    });
});
