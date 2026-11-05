<link rel="stylesheet" href="{{ url('serbamulia/style.css') }}?v={{ time() }}">

<style>
    .text-justify {
        text-align: justify !important;
    }
    .text-center {
        text-align: center !important;
    }

    /* Navbar Dropdown for Produk & Layanan */
    .nav-dropdown {
        position: relative;
        display: inline-flex;
        align-items: center;
    }
    .nav-dropdown-trigger {
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .nav-dropdown-menu {
        position: absolute;
        top: calc(100% + 16px);
        left: 50%;
        transform: translateX(-50%) translateY(8px);
        min-width: 300px;
        background: var(--bg-secondary);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-md);
        padding: 12px;
        box-shadow: var(--shadow-premium);
        opacity: 0;
        visibility: hidden;
        transition: var(--transition-smooth);
        z-index: 200;
    }
    .nav-dropdown::after {
        content: '';
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        height: 20px;
    }
    .nav-dropdown:hover .nav-dropdown-menu {
        opacity: 1;
        visibility: visible;
        transform: translateX(-50%) translateY(0);
    }
    .nav-dropdown-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 14px;
        border-radius: var(--radius-sm);
        text-decoration: none;
        color: var(--text-main);
        transition: var(--transition-smooth);
    }
    .nav-dropdown-item:hover {
        background: rgba(245, 158, 11, 0.1);
        color: var(--primary);
    }
    .nav-dropdown-item img {
        width: 36px;
        height: 36px;
        object-fit: contain;
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.04);
        padding: 4px;
    }
    .nav-dropdown-item-title {
        font-weight: 600;
        font-size: 14px;
        display: block;
    }
    .nav-dropdown-item-sub {
        font-size: 12px;
        color: var(--text-muted);
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .nav-dropdown-divider {
        height: 1px;
        background: var(--border-color);
        margin: 8px 0;
    }

    @media (max-width: 768px) {
        .nav-dropdown {
            flex-direction: column;
            align-items: flex-start;
            width: 100%;
        }
        .nav-dropdown-menu {
            position: static;
            transform: none !important;
            opacity: 1;
            visibility: visible;
            box-shadow: none;
            border: none;
            background: transparent;
            padding: 4px 0 8px 12px;
            min-width: 100%;
        }
    }

    /* Rich Content & CMS Tables */
    .cms-rich-content {
        color: var(--text-muted);
        font-size: 15px;
        line-height: 1.8;
    }
    .cms-rich-content p {
        margin-bottom: 16px;
    }
    .cms-rich-content h1, .cms-rich-content h2, .cms-rich-content h3, .cms-rich-content h4 {
        font-family: var(--font-heading);
        color: var(--text-main);
        margin: 24px 0 12px 0;
    }
    .cms-rich-content ul, .cms-rich-content ol {
        margin: 12px 0 20px 20px;
    }
    .cms-rich-content li {
        margin-bottom: 8px;
    }
    .cms-rich-content img {
        max-width: 100%;
        height: auto;
        border-radius: var(--radius-md);
    }
    .cms-table-wrapper {
        overflow-x: auto;
        border-radius: var(--radius-md);
        border: 1px solid var(--border-color);
        background: var(--bg-secondary);
    }
    .cms-table-wrapper table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }
    .cms-table-wrapper th {
        background: rgba(245, 158, 11, 0.12);
        color: var(--primary);
        font-weight: 700;
        text-align: left;
        padding: 14px 16px;
        border-bottom: 1px solid var(--border-color);
    }
    .cms-table-wrapper td {
        padding: 14px 16px;
        color: var(--text-muted);
        border-bottom: 1px solid var(--border-color);
    }

    /* Custom Modal */
    .gm-modal-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.75);
        backdrop-filter: blur(6px);
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
        overflow-y: auto;
    }
    .gm-modal-backdrop.open {
        display: flex;
    }
    .gm-modal-dialog {
        background: var(--bg-secondary);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        width: 100%;
        max-width: 600px;
        padding: 32px;
        box-shadow: var(--shadow-premium);
        position: relative;
        max-height: 90vh;
        overflow-y: auto;
    }
    .gm-modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--border-color);
    }
    .gm-modal-title {
        font-family: var(--font-heading);
        font-size: 22px;
        font-weight: 700;
        color: var(--text-main);
    }
    .gm-modal-close {
        background: transparent;
        border: 1px solid var(--border-color);
        color: var(--text-muted);
        width: 36px;
        height: 36px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .gm-modal-close:hover {
        color: var(--primary);
        border-color: var(--primary);
    }

    .help-block-error {
        color: #ef4444;
        font-size: 12px;
        margin-top: 4px;
    }

    /* Floating WhatsApp Button */
    .wa-floating-btn {
        position: fixed;
        bottom: 28px;
        right: 28px;
        z-index: 990;
        width: 58px;
        height: 58px;
        border-radius: 50%;
        background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 25px rgba(37, 211, 102, 0.4);
        text-decoration: none;
        transition: var(--transition-smooth);
    }
    .wa-floating-btn:hover {
        transform: translateY(-4px) scale(1.05);
        box-shadow: 0 14px 30px rgba(37, 211, 102, 0.55);
    }
</style>
