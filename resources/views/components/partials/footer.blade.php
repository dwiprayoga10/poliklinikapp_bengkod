<footer class="main-footer stylish-footer">
    <div class="footer-content">
        <p class="mb-0 text-muted">
            <strong>&copy; 2025 <a href="#" class="text-primary">Poliklinik</a></strong> —
            All rights reserved.
        </p>

    </div>
</footer>

<style>
/* 🌤️ Stylish Light Footer */
.stylish-footer {
    background: linear-gradient(90deg, #ffffff, #f0f7ff);
    border-top: 1px solid rgba(0,0,0,0.1);
    color: #334155;
    padding: 12px 20px;
    text-align: center;
    font-size: 14px;
    transition: all 0.3s ease;
    position: relative;
}

.stylish-footer a {
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.stylish-footer a:hover {
    color: #2563eb;
}

/* ✨ Animation hover */
.stylish-footer:hover {
    box-shadow: 0 -2px 15px rgba(0, 0, 0, 0.05);
    background: linear-gradient(90deg, #f8fbff, #e8f4ff);
}

/* 💖 Credit text */
.footer-credit {
    display: block;
    margin-top: 4px;
    font-size: 13px;
    color: #64748b;
    animation: fadeIn 1.5s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(4px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
